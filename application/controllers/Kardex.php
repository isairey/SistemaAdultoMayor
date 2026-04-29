<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kardex extends CI_Controller{

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
  public function detallekardex()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>' . $this->session->servidor->nombres . ' ' . $this->session->servidor->paterno . nbs(5) . '<i class="fa fontello-calendar"></i>' . fecha(date('Y-m-d')) . '</div>', 'inicio');

    $id_centro = $this->main->getField('usuario', 'id_centro', array('id_usuario' => $this->session->servidor->id_usuario));
    if (!empty($id_centro)) {
      $nombre_centro = $this->main->getField('centro', 'nombre_centro', array('id_centro' => $this->session->servidor->id_centro));
    }
    $data['sexos'] = array('FEMENINO' => 'FEMENINO', 'MASCULINO' => 'MASCULINO');
    $data['subalcaldia'] = array(
      'SUBALCALDIA ADELA ZAMUDIO' => 'SUBALCALDIA ADELA ZAMUDIO',
      'SUBALCALDIA TUNARI-EPI NORTE' => 'SUBALCALDIA TUNARI-EPI NORTE',
      'SUBALCALDIA MOLLE' => 'SUBALCALDIA MOLLE',
      'SUBALCALDIA ALEJO CALATAYUD' => 'SUBALCALDIA ALEJO CALATAYUD',
      'SUBALCALDIA ITOCTA-EPI SUR' => 'SUBALCALDIA ITOCTA-EPI SUR',
      'SUBALCALDIA VALLE HERMOSO' => 'SUBALCALDIA VALLE HERMOSO',
    );
    $data['estados'] = array('SOLTERO' => 'SOLTERO', 'CASADO' => 'CASADO', 'CONVIVIENTE' => 'CONVIVIENTE', 'DIVORCIADO' => 'DIVORCIADO', 'SEPARADO' => 'SEPARADO', 'VIUDO' => 'VIUDO');
    $data['expedidos'] = array('COCHABAMBA' => 'COCHABAMBA', 'LA PAZ' => 'LA PAZ', 'ORURO' => 'ORURO', 'POTOSI' => 'POTOSI', 'SUCRE' => 'SUCRE', 'TARIJA' => 'TARIJA', 'SANTA CRUZ' => 'SANTA CRUZ', 'PANDO' => 'PANDO', 'BENI' => 'BENI');
    $parentescos = $this->main->getListSelect('parentesco', 'id_parentesco, nombre', array('nombre' => 'ASC'));
    $data['parentescos'] = $this->main->dropdown($parentescos, '');

    $nombre_rol = $this->session->servidor->rol;
    $data['nombre_rol'] = $nombre_rol;

    if ($nombre_rol == 'ADMINISTRADOR' || $nombre_rol == 'REVISOR') {
      $data['parte_area'] = 'TODOS';
      $data['kardexs'] = $this->main->getListOrder('kardex', null, array('kardex.estado' => 'AC'));
    } else {
      $parte = explode(" ", $nombre_rol);
      $parte_rol = $parte[0];
      $data['parte_area'] = $parte[1];
      if ($parte_rol == 'FUNCIONARIO') {
        $data['kardexs'] = $this->main->getListOrder('kardex', null, array('kardex.id_centro' => $id_centro, 'kardex.estado' => 'AC'));
      }
    }

    setcookie("demo", $this->db->last_query(), time() + 86500);
    $this->load->view('kardex/detalle_kardexs', $data);
  }
	/*public function detallekardex()
	{
    //b_internal_encoding("UTF-8");
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');
    $id_centro= $this->main->getField('usuario', 'id_centro', array('id_usuario'=>$this->session->servidor->id_usuario));
    if(!empty($id_centro))
      $nombre_centro= $this->main->getField('centro', 'nombre_centro', array('id_centro'=>$this->session->servidor->id_centro));
      $data['sexos'] = array('FEMENINO'=>'FEMENINO', 'MASCULINO'=>'MASCULINO');
      $data['subalcaldia'] = array('SUBALCALDIA ADELA ZAMUDIO'=>'SUBALCALDIA ADELA ZAMUDIO', 'SUBALCALDIA TUNARI-EPI NORTE'=>'SUBALCALDIA TUNARI-EPI NORTE', 'SUBALCALDIA MOLLE'=>'SUBALCALDIA MOLLE', 'SUBALCALDIA ALEJO CALATAYUD'=>'SUBALCALDIA ALEJO CALATAYUD', 'SUBALCALDIA ITOCTA-EPI SUR'=>'SUBALCALDIA ITOCTA-EPI SUR', 'SUBALCALDIA VALLE HERMOSO'=>'SUBALCALDIA VALLE HERMOSO');
      $data['estados'] = array('SOLTERO'=>'SOLTERO', 'CASADO'=>'CASADO','CONVIVIENTE'=>'CONVIVIENTE','DIVORCIADO'=>'DIVORCIADO','SEPARADO'=>'SEPARADO','VIUDO'=>'VIUDO');
      $data['expedidos'] = array('COCHABAMBA'=>'COCHABAMBA', 'LA PAZ'=>'LA PAZ', 'ORURO'=>'ORURO', 'POTOSI'=>'POTOSI','SUCRE'=>'SUCRE','TARIJA'=>'TARIJA','SANTA CRUZ'=>'SANTA CRUZ','PANDO'=>'PANDO','BENI'=>'BENI');
      $parentescos =	$this->main->getListSelect('parentesco', 'id_parentesco, nombre', array('nombre'=>'ASC'));
      $data['parentescos'] = $this->main->dropdown($parentescos, '');


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
      $id_gestion = $this->main->getField('gestion', 'id_gestion', array('gestion'=>$gestion));
      if($nombre_rol == 'ADMINISTRADOR'|| $nombre_rol == 'REVISOR')
        $data['kardexs'] = $this->main->getListOrder('kardex', null, array('kardex.id_gestion'=>$id_gestion, 'kardex.estado' =>'AC'));
      else if($parte_rol == 'FUNCIONARIO')
        $data['kardexs'] = $this->main->getListOrder('kardex', null, array('kardex.id_centro'=>$id_centro, 'kardex.id_gestion'=>$id_gestion, 'kardex.estado' =>'AC'));
      setcookie("demo",$this->db->last_query(),time()+86500);

      //echo '<pre>'; var_dump($data); exit; echo '</pre>';

    $this->load->view('kardex/detalle_kardexs', $data);
	}*/
  public function editkardex()
	{
    mb_internal_encoding("UTF-8");

    $this->form_validation->set_rules('kardex[nombre_completo]', lang('nombre.completo'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[dni]', lang('dni'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[domicilio]', lang('domicilio'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[fecha_nacimiento]', lang('fecha.nacimiento'), 'trim|required');
    $this->form_validation->set_rules('kardex[sexo]', lang('sexo'), 'trim|mb_strtoupper');
		$this->form_validation->set_rules('kardex[distrito]', lang('distrito'), 'trim|mb_strtoupper');
		$this->form_validation->set_rules('kardex[subalcaldia]', lang('subalcaldia'), 'trim|mb_strtoupper');

		if($this->form_validation->run())
		{
      $id_kardex = $this->input->post('id_kardex');
      $kardex = $this->input->post('kardex');

      $dni = $kardex['dni'];

      $existe_kardex = $this->main->total('kardex', array('dni'=>$kardex['dni']));

      if($existe_kardex == 0){

        $id_kardex = $this->main->insert('kardex',$kardex);
      }
      else{
        $this->main->update('kardex', $kardex, array('id_kardex'=>$id_kardex));
      }


    	$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('kardex');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('kardex');
		}

  }

  /**
	 * Recibe mediante POST los datos de la denuncia para insertar detalles al kardex de un adulto mayor
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-11-12
	 * @return 			VOID
	 */
	public function insertardetalle()
	{
    mb_internal_encoding("UTF-8");
    $this->form_validation->set_rules('kardex[telefono]', lang('telefono'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[celular]',lang('celular'),'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[estado_civil]', lang('estado.civil'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[instruccion]', lang('instruccion'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[ocupacion]', lang('ocupacion'), 'trim|mb_strtoupper');
    //$this->form_validation->set_rules('kardex[idioma]', lang('idioma'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[nro_hijos]', lang('nro.hijos'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[nro_nietos]', lang('nro.nietos'), 'trim|mb_strtoupper');



		if($this->form_validation->run())
		{

      $id_kardex = $this->input->post('id_kardex');
      $kardex = $this->input->post('kardex');

      $idioma = $this->input->post('kardexidioma');
      $cont=0;

      foreach($idioma as $valor){
        if($cont >0){

          $kardex['idioma']=$cadena.', '.$idioma[$cont];
          $cadena= $kardex['idioma'];
        }
        else{
           $kardex['idioma']=$idioma[0];
           $cadena = $kardex['idioma'];
         }


        $cont++;
      }

      $this->main->update('kardex', $kardex, array('id_kardex'=>$id_kardex));


			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('kardex');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('kardex');
		}
	}

  public function editar_vivienda()
	{
    mb_internal_encoding("UTF-8");
    $this->form_validation->set_rules('kardex[vive_con]', lang('vive.con'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[vivienda]',lang('vivienda'),'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[nombre_referencia]', lang('nombre.completo'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[telefono_referencia]', lang('telefono'), 'trim|mb_strtoupper');

		if($this->form_validation->run())
		{

      $id_kardex = $this->input->post('id_kardex');
      $kardex = $this->input->post('kardex');

      $this->main->update('kardex', $kardex, array('id_kardex'=>$id_kardex));
			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('kardex');
		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('kardex');
		}
	}
  public function editar_servicio()
	{
    mb_internal_encoding("UTF-8");
    $this->form_validation->set_rules('kardex[salud]', lang('salud'), 'trim|mb_strtoupper');
    $this->form_validation->set_rules('kardex[beneficio]',lang('beneficio'),'trim|mb_strtoupper');


		if($this->form_validation->run())
		{

      $id_kardex = $this->input->post('id_kardex');
      $kardex = $this->input->post('kardex');

      $this->main->update('kardex', $kardex, array('id_kardex'=>$id_kardex));
			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('kardex');
		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('kardex');
		}
	}

  public function subirfoto()
{

  $this->form_validation->set_rules('id_kardex', lang('identificador'), 'trim|required');

  if($this->form_validation->run())
  {
    $id_kardex = $this->input->post('id_kardex');


    echo $dni = $this->main->getField('kardex', 'dni', array('id_kardex'=>$id_kardex));
    echo $foto = $this->main->getField('kardex', 'foto', array('id_kardex'=>$id_kardex));
    $config['upload_path']     = FCPATH.'/public/fotos/adultos/';
  	$config['allowed_types']   = 'jpg|jpeg|png|gif';
  	$config['file_name']			=  'ADULTO-'.$dni;
  	$config['image_library'] 	= 'gd2';

  	$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('foto_persona'))
    {

		    $error = array('error' => $this->upload->display_errors());
    }
    else
    {
 	        $foto = $this->upload->data('file_name');
    }

	    $config_img['image_library'] = 'gd2';
			$config_img['source_image'] = FCPATH.'/public/fotos/adultos/'.$foto;
			$config_img['create_thumb'] = FALSE;
			$config_img['maintain_ratio'] = TRUE;
			$config_img['width']         = 626;
			$config_img['height']       = 840;

	      $this->load->library('image_lib', $config_img);

	      $this->image_lib->resize();
        $this->main->update('kardex', array('foto'=>$foto), array('id_kardex'=>$id_kardex));

        $this->session->set_flashdata('success', lang('registrado.correctamente'));
        redirect('kardex');
        }
        else
        {

        $this->session->set_flashdata('alert', validation_errors());
        redirect('kardex');
        }
      }


        public function registrar()
      {

        $this->form_validation->set_rules('kardex[nombre_completo]', lang('nombre.completo'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[dni]', lang('dni'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[domicilio]', lang('direccion'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[fecha_nacimiento]', lang('fecha.nacimiento'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[sexo]', lang('genero'), 'trim|required');
				$this->form_validation->set_rules('kardex[distrito]', lang('distrito'), 'trim|required');
				$this->form_validation->set_rules('kardex[subalcaldia]', lang('subalcaldia'), 'trim|required');
        $this->form_validation->set_rules('kardex[estado_civil]', lang('estado.civil'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[telefono]', lang('telefono'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[celular]', lang('celular'), 'trim|mb_strtoupper');
        $this->form_validation->set_rules('kardex[instruccion]', lang('instruccion'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[nro_hijos]', lang('nro.hijos'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[nro_nietos]', lang('nro.nietos'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[ocupacion]', lang('trabaja'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[vivienda]', lang('detalle.vivienda'), 'trim|required');
        $this->form_validation->set_rules('kardex[vive_con]', lang('vive.con'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[nombre_referencia]', lang('nombre.completo'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[telefono_referencia]', lang('telefono'), 'trim|required');
        $this->form_validation->set_rules('kardex[beneficio]', lang('kardex.beneficio'), 'trim|required|mb_strtoupper');
        $this->form_validation->set_rules('kardex[salud]', lang('kardex.salud'), 'trim|required|mb_strtoupper');
				$this->form_validation->set_rules('kardex[servicio]', lang('servicio.beneficios'), 'trim|required|mb_strtoupper');

        if($this->form_validation->run()){


            $kardex = $this->input->post('kardex');
            $idioma = $this->input->post('kardexidioma');
            $cont=0;

            foreach($idioma as $valor){
              if($cont >0){

                $kardex['idioma']=$cadena.', '.$idioma[$cont];
                $cadena= $kardex['idioma'];
              }
              else{
                 $kardex['idioma']=$idioma[0];
                 $cadena = $kardex['idioma'];
               }


              $cont++;
            }

            $kardex['id_centro']= $this->main->getField('usuario', 'id_centro', array('id_usuario'=>$this->session->servidor->id_usuario));
            $gestion = $this->session->userdata('gestion');
            $kardex['id_gestion'] = $this->main->getField('gestion', 'id_gestion', array('gestion'=>$gestion));

            $cantidad_dni = $this->main->total('kardex', array('dni'=>$kardex['dni']));

            //echo "hola".$cantidad_dni;
            if ($cantidad_dni == 0 )
            {
              $id_kardex = $this->main->insert('kardex', $kardex);
							$this->session->set_flashdata('info', lang('registrado.correctamente'));
							redirect('kardex');
            }
            else
            {
              $this->session->set_flashdata('alert', 'Ya Existe una Persona con el Carnet de Identidad Registrado');
							redirect('kardex');
            }
          
        }
        else
        {
          $this->session->set_flashdata('alert', validation_errors());
          redirect('kardex');
        }
   }
   public function ver_kardex($id_kardex)
      {
        $data['kardex'] = $this->main->get('kardex', array('id_kardex'=>$id_kardex));


        $this->load->view('kardex/ver_kardex', $data);
      }

    public function registrar_ubi(){
        $this->form_validation->set_rules('longitud', lang('longitud'), 'trim|required');
          $this->form_validation->set_rules('latitud', lang('latitud'), 'trim|required');
      if($this->form_validation->run()){
        $id_kardex = $this->input->post('id_kardex');
        $longitud = $this->input->post('longitud');
        $latitud = $this->input->post('latitud');
        $this->main->update('kardex', array('latitud'=>$latitud,'longitud'=>$longitud), array('id_kardex'=>$id_kardex));
        $this->session->set_flashdata('success', lang('registrado.correctamente'));
        redirect('kardex');
      }
      else
      {
        $this->session->set_flashdata('alert', validation_errors());
        redirect('kardex');
        }
    }


}
