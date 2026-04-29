<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stat extends CI_Controller{

  public function __construct()
  {
    parent::__construct();

  }

  function cantidad_victimas_VM()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');
    $anio = $this->session->gestion;
    if(!empty($this->session->servidor->id_centro))
      $id_centro=$this->session->servidor->id_centro;

    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';
    $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
    $data['usuario_logeado'] =$usuario_logeado;
    $where['fecha_denuncia >='] = $inicio;
    $where['fecha_denuncia <='] = $fin;
    $where['sexo !='] ='';
    if(!empty($id_centro))
       $where['id_centro ='] = $id_centro;

    //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
    ///* VICTIMAS POR GENERO */
    $select_denuncia = 'victima.sexo AS name, COUNT(victima.sexo) AS y';
    $victimas_VM = $this->main->getListSelect('denuncia', $select_denuncia, array('name'=>'ASC'), $where, null, null, array('victima'=>'id_victima'), 'victima.sexo');

    $i=0; $total=0;
    foreach ($victimas_VM as $value) {
      $vic[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
      $total = $total + (int)$value->y;
      $i++;

    }
    $data['victimas_VM'] = $vic;
    $data['anio'] = $anio;
    $data['total'] = $total;
    $data['tabla_victimas_VM'] = $victimas_VM;

    if($this->input->post('print_vic_VM'))
    {


      $this->load->view('estadistica/reporte_cantidad_victimas_VM', $data);

    }

    else
    {
      $this->load->view('estadistica/cantidad_victimas_VM', $data);

    }
  }

  /**
	 * Lista los usuarios registrados
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-19
	 * @return 			VOID
	 */



function cantidad_denunciados_parentescos()
{
  $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

  $anio = $this->session->gestion;
  if(!empty($this->session->servidor->id_centro))
    $id_centro=$this->session->servidor->id_centro;

  $inicio = $anio.'-01-01';
  $fin = $anio.'-12-31';

  $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
  $data['usuario_logeado'] =$usuario_logeado;
  $where['fecha_denuncia >='] = $inicio;
  $where['fecha_denuncia <='] = $fin;
  $where['parentesco_victima !='] ='';
  if(!empty($id_centro))
     $where['id_centro ='] = $id_centro;

  //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
  ///* VICTIMAS POR GENERO */
  $select_denunciado = 'denuncia.parentesco_victima AS name, COUNT(denuncia.parentesco_victima) AS y';
  $denunciados_parentescos = $this->main->getListSelect('denuncia', $select_denunciado, array('name'=>'ASC'), $where, null, null, array('denunciado'=>'id_denunciado'), 'denuncia.parentesco_victima');

  $i=0; $total=0;
  foreach ($denunciados_parentescos as $value) {
    $den[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
    $total = $total + (int)$value->y;
    $i++;
  }
  $data['denunciados_parentescos'] = $den;
  $data['anio'] = $anio;
  $data['tabla_denunciados_parentescos'] = $denunciados_parentescos;
  $data['total'] = $total;

  if($this->input->post('print_denun_paren'))
  {

    $this->load->view('estadistica/reporte_denunciados_parentesco', $data);
  }

  else
  {
    $this->load->view('estadistica/cantidad_denunciados_parentesco', $data);

  }




}

/**
 * Lista los usuarios registrados
 *
 * @copyright		Gobierno Autonomo Municipal de Cochabamba
 * @author			Ing. John Evert Aleman Orellana
 * @version			1.0  2018-02-19
 * @return 			VOID
 */
 function cantidad_denuncia_instancia()
 {
   $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

   $anio = $this->session->gestion;
   if(!empty($this->session->servidor->id_centro))
    $id_centro=$this->session->servidor->id_centro;

   $inicio = $anio.'-01-01';
   $fin = $anio.'-12-31';

   $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
   $data['usuario_logeado'] =$usuario_logeado;
   $where['fecha_denuncia >='] = $inicio;
   $where['fecha_denuncia <='] = $fin;
   $where['instancias_jurisdicionales !='] ='';
   if(!empty($id_centro))
      $where['id_centro ='] = $id_centro;

   //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
   ///* VICTIMAS POR GENERO */
   $select_denuncia_ins = 'area_legal.instancias_jurisdicionales AS name, COUNT(area_legal.instancias_jurisdicionales) AS y';
   $denuncia_instancias = $this->main->getListSelect('area_legal', $select_denuncia_ins, array('name'=>'ASC'), $where, null, null, array('denuncia'=>'id_denuncia'), 'area_legal.instancias_jurisdicionales');

   //$den=0;
   $i=0; $total=0;
   foreach ($denuncia_instancias as $value) {
     $den[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
     $total = $total + (int)$value->y;
     $i++;
   }
   $data['denuncia_instancias'] = $den;
   $data['anio'] = $anio;
   $data['tabla_denuncia_instancias'] = $denuncia_instancias;
   $data['total'] = $total;

   if($this->input->post('print_denun_paren'))
   {

     $this->load->view('estadistica/reporte_cantidad_denuncias_instancias', $data);
   }

   else
   {
     $this->load->view('estadistica/cantidad_denuncias_instancias', $data);

   }


 }

 /**
  * Lista los usuarios registrados
  *
  * @copyright		Gobierno Autonomo Municipal de Cochabamba
  * @author			Ing. Maira Quiroz Acevedo
  * @version			1.0  2018-11-19
  * @return 			VOID
  */
  function cantidad_denuncia_acogida()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $anio = $this->session->gestion;
    if(!empty($this->session->servidor->id_centro))
      $id_centro=$this->session->servidor->id_centro;

    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';
    $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
    $data['usuario_logeado'] =$usuario_logeado;
    $where['fecha_denuncia >='] = $inicio;
    $where['fecha_denuncia <='] = $fin;
    $where['acogida !='] = '';
    if(!empty($id_centro))
       $where['id_centro ='] = $id_centro;


    //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
    ///* DENUNCIAS EN SITUACION DE ACOGIDA */
    $select_denuncia_acog = 'COUNT(area_social.acogida) AS y';
    $denuncia_acogidas = $this->main->getListSelect('area_social', $select_denuncia_acog, null, $where, null, null, array('denuncia'=>'id_denuncia'));


    $where_den['fecha_denuncia >='] = $inicio;
    $where_den['fecha_denuncia <='] = $fin;
    if(!empty($id_centro))
       $where_den['id_centro ='] = $id_centro;
    $select_total_denuncia = 'COUNT(denuncia.id_denuncia) AS total';
    $total_denuncias =$this->main->getListSelect('denuncia',$select_total_denuncia,null,$where_den);

    $where_sin['fecha_denuncia >='] = $inicio;
    $where_sin['fecha_denuncia <='] = $fin;
    $where_sin['acogida ='] = '';
    if(!empty($id_centro))
       $where_sin['id_centro ='] = $id_centro;
    $select_denuncia_acog = 'COUNT(area_social.acogida) AS sin';
    $denuncia_sin_acogidas = $this->main->getListSelect('area_social', $select_denuncia_acog, null, $where_sin, null, null, array('denuncia'=>'id_denuncia'));

    $data['tabla_denuncia_acogidas'] = $denuncia_acogidas;
    $data['tabla_denuncia_sin_acogidas'] = $denuncia_sin_acogidas;
    $data['tabla_denuncia'] = $total_denuncias;


    $data['anio'] = $anio;



    if($this->input->post('print_denun_acogida'))
    {

      $this->load->view('estadistica/reporte_cantidad_denuncias_acogida', $data);
    }

    else
    {
      $this->load->view('estadistica/cantidad_denuncias_acogida', $data);

    }

  }


  function cantidad_procedencia_denuncia()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $anio = $this->session->gestion;
    if(!empty($this->session->servidor->id_centro))
      $id_centro=$this->session->servidor->id_centro;

    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';
    $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
    $data['usuario_logeado'] =$usuario_logeado;
    $where['fecha_denuncia >='] = $inicio;
    $where['fecha_denuncia <='] = $fin;
    if(!empty($id_centro))
       $where['id_centro ='] = $id_centro;
    $where['procedencia !='] ='';

    //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
    ///* denunciante por procedencia */
    $select_denunciante = 'denuncia.procedencia AS name, COUNT(denuncia.procedencia) AS y';
    $denunciantes_procedencia = $this->main->getListSelect('denunciante', $select_denunciante, array('name'=>'ASC'), $where, null, null, array('denuncia'=>'id_denunciante'), 'denuncia.procedencia');
    $i=0; $total=0;
    foreach($denunciantes_procedencia as $value){
      $den[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
      $total = $total + (int)$value->y;
      $i++;
    }
    $data['denunciantes_procedencia'] = $den;
    $data['anio'] = $anio;
    $data['tabla_denunciantes_procedencia'] = $denunciantes_procedencia;
    $data['total'] = $total;

    if($this->input->post('print_denun_proced'))
    {

      $this->load->view('estadistica/reporte_cantidad_denunciante_procedencia', $data);
    }

    else
    {
      $this->load->view('estadistica/cantidad_denunciante_procedencia', $data);

    }


  }
  function cantidad_denuncia_tipologia()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $anio = $this->session->gestion;
    if(!empty($this->session->servidor->id_centro))
      $id_centro=$this->session->servidor->id_centro;

    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';
    $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
    $data['usuario_logeado'] =$usuario_logeado;
    $where['fecha_denuncia >='] = $inicio;
    $where['fecha_denuncia <='] = $fin;
    $where['tipologia !='] = '';
    if(!empty($id_centro))
       $where['id_centro ='] = $id_centro;


    //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
    ///* DENUNCIAS EN SITUACION DE ACOGIDA */
    $select_denuncia_tipol = 'denuncia.tipologia AS name, COUNT(denuncia.tipologia) AS y';
    $denuncia_tipologias = $this->main->getListSelect('denuncia', $select_denuncia_tipol, null, $where,null,null,null, 'denuncia.tipologia');
    $i=0; $total=0;
    foreach ($denuncia_tipologias as $value) {
      $den[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
      $total = $total + (int)$value->y;
      $i++;
    }

    $data['denuncia_tipologias'] = $den;
    $data['anio'] = $anio;
    $data['tabla_denuncia_tipologia'] = $denuncia_tipologias;
    $data['total'] = $total;



    if($this->input->post('print_denun_tipologia'))
    {

      $this->load->view('estadistica/reporte_cantidad_denuncias_tipologias', $data);
    }

    else
    {
      $this->load->view('estadistica/cantidad_denuncias_tipologias', $data);

    }

  }

  function cantidad_denuncias_area()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $anio = $this->session->gestion;


    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';
    $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
    $data['usuario_logeado'] =$usuario_logeado;
    $where['fecha_denuncia >='] = $inicio;
    $where['fecha_denuncia <='] = $fin;
    $where['derivacion !='] = '';
    if(!empty($this->session->servidor->id_centro))
       $where['id_centro ='] = $this->session->servidor->id_centro;
     $select_derivacion = 'derivacion';
     $denuncias_derivacion= $this->main->getListSelect('denuncia', 'derivacion', null, $where,null,null,null, 'derivacion');
     $cant1=0;$cant2=0;$cant3=0; $total=0;

     foreach ($denuncias_derivacion as $derivacion){
         $array = explode(",", $derivacion->derivacion);
         foreach ($array as $valor) {
           //print_r($valor);
           if (trim($valor) == 'AREA PSICOLOGICA') {
               $cant1=$cant1+1;
               //echo("individual");
           }
           if (trim($valor) == 'AREA SOCIAL') {
               $cant2=$cant2+1;
               //echo("familiar");
           }

           if (trim($valor) == 'NINGUNO') {
               $cant3=$cant3+1;
               //echo("ninguno");
           }
         }
       }
       $this->main->update('tipo_areas', array('cantidad_area'=>$cant1), array('area'=>'AREA PSICOLOGICA'));
       $this->main->update('tipo_areas', array('cantidad_area'=>$cant2), array('area'=>'AREA SOCIAL'));
       $this->main->update('tipo_areas', array('cantidad_area'=>$cant3), array('area'=>'NINGUNO'));


       $select_areas = 'area AS name, cantidad_area AS y';
       $grupos_areas = $this->main->getListSelect('tipo_areas',$select_areas);
       $i=0; $total=0;
       foreach($grupos_areas as $value) {
         $den[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
         $total = $total + (int)$value->y;
         $i++;
       }


    $data['tipos_areas'] = $den;
    $data['anio'] = $anio;
    $data['tabla_denuncia_area'] = $grupos_areas;
    $data['total'] = $total;



    if($this->input->post('print_denun_derivacion'))
    {

      $this->load->view('estadistica/reporte_denuncias_por_areas', $data);
    }

    else
    {
      $this->load->view('estadistica/cantidad_denuncias_por_areas', $data);

    }

  }

  function cantidad_denuncias_intervenciones()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $anio = $this->session->gestion;

    if(!empty($this->session->servidor->id_centro))
      $id_centro=$this->session->servidor->id_centro;

    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';
    $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
    $data['usuario_logeado'] =$usuario_logeado;
    $where['fecha >='] = $inicio;
    $where['fecha <='] = $fin;
    $where['visita !='] = '';

    if(!empty($id_centro))
       $where['id_centro ='] = $id_centro;

    $select_visita = 'visita';
    $denuncias_intervenciones= $this->main->getListSelect('area_psicologica', 'visita', null, $where,null,null,null, 'visita');
    $cant1=0;$cant2=0;$cant3=0;$cant4=0;$cant5=0;$cant6=0; $total=0;

    foreach ($denuncias_intervenciones as $intervencion){
            $array = explode(",", $intervencion->visita);
            foreach ($array as $valor) {
              //print_r($valor);
              if (trim($valor) == 'NOTA INFORME') {
                  $cant1=$cant1+1;
                  //echo("individual");
              }
              if (trim($valor) == 'INFORME DE CONTENCIÓN') {
                  $cant2=$cant2+1;
                  //echo("familiar");
              }

              if (trim($valor) == 'INFORME DE SEG. PSICOLÓGICO') {
                  $cant3=$cant3+1;
                  //echo("ninguno");
              }
              if (trim($valor) == 'INFORME PSICOLÓGICO') {
                  $cant4=$cant4+1;
                  //echo("ninguno");
              }
              if (trim($valor) == 'ABORDAJE PSICOLÓGICO') {
                  $cant5=$cant5+1;
                  //echo("ninguno");
              }
              if (trim($valor) == 'ABORDAJE PSICOSOCIAL') {
                  $cant6=$cant6+1;
                  //echo("ninguno");
              }

            }
          }
          $this->main->update('tipo_intervenciones_psicologicas', array('cantidad'=>$cant1), array('intervencion'=>'NOTA INFORME'));
          $this->main->update('tipo_intervenciones_psicologicas', array('cantidad'=>$cant2), array('intervencion'=>'INFORME DE CONTENCIÓN'));
          $this->main->update('tipo_intervenciones_psicologicas', array('cantidad'=>$cant3), array('intervencion'=>'INFORME DE SEG. PSICOLÓGICO'));
          $this->main->update('tipo_intervenciones_psicologicas', array('cantidad'=>$cant4), array('intervencion'=>'INFORME PSICOLÓGICO'));
          $this->main->update('tipo_intervenciones_psicologicas', array('cantidad'=>$cant5), array('intervencion'=>'ABORDAJE PSICOLÓGICO'));
          $this->main->update('tipo_intervenciones_psicologicas', array('cantidad'=>$cant6), array('intervencion'=>'ABORDAJE PSICOSOCIAL'));




          $select_intevencion = 'intervencion AS name, cantidad AS y';
          $grupos_intervencion = $this->main->getListSelect('tipo_intervenciones_psicologicas',$select_intevencion);
          $i=0; $total=0;
          foreach($grupos_intervencion as $value) {
            $den[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
            $total = $total + (int)$value->y;
            $i++;
          }

          $data['psicologica_visita'] = $den;
          $data['anio'] = $anio;
          $data['tabla_psicologica_visita'] = $grupos_intervencion;
          $data['total'] = $total;



    if($this->input->post('print_denun_inter'))
    {

      $this->load->view('estadistica/reporte_denuncias_visitas', $data);
    }

    else
    {
      $this->load->view('estadistica/cantidad_denuncias_intervenciones', $data);

    }

  }

  function cantidad_denuncias_terapia()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $anio = $this->session->gestion;

    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';
    $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
    $data['usuario_logeado'] =$usuario_logeado;
    $where['fecha >='] = $inicio;
    $where['fecha <='] = $fin;
    $where['grupo_terapia !='] = '';

    if(!empty($this->session->servidor->id_centro))
       $where['id_centro ='] = $this->session->servidor->id_centro;
    //$grupo='TERAPIA DE PAREJA';


    //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
    ///* DENUNCIAS EN SITUACION DE ACOGIDA */
    $select_denuncia_terapia = 'grupo_terapia';
    $denuncias_grupo_terap = $this->main->getListSelect('area_psicologica', 'grupo_terapia', null, $where,null,null,array('denuncia'=>'id_denuncia'), 'area_psicologica.grupo_terapia');
    $cant1=0;$cant2=0;$cant3=0;$cant4=0;$cant5=0; $total=0;

    foreach ($denuncias_grupo_terap as $grupo){
      $array = explode(",", $grupo->grupo_terapia);
      foreach ($array as $valor) {
        //print_r($valor);
        if (trim($valor) == 'TERAPIA INDIVIDUAL') {
            $cant1=$cant1+1;
            //echo("individual");
        }
        if (trim($valor) == 'TERAPIA FAMILIAR') {
            $cant2=$cant2+1;
            //echo("familiar");
        }
        if (trim($valor) == 'TERAPIA DE PAREJA') {

            $cant3=$cant3+1;
            //echo("pareja");
        }
        if (trim($valor) == 'TERAPIA OCUPACIONAL') {
            $cant4=$cant4+1;
            //echo("ocupacional");
        }
        if (trim($valor) == 'NINGUNO') {
            $cant5=$cant5+1;
            //echo("ninguno");
        }
      }
    }
    $this->main->update('tipo_grupo_terapia', array('cantidad'=>$cant1), array('grupo_terapia'=>'TERAPIA INDIVIDUAL'));
    $this->main->update('tipo_grupo_terapia', array('cantidad'=>$cant2), array('grupo_terapia'=>'TERAPIA FAMILIAR'));
    $this->main->update('tipo_grupo_terapia', array('cantidad'=>$cant3), array('grupo_terapia'=>'TERAPIA DE PAREJA'));
    $this->main->update('tipo_grupo_terapia', array('cantidad'=>$cant4), array('grupo_terapia'=>'TERAPIA OCUPACIONAL'));
    $this->main->update('tipo_grupo_terapia', array('cantidad'=>$cant5), array('grupo_terapia'=>'NINGUNO'));





    $select_grupos = 'grupo_terapia AS name, cantidad AS y';
    $grupos_terapia = $this->main->getListSelect('tipo_grupo_terapia',$select_grupos);
    $i=0; $total=0;
    foreach($grupos_terapia as $value) {
      $den[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
      $total = $total + (int)$value->y;
      $i++;
    }


      $data['psicologica_terapia'] = $den;
      $data['anio'] = $anio;
      $data['tabla_psicologica_terapia'] = $grupos_terapia;
      $data['total'] = $total;



    if($this->input->post('print_denun_terapia'))
    {

      $this->load->view('estadistica/reporte_cantidad_denuncias_terapia', $data);
    }

    else
    {
      $this->load->view('estadistica/cantidad_denuncias_terapia', $data);

    }

  }

  function cantidad_denuncias_intervencion_social()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $anio = $this->session->gestion;
    if(!empty($this->session->servidor->id_centro))
      $id_centro=$this->session->servidor->id_centro;

    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';

    $usuario_logeado=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
    $data['usuario_logeado'] =$usuario_logeado;
    $where['fecha >='] = $inicio;
    $where['fecha <='] = $fin;
    $where['visita !='] = '';
    if(!empty($id_centro))
       $where['id_centro ='] = $id_centro;


    //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
    ///* DENUNCIAS EN SITUACION DE ACOGIDA */

        $select_visita = 'visita';
        $denuncias_intervenciones= $this->main->getListSelect('area_social', 'visita', null, $where,null,null,null, 'visita');
        $cant1=0;$cant2=0;$cant3=0;$cant4=0;$cant5=0; $total=0;

        foreach ($denuncias_intervenciones as $intervencion){
                $array = explode(",", $intervencion->visita);
                foreach ($array as $valor) {
                  //print_r($valor);
                  if (trim($valor) == 'NOTA INFORME') {
                      $cant1=$cant1+1;
                      //echo("individual");
                  }
                  if (trim($valor) == 'INFORME DE SEGUIMIENTO SOCIAL') {
                      $cant2=$cant2+1;
                      //echo("familiar");
                  }

                  if (trim($valor) == 'INFORME DE SOCIAL') {
                      $cant3=$cant3+1;
                      //echo("ninguno");
                  }
                  if (trim($valor) == 'ABORDAJE SOCIAL') {
                      $cant4=$cant4+1;
                      //echo("ninguno");
                  }

                  if (trim($valor) == 'ABORDAJE PSICOSOCIAL') {
                      $cant6=$cant5+1;
                      //echo("ninguno");
                  }

                }
              }
              $this->main->update('intervencion_social', array('cantidad'=>$cant1), array('intervencion'=>'NOTA INFORME'));
              $this->main->update('intervencion_social', array('cantidad'=>$cant2), array('intervencion'=>'INFORME DE SEGUIMIENTO SOCIAL'));
              $this->main->update('intervencion_social', array('cantidad'=>$cant3), array('intervencion'=>'INFORME SOCIAL'));
              $this->main->update('intervencion_social', array('cantidad'=>$cant4), array('intervencion'=>'ABORDAJE SOCIAL'));
              $this->main->update('intervencion_social', array('cantidad'=>$cant5), array('intervencion'=>'ABORDAJE PSICOSOCIAL'));




              $select_intevencion = 'intervencion AS name, cantidad AS y';
              $grupos_intervencion = $this->main->getListSelect('intervencion_social',$select_intevencion);
              $i=0; $total=0;
              foreach($grupos_intervencion as $value) {
                $den[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
                $total = $total + (int)$value->y;
                $i++;
              }

    $data['social_visita'] = $den;
    $data['anio'] = $anio;
    $data['tabla_social_visita'] = $grupos_intervencion;
    $data['total'] = $total;



    if($this->input->post('print_denun_visita'))
    {

      $this->load->view('estadistica/reporte_cantidad_denuncias_visitas_sociales', $data);
    }

    else
    {
      $this->load->view('estadistica/cantidad_denuncias_visitas_sociales', $data);

    }

  }

  function cantidad_denuncias_arch_cerr()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

    $anio = $this->session->gestion;
    if(!empty($this->session->servidor->id_centro))
      $id_centro=$this->session->servidor->id_centro;

    $inicio = $anio.'-01-01';
    $fin = $anio.'-12-31';


    $where_den['fecha_denuncia >='] = $inicio;
    $where_den['fecha_denuncia <='] = $fin;
    if(!empty($id_centro))
       $where_den['id_centro ='] = $id_centro;
    $select_total_denuncia = 'COUNT(denuncia.id_denuncia) AS total';
    $total_denuncias =$this->main->getListSelect('denuncia',$select_total_denuncia,null,$where_den);
    //$total_denuncias=$total_den['total'];




    $where['fecha_denuncia >='] = $inicio;
    $where['fecha_denuncia <='] = $fin;
    $valor=1;
    $where['denuncia_archivada ='] = $valor;

    if(!empty($id_centro))
       $where['id_centro ='] = $id_centro;

    $select_denuncia_archivada = 'denuncia.tipologia AS name, COUNT(denuncia.denuncia_archivada) AS y';
    $denuncia_archivada = $this->main->getListSelect('denuncia', $select_denuncia_archivada, null, $where,null,null,null, 'denuncia.tipologia');
    $i=0; $total_arch=0;
    foreach ($denuncia_archivada as $value) {
      $archi[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
      $total_arch = $total_arch + (int)$value->y;
      $i++;
    }

  //  $data['denuncia_archivada'] = $archi;
    $data['anio'] = $anio;
    $data['tabla_denuncia_archivada'] = $denuncia_archivada;




    $where_c['fecha_denuncia >='] = $inicio;
    $where_c['fecha_denuncia <='] = $fin;
    $where_c['denuncia_cerrada ='] = $valor;

    if(!empty($id_centro))
      $where_c['id_centro ='] = $id_centro;


    //$this->breadcrumbs->push('Estadísticas', 'cantidad-victimas-por-genero');
    ///* DENUNCIAS EN SITUACION DE ACOGIDA */
    $select_denuncia_cerrada = 'denuncia.tipologia AS name, COUNT(denuncia.denuncia_cerrada) AS y';
    $denuncia_cerrada = $this->main->getListSelect('denuncia', $select_denuncia_cerrada, null, $where_c,null,null,null, 'denuncia.tipologia');
    $i=0; $total_cerr=0;
    foreach ($denuncia_cerrada as $value) {
      $cerr[$i] = array('name'=>$value->name, 'y'=>(int)$value->y);
      $total_cerr = $total_cerr + (int)$value->y;
      $i++;
    }





    //$data['denuncia_cerrada'] = $cerr;
    $data['anio'] = $anio;
    $data['tabla_denuncia_cerrada'] = $denuncia_cerrada;

    $data['total_denuncias'] = $total_denuncias;


      $usuario_logeado =$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
      $data['usuario_logeado'] =$usuario_logeado;


    if($this->input->post('print_denun_arch_cerr'))
    {

      $this->load->view('estadistica/reporte_cantidad_denuncias_archivadas', $data);
    }
    else {
        $this->load->view('estadistica/cantidad_denuncias_arch_cerr', $data);
    }



  }



}
