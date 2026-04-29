<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Denuncias extends CI_Controller{

  public function __construct()
  {
      parent::__construct();
      if(!$this->session->servidor)
          login();
  }



  /**
	 * Lista los usuarios registrados
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-10-16
	 * @return 			VOID
	 */
	public function denuncia()
	{
      mb_internal_encoding("UTF-8");

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $categorias =	$this->main->getListSelect('categoria', 'id_categoria, nombre', array('nombre'=>'ASC'), array('estado'=>'AC'));
    $data['categorias'] = $this->main->dropdown($categorias, '');
    $centros =$this->main->getListSelect('centro', 'id_centro, nombre_centro', array('nombre_centro'=>'ASC'),array('estado'=>'AC'));
		$data['centros'] = $this->main->dropdown($centros, '');
    $data['sexos'] = array('FEMENINO'=>'FEMENINO', 'MASCULINO'=>'MASCULINO');
    $data['expedidos'] = array('COCHABAMBA'=>'COCHABAMBA', 'LA PAZ'=>'LA PAZ', 'ORURO'=>'ORURO', 'POTOSI'=>'POTOSI','SUCRE'=>'SUCRE','TARIJA'=>'TARIJA','SANTA CRUZ'=>'SANTA CRUZ','PANDO'=>'PANDO','BENI'=>'BENI');
    $data['instancias'] = array(''=>'','MINISTERIO PUBLICO'=>'MINISTERIO PUBLICO','TRIBUNAL DEPARTAMENTAL DE JUSTICIA'=>'TRIBUNAL DEPARTAMENTAL DE JUSTICIA','NINGUNO'=>'NINGUNO');


    //$gestiones =	$this->main->getListSelect('gestion', 'id_gestion, gestion', array('gestion'=>'ASC'),array('estado'=>'AC'));
		//$data['gestiones'] = $this->main->dropdown($gestiones, '');
    $parentescos =	$this->main->getListSelect('parentesco', 'id_parentesco, nombre', array('nombre'=>'ASC'),array('estado'=>'AC'));
		$data['parentescos'] = $this->main->dropdown($parentescos, '');

    $id_centro= $this->main->getField('usuario', 'id_centro', array('id_usuario'=>$this->session->servidor->id_usuario));
    if(!empty($id_centro))
      $nombre_centro= $this->main->getField('centro', 'nombre_centro', array('id_centro'=>$this->session->servidor->id_centro));

     $nombre_rol = $this->session->servidor->rol;

    $data['nombre_rol']=$nombre_rol;

    if($nombre_rol == 'ADMINISTRADOR' || $nombre_rol == 'REVISOR'){
      $data['parte_area'] = 'TODOS';

    }
    else{
      $parte = explode(" ",$nombre_rol);
      $parte_rol = $parte[0];
      $data['parte_area'] = $parte[1];
    }

    $gestion = $this->session->userdata('gestion');

    if($nombre_rol == 'ADMINISTRADOR'|| $nombre_rol == 'REVISOR')
        $data['denuncias'] = $this->main->getListOrder('denuncia', array('id_denuncia'=>'DESC'), array('gestion.gestion'=>$gestion,'denuncia.denuncia_archivada'=>0,'denuncia.denuncia_cerrada'=>0), null, null, array('denunciante'=>'id_denunciante', 'gestion'=>'id_gestion','victima'=>'id_victima'));

    else if($parte_rol == 'FUNCIONARIO')
        $data['denuncias'] = $this->main->getListOrder('denuncia', array('id_denuncia'=>'DESC'), array('denuncia.id_centro'=>$id_centro, 'gestion.gestion'=>$gestion,'denuncia.denuncia_archivada'=>0,'denuncia.denuncia_cerrada'=>0), null, null, array('denunciante'=>'id_denunciante', 'gestion'=>'id_gestion','victima'=>'id_victima'));

    setcookie("demo",$this->db->last_query(),time()+86500);

		$this->load->view('denuncia/denuncia', $data);
	}

    public function registrar()
	{
    //echo '<pre>'; var_dump($this->input->post()); exit; echo '</pre>';
		$this->form_validation->set_rules('denunciante[nombre_completo]', lang('nombre.completo'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('denunciante[dni_denunciante]', lang('dni'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denunciante[expedido_denunciante]', lang('expedido'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('denunciante[direccion]', lang('direccion'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('denunciante[fecha_nacimiento]', lang('fecha.nacimiento'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denunciante[genero]', lang('sexo'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denunciante[telefono]', lang('telefono'), 'trim|required');



    if($this->form_validation->run()){


  			$denunciante = $this->input->post('denunciante');
        //$denunciado = $this->input->post('denunciado');

        $cantidad_dni = $this->main->total('denunciante', array('dni_denunciante'=>$denunciante['dni_denunciante']));

        //echo "hola".$cantidad_dni;
        if ($cantidad_dni == 0 )
        {
          $id_denunciante = $this->main->insert('denunciante', $denunciante);

        }
        else
        {

          $this->main->update('denunciante', $denunciante, array('dni_denunciante'=>$denunciante['dni_denunciante']));
          //$id_denunciante=$this->main->main->getField('denunciante','id_denunciante',array('dni_denunciante'=>$denunciante['dni_denunciante']));
          $this->main->update('denuncia', array('denunciante'=>$denunciante['nombre_completo']), array('id_denunciante'=>$id_denunciante));

        }

        $this->form_validation->set_rules('denuncia[id_categoria]', lang('tipologia'), 'trim|required');
      //  $this->form_validation->set_rules('denuncia[id_centro]',lang('centro'),'trim|required');
        $this->form_validation->set_rules('denuncia[id_categoria_secundaria]',lang('tipologia.secundaria'));
        $this->form_validation->set_rules('denuncia[subalcaldia]', lang('subalcaldia'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('denuncia[distrito]', lang('distrito'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('denuncia[otb]', lang('otb'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('denuncia[procedencia]', lang('procedencia.denunciante'), 'trim|required|mb_strtoupper');



        if($this->input->post('denuncia_coord_e') AND $this->input->post('denuncia_coord_s'))
			  {

          $denuncia = $this->input->post('denuncia');
          $denuncia['id_centro']=$this->session->servidor->id_centro;
          $denuncia['nombre_centro']	= $this->main->getField('centro', 'nombre_centro', array('id_centro'=>$denuncia['id_centro']));
          if(empty($denuncia['id_centro'])){
            $denuncia['nombre_centro']=mb_strtoupper($denuncia['subalcaldia'], 'UTF-8');
            $denuncia['id_centro']	= $this->main->getField('centro', 'id_centro', array('nombre_centro'=>$denuncia['nombre_centro']));
          }

            //$cent = $denuncia['nombre_centro'];
            $subal =  mb_strtoupper($denuncia['subalcaldia'], 'UTF-8');

          if($denuncia['nombre_centro'] == $subal){

              $denuncia['tipologia']	= $this->main->getField('categoria', 'nombre', array('id_categoria'=>$denuncia['id_categoria']));
              $denuncia['id_denunciante'] = $this->main->main->getField('denunciante','id_denunciante',array('dni_denunciante'=>$denunciante['dni_denunciante']));

              $denuncia['denunciante'] = $this->main->main->getField('denunciante','nombre_completo',array('dni_denunciante'=>$denunciante['dni_denunciante']));

              $denuncia['fecha_denuncia']=date("Y-m-d H:i:s");
              $denuncia['id_usuario']=$this->session->servidor->id_usuario;
              $denuncia['registrado_por'] = $this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
              $denuncia['coord_e'] = $this->input->post('denuncia_coord_e');
    				  $denuncia['coord_s'] = $this->input->post('denuncia_coord_s');
              $gestion = date ("Y");
              $denuncia['id_gestion'] =$this->main->getField('gestion','id_gestion',array('gestion'=>$gestion));
              //$denuncia['id_denunciante']= $id_denunciante;
              if(empty($denuncia['id_categoria_secundaria']))
                $denuncia['id_categoria_secundaria']= 0;
              $denuncia['denuncia_cerrada']=0;
              $denuncia['denuncia_archivada']=0;

              $denuncia['subalcaldia'] =  mb_strtoupper($denuncia['subalcaldia'], 'UTF-8');

              $id_denuncia=$this->main->insert('denuncia', $denuncia);

              $denuncias['id_centro']=$denuncia['id_centro'];
              $denuncias['id_gestion']=$denuncia['id_gestion'];

              $numero_denuncia=$this->main->getField('denuncias','numero_denuncia', array('id_centro'=>$denuncia['id_centro'], 'id_gestion'=>$denuncia['id_gestion']));

              $fecha_actual=date('Y-m-d');
              if($numero_denuncia >= 1 && $fecha_actual != $gestion.'-01-01'){
              $denuncias['numero_denuncia']=$numero_denuncia+1;
              $numero_denuncia=$denuncias['numero_denuncia'];
              $this->main->update('denuncias', $denuncias, array('id_gestion'=>$denuncia['id_gestion'],'id_centro'=>$denuncia['id_centro']));

              }
              else{
                $denuncias['numero_denuncia']=1;
                $this->main->insert('denuncias', $denuncias);
                $numero_denuncia = $denuncias['numero_denuncia'];
              }


              $gestion=$this->main->getField('gestion', 'gestion', array('id_gestion'=>$denuncia['id_gestion']));
              $cod_centro=$this->main->getField('centro', 'codigo', array('id_centro'=>$denuncia['id_centro']));
              $codigo_ceros = str_pad($numero_denuncia, 4, "0", STR_PAD_LEFT);
              $codigo_denuncia=$codigo_ceros.'/'.$gestion.'-'.$cod_centro;
              $this->main->update('denuncia',array('codigo_denuncia'=>$codigo_denuncia),array('id_denuncia'=>$id_denuncia));
            }
            else{
              $this->session->set_flashdata('alert', lang('no.corresponde.denuncia'));
              redirect('denuncia');
            }
        }

        else
        {
          $this->session->set_flashdata('alert', lang('crear.marcador'));

          redirect('denuncia');
        }

        $this->session->set_flashdata('success', lang('registrado.correctamente'));
  			redirect('denuncia');
      }
  		else
  		{
  			$this->session->set_flashdata('alert', validation_errors());
  			redirect('denuncia');
  		}
	}

  /**
	 * Recibe mediante POST los datos de la denuncia a Actualizarce
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-10-16
	 * @return 			VOID
	 */

   public function buscar_persona()
{
   $ci = $this->input->post('denunciante_dni');
   $result['status'] = TRUE;
   $result['data'] = array();

   $persona = $this->main->get('denunciante', array('dni_denunciante'=> strtoupper($ci)));
   if(empty($persona)){
     $select = 'victima.id_victima as id_denunciante,victima.nombre_completo,victima.domicilio as direccion, victima.dni,victima.fecha_nacimiento,victima.sexo as genero,victima.expedido as expedido_denunciante';
     $persona = $this->main->getSelect('victima',$select,array('dni'=> strtoupper($ci)));
  }
   $result['data'] = $persona;
    echo json_encode($result);
}
	public function editar()
	{
    //echo '<pre>'; var_dump($this->input->post()); exit; echo '</pre>';
    mb_internal_encoding("UTF-8");
    $this->form_validation->set_rules('denuncia[id_categoria_secundaria]', lang('tipologia.secundaria'));
    $this->form_validation->set_rules('denuncia[id_categoria]', lang('tipologia'), 'trim|required');
    //$this->form_validation->set_rules('denuncia[id_centro]',lang('centro'),'trim|required');
    $this->form_validation->set_rules('denuncia[subalcaldia]', lang('subalcaldia'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denuncia[distrito]', lang('distrito'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denuncia[otb]', lang('otb'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denuncia[codigo_denuncia]', lang('codigo'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denuncia[descripcion]',lang('descripcion.denuncia'),'trim|mb_strtoupper');
    $this->form_validation->set_rules('denuncia[procedencia]', lang('procedencia.denunciante'), 'trim|required|mb_strtoupper');


    $this->form_validation->set_rules('denuncia[denunciante]', lang('nombre.completo'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denunciante[dni_denunciante]', lang('dni'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denunciante[expedido_denunciante]', lang('expedido'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denunciante[direccion]', lang('direccion'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denunciante[telefono]', lang('telefono'), 'trim|required|mb_strtoupper');
    $this->form_validation->set_rules('denunciante[genero]', lang('genero'), 'trim|required|mb_strtoupper');

    $this->form_validation->set_rules('denuncia[victima]', lang('nombre.completo'), 'trim|mb_strtoupper');

    $this->form_validation->set_rules('id_denuncia', lang('denuncia'));
    $this->form_validation->set_rules('id_victima', lang('victima'));
    $this->form_validation->set_rules('id_denunciante', lang('denunciante'));
    $this->form_validation->set_rules('id_denunciado', lang('denunciado'));

    //$this->form_validation->set_rules('victima[victima]', lang('victima'), 'trim|required');
    $this->form_validation->set_rules('victima[dni]', lang('victima'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('victima[expedido]', lang('victima'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('victima[domicilio]', lang('victima'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('victima[fecha_nacimiento]', lang('victima'), 'trim');
    $this->form_validation->set_rules('victima[sexo]', lang('sexo'), 'trim|mb_strtoupper');
    //echo   $id_denuncia = $this->input->post('id_victima');

    $this->form_validation->set_rules('denunciado[dni]', lang('dni'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('denunciado[expedido_denunciado]', lang('dni'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('denunciado[genero]', lang('genero'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('denunciado[nombre_completo]', lang('nombre.completo'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('denuncia[id_parentesco]',lang('parentesco'),'trim|mb_strtoupper');
    $this->form_validation->set_rules('denuncia[datos_complementarios]',lang('datos.complementarios'),'trim|mb_strtoupper');

		if($this->form_validation->run())
		{

      $id_victima = $this->input->post('id_victima');
      $id_centro= $this->input->post('denuncia_id_centro');
      $id_denunciado = $this->input->post('id_denunciado');
      $denuncia = $this->input->post('denuncia');
      $denunciante = $this->input->post('denunciante');
      $victima = $this->input->post('victima');
      $denunciado = $this->input->post('denunciado');


      $denuncia['tipologia']	= $this->main->getField('categoria', 'nombre', array('id_categoria'=>$denuncia['id_categoria']));
      $denuncia['nombre_centro']	= $this->main->getField('centro', 'nombre_centro', array('id_centro'=>$id_centro));
      $denuncia['id_centro'] = $id_centro;

      $victima['nombre_completo']=$denuncia['victima'];

      $denunciante['nombre_completo']=$denuncia['denunciante'];

      $denuncia['parentesco_victima']	= $this->main->getField('parentesco', 'nombre', array('id_parentesco'=>$denuncia['id_parentesco']));
      $denuncia['id_denunciado'] = $this->input->post('id_denunciado');

      $dni = $victima['dni'];
      if (empty($id_victima))
      {
        $existe_victima =$this->main->get('victima',array('dni'=>$victima['dni']));
        if(empty($existe_victima)){
          $id_vic = $this->main->insert('victima', $victima);
          //$existe_dni=$this->main->total('kardex', array('dni'=>$dni));
          $victima['id_centro']=$id_centro;
          $gestion = date ("Y");
          $victima['id_gestion'] =$this->main->getField('gestion','id_gestion',array('gestion'=>$gestion));
          $id_kardex = $this->main->insert('kardex',$victima);
        }
        else{
          $this->main->update('victima', $victima, array('dni'=>$dni));
          $this->main->update('kardex', $victima, array('dni'=>$dni));
        }


      }

      else
      {
        $this->main->update('victima', $victima, array('id_victima'=>$this->input->post('id_victima') ));
        $this->main->update('kardex', $victima, array('dni'=>$dni));

      }

        $id_vic=$this->input->post('id_victima');
      $existe_denunciado = $this->main->total('denunciado', array('dni'=>$denunciado['dni']));
      //echo '<pre>'; var_dump($existe_denunciado,$denunciado['dni']); exit; echo '</pre>';
      if($existe_denunciado == 0){

        $denuncia['id_denunciado'] = $this->main->insert('denunciado',$denunciado);
      }
      else{

        $this->main->update('denunciado', $denunciado, array('dni'=>$denunciado['dni']));

      }
      $this->main->update('denunciante', $denunciante, array('id_denunciante'=>$this->input->post('id_denunciante')));
      $this->main->update('denuncia', array('denunciante'=>$denuncia['denunciante']), array('id_denuncia'=>$this->input->post('id_denuncia')));
      $denuncia['id_denunciado'] =$this->main->getField('denunciado','id_denunciado',array('dni'=>$denunciado['dni']));
      $denuncia['id_denunciante']=$this->main->getField('denunciante','id_denunciante',array('dni_denunciante'=>$denunciante['dni_denunciante']));;
      $denuncia['id_victima']=$this->main->getField('victima','id_victima',array('dni'=>$victima['dni']));;
      $denuncia['parentesco_victima'] =$this->main->getField('parentesco','nombre',array('id_parentesco'=>$denuncia['id_parentesco']));

      $this->main->update('denuncia', $denuncia, array('id_denuncia'=>$this->input->post('id_denuncia')));


      $derivacion = $this->input->post('denuncia_d');


        $cont=0;

        foreach($derivacion as $valor){
          if($cont >0){

            $denuncia['derivacion']=$cadena.', '.$derivacion[$cont];
            $cadena= $denuncia['derivacion'];
          }
          else{
             $denuncia['derivacion']=$derivacion[0];
             $cadena = $denuncia['derivacion'];
           }

          $this->main->update('denuncia', array('derivacion'=>$denuncia['derivacion']), array('id_denuncia'=>$this->input->post('id_denuncia')));
          $cont++;
        }
      /*echo '<pre> HOLA<br>';
        print_r($derivacion);

        echo '</pre>*/

     //$denuncia['derivacion']= $denuncia['derivacion'].', '.$denuncia['derivacion'];








    			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('denuncia');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('denuncia');
		}

  }

  /**
	 * Recibe mediante POST los datos de la denuncia para insertar el informe tecnico
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-11-12
	 * @return 			VOID
	 */
	public function editarinforme()
	{
    mb_internal_encoding("UTF-8");
    $this->form_validation->set_rules('informe[instancias_jurisdicionales]', lang('instancias'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('informe[especifique]',lang('especifique'),'trim|mb_strtoupper');
    $this->form_validation->set_rules('informe[tipo_actas]',lang('tipo.actas'),'trim|mb_strtoupper');
    $this->form_validation->set_rules('informe[derivacion]', lang('derivacion'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('informe[situacion]', lang('situacion'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('informe[fecha]', lang('fecha'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('informe[numero_foja]', lang('foja'), 'trim|mb_strtoupper');

    $this->form_validation->set_rules('id_denuncia', lang('identificador'), 'trim|required');


		if($this->form_validation->run())
		{

      $informe = $this->input->post('informe');
      $informe['id_usuario']=$this->session->servidor->id_usuario;
      $informe['id_denuncia'] = $this->input->post('id_denuncia');

      $existe_area_legal = $this->main->total('area_legal', array('id_denuncia'=>$this->input->post('id_denuncia')));

      if($existe_area_legal == 0){

        $id_legal = $this->main->insert('area_legal',$informe);
      }
      else{
        $this->main->update('area_legal', $informe, array('id_denuncia'=>$this->input->post('id_denuncia')));
      }

			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('denuncia');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('denuncia');
		}
	}

/**
 * Recibe mediante POST los datos de la denuncia para insertar el informe tecnico psicologico
 *
 * @copyright		Gobierno Autonomo Municipal de Cochabamba
 * @author			Ing. Maira Quiroz Acevedo
 * @version			1.0  2018-11-13
 * @return 			VOID
 */
public function editarpsicologico()

{
  mb_internal_encoding("UTF-8");
  $this->form_validation->set_rules('informepsicologico[valoracion]', lang('valoracion'), 'trim|mb_strtoupper');
  //$this->form_validation->set_rules('informepsicologico[visita]',lang('visita'),'trim|mb_strtoupper');
  $this->form_validation->set_rules('informepsicologico[coordinacion_interinstitucional]', lang('coordinacion'), 'trim|mb_strtoupper');
  //$this->form_validation->set_rules('informepsicologico[grupo_terapia]', lang('terapia'), 'trim|mb_strtoupper');
  $this->form_validation->set_rules('informepsicologico[fecha]', lang('fecha'), 'trim|mb_strtoupper');
  $this->form_validation->set_rules('informepsicologico[numero_foja]', lang('fecha'), 'trim|mb_strtoupper');
  $this->form_validation->set_rules('informepsicologico[situacion]', lang('situacion'), 'trim|mb_strtoupper');

  $this->form_validation->set_rules('id_denuncia', lang('identificador'), 'trim|required');


  if($this->form_validation->run())
  {

    $informepsicologico = $this->input->post('informepsicologico');
    $informepsicologico['id_usuario']=$this->session->servidor->id_usuario;
    $informepsicologico['id_denuncia'] = $this->input->post('id_denuncia');

    $existe_area_psicologica = $this->main->total('area_psicologica', array('id_denuncia'=>$this->input->post('id_denuncia')));

    $visita = $this->input->post('psicologico_visita');
    $cont=0;

    foreach($visita as $valor){
      if($cont >0){

        $informepsicologico['visita']=$cadena.', '.$visita[$cont];
        $cadena= $informepsicologico['visita'];
      }
      else{
         $informepsicologico['visita']=$visita[0];
         $cadena = $informepsicologico['visita'];
       }


      $cont++;
    }


    $terapia = $this->input->post('psicologico_grupo_terapia');
    $conta=0;

    foreach($terapia as $val){
      if($conta >0){

        $informepsicologico['grupo_terapia']=$cadena2.', '.$terapia[$conta];
        $cadena2= $informepsicologico['grupo_terapia'];
      }
      else{
         $informepsicologico['grupo_terapia']=$terapia[0];
         $cadena2 = $informepsicologico['grupo_terapia'];
       }


      $conta++;
    }


    if($existe_area_psicologica == 0){

      $id_psicologica = $this->main->insert('area_psicologica',$informepsicologico);
    }
    else{
      $this->main->update('area_psicologica', $informepsicologico, array('id_denuncia'=>$this->input->post('id_denuncia') ));
    }

    $this->session->set_flashdata('info', lang('actualizado.correctamente'));
    redirect('denuncia');

  }

  else
  {
    $this->session->set_flashdata('alert', validation_errors());
    redirect('denuncia');
  }
}


/**
 * Recibe mediante POST los datos de la denuncia para insertar el informe tecnico psicologico
 *
 * @copyright		Gobierno Autonomo Municipal de Cochabamba
 * @author			Ing. Maira Quiroz Acevedo
 * @version			1.0  2018-11-13
 * @return 			VOID
 */
public function editarsocial()

{
  mb_internal_encoding("UTF-8");

  $this->form_validation->set_rules('informesocial[situacion]', lang('situacion'), 'trim|mb_strtoupper');
  //$this->form_validation->set_rules('informesocial[visita]',lang('visita'),'trim|required|mb_strtoupper');
  $this->form_validation->set_rules('informesocial[coordinacion_interinstitucional]', lang('coordinacion'), 'trim|mb_strtoupper');
  $this->form_validation->set_rules('informesocial[acogida]', lang('terapia'), 'trim|mb_strtoupper');
  $this->form_validation->set_rules('informesocial[fecha]', lang('fecha'), 'trim|mb_strtoupper');
  $this->form_validation->set_rules('informesocial[numero_foja]', lang('foja'), 'trim|mb_strtoupper');

  $this->form_validation->set_rules('id_denuncia', lang('identificador'), 'trim|required');


  if($this->form_validation->run())
  {

    $informesocial = $this->input->post('informesocial');
    $informesocial['id_usuario']=$this->session->servidor->id_usuario;
    $informesocial['id_denuncia'] = $this->input->post('id_denuncia');

    $existe_area_social = $this->main->total('area_social', array('id_denuncia'=>$this->input->post('id_denuncia')));


    $visita = $this->input->post('social_visita');
    $cont=0;

    foreach($visita as $valor){
      if($cont >0){

        $informesocial['visita']=$cadena.', '.$visita[$cont];
        $cadena= $informesocial['visita'];
      }
      else{
         $informesocial['visita']=$visita[0];
         $cadena = $informesocial['visita'];
       }


      $cont++;
    }



    if($existe_area_social == 0){

      $id_social = $this->main->insert('area_social',$informesocial);
    }
    else{
      $this->main->update('area_social', $informesocial, array('id_denuncia'=>$this->input->post('id_denuncia') ));
    }

    $this->session->set_flashdata('info', lang('actualizado.correctamente'));
    redirect('denuncia');

  }

  else
  {
    $this->session->set_flashdata('alert', validation_errors());
    redirect('denuncia');
  }
}

public function reporte_victima()
{


  $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

  $data['gestiones'] = $this->main->getListOrder('gestion', array('gestion'=>'ASC'));
  $data['estados'] = array('AC'=>'ACTIVO', 'DC'=>'INACTIVO');
  $this->load->view('administrador/gestion', $data);
}

/**
 * Recibe mediante POST los datos del nuevo usuario
 *
 * @copyright		Gobierno Autonomo Municipal de Cochabamba
 * @author			Ing. John Evert Aleman Orellana
 * @version			1.0  2018-02-20
 * @return 			VOID
 */
public function registrargestion()
{
  $this->form_validation->set_rules('gestion[gestion]', lang('nombre.gestion'), 'trim|required|mb_strtoupper|is_unique[gestion.gestion]');
  $this->form_validation->set_rules('gestion[estado]', lang('estado'), 'trim|required');

  if($this->form_validation->run())
  {
    $gestion = $this->input->post('gestion');

    $id = $this->main->insert('gestion', $gestion);

    if($id)
    {
      $this->session->set_flashdata('success', lang('registrado.correctamente'));
    }

    redirect('gestion-gestiones');
  }

  else
  {
    $this->session->set_flashdata('alert', validation_errors());
    redirect('gestion-gestiones');
  }
}

/**
 * Lista los usuarios registrados
 *
 * @copyright		Gobierno Autonomo Municipal de Cochabamba
 * @author			Ing. Maira Quiroz Acevedo
 * @version			1.0  2018-10-16
 * @return 			VOID
 */
public function denunciaarchivada()
{
    mb_internal_encoding("UTF-8");

  $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

  $id_centro= $this->main->getField('usuario', 'id_centro', array('id_usuario'=>$this->session->servidor->id_usuario));
  if(!empty($id_centro))
    $nombre_centro= $this->main->getField('centro', 'nombre_centro', array('id_centro'=>$this->session->servidor->id_centro));

  $nombre_rol = $this->session->servidor->rol;

  $data['nombre_rol']=$nombre_rol;

  if($nombre_rol == 'ADMINISTRADOR' || $nombre_rol == 'REVISOR'){
    $data['parte_area'] = 'TODOS';

  }
  else{
    $parte = explode(" ",$nombre_rol);
    $parte_rol = $parte[0];
    $data['parte_area'] = $parte[1];
  }

  $gestion = $this->session->userdata('gestion');

  if($nombre_rol == 'ADMINISTRADOR'|| $nombre_rol == 'REVISOR')
      $data['denuncias'] = $this->main->getListOrder('denuncia', array('id_denuncia'=>'DESC'), array('gestion.gestion'=>$gestion,'denuncia.denuncia_archivada'=>1), null, null, array('denunciante'=>'id_denunciante', 'gestion'=>'id_gestion','victima'=>'id_victima'));

  else if($parte_rol == 'FUNCIONARIO')
      $data['denuncias'] = $this->main->getListOrder('denuncia', array('id_denuncia'=>'DESC'), array('denuncia.id_centro'=>$id_centro, 'gestion.gestion'=>$gestion,'denuncia.denuncia_archivada'=>1), null, null, array('denunciante'=>'id_denunciante', 'gestion'=>'id_gestion','victima'=>'id_victima'));

  setcookie("demo",$this->db->last_query(),time()+86500);

  $this->load->view('denuncia/denuncia_archivada', $data);
}
public function archivardenuncia()
{

  $this->form_validation->set_rules('id_denuncia', lang('identificador'), 'trim|required');

  if($this->form_validation->run())
  {
    $id_denuncia = $this->input->post('id_denuncia');
    $denuncia['denuncia_archivada'] = 1;
    $denuncia['fecha_archivo'] =date('Y-m-d');

    $this->main->update('denuncia', $denuncia, array('id_denuncia'=>$id_denuncia));
    $this->session->set_flashdata('info', lang('actualizado.correctamente'));
    redirect('denuncia');
}
else
{
   $this->session->set_flashdata('alert', validation_errors());
  redirect('denuncia');
  }

}


/**
 * Lista los usuarios registrados
 *
 * @copyright		Gobierno Autonomo Municipal de Cochabamba
 * @author			Ing. Maira Quiroz Acevedo
 * @version			1.0  2018-11-23
 * @return 			VOID
 */
public function denunciacerrada()
{
    mb_internal_encoding("UTF-8");

  $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

  $id_centro= $this->main->getField('usuario', 'id_centro', array('id_usuario'=>$this->session->servidor->id_usuario));
  if(!empty($id_centro))
    $nombre_centro= $this->main->getField('centro', 'nombre_centro', array('id_centro'=>$this->session->servidor->id_centro));

  $nombre_rol = $this->session->servidor->rol;

  $data['nombre_rol']=$nombre_rol;

  if($nombre_rol == 'ADMINISTRADOR' || $nombre_rol == 'REVISOR'){
    $data['parte_area'] = 'TODOS';

  }
  else{
    $parte = explode(" ",$nombre_rol);
    $parte_rol = $parte[0];
    $data['parte_area'] = $parte[1];
  }

  $gestion = $this->session->userdata('gestion');

  if($nombre_rol == 'ADMINISTRADOR'|| $nombre_rol == 'REVISOR')
      $data['denuncias'] = $this->main->getListOrder('denuncia', array('id_denuncia'=>'DESC'), array('gestion.gestion'=>$gestion,'denuncia.denuncia_cerrada'=>1), null, null, array('denunciante'=>'id_denunciante', 'gestion'=>'id_gestion','victima'=>'id_victima'));

  else if($parte_rol == 'FUNCIONARIO')
      $data['denuncias'] = $this->main->getListOrder('denuncia', array('id_denuncia'=>'DESC'), array('denuncia.id_centro'=>$id_centro, 'gestion.gestion'=>$gestion,'denuncia.denuncia_cerrada'=>1), null, null, array('denunciante'=>'id_denunciante', 'gestion'=>'id_gestion','victima'=>'id_victima'));

  setcookie("demo",$this->db->last_query(),time()+86500);

  $this->load->view('denuncia/denuncia_cerrada', $data);
}
public function cierredenuncia()
{

  $this->form_validation->set_rules('id_denuncia', lang('identificador'), 'trim|required');

  if($this->form_validation->run())
  {
    $id_denuncia = $this->input->post('id_denuncia');
    $denuncia['denuncia_cerrada'] = 1;
    $denuncia['fecha_cierre'] =date('Y-m-d');

    $this->main->update('denuncia', $denuncia, array('id_denuncia'=>$id_denuncia));
    $this->session->set_flashdata('info', lang('actualizado.correctamente'));
    redirect('denuncia');
}
else
{
   $this->session->set_flashdata('alert', validation_errors());
  redirect('denuncia');
  }

}

public function habilitandodenuncia()
{

  $this->form_validation->set_rules('id_denuncia', lang('identificador'), 'trim|required');

  if($this->form_validation->run())
  {
    $id_denuncia = $this->input->post('id_denuncia');
    $denuncia['denuncia_archivada'] = 0;
    $denuncia['fecha_archivo'] = null;

    $this->main->update('denuncia', $denuncia, array('id_denuncia'=>$id_denuncia));
    $this->session->set_flashdata('info', lang('actualizado.correctamente'));
    redirect('denuncia-archivada');
}
else
{
   $this->session->set_flashdata('alert', validation_errors());
  redirect('denuncia-archivada');
  }

}

  /**
   *  validar DNI de Denunc ocupacion como unica
   *
   *  @author 		John Evert Aleman Orellana
   *  @copyright 	Gobierno Autonomo Municipal de Cochabamba
   *  @version		1.0  2018-02-20
   *  @return 		BOOLEAN
   */
  public function check_dni_denunciante($dni){
     $cantidad_dni    =   $this->main->total('denunciante', array('dni_denunciante'=>$dni, 'id_denunciante'=>$this->input->post('id_denunciante')));
     if ($cantidad_dni == 1)
     {
        return TRUE;
     }

     else
     {

       $this->form_validation->set_message('check_dni', lang('dni.existe'));
       return FALSE;
     }
  }








 }
