<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Historial extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->servidor)
        login();
  }
  function index(){
      $this->load->view('historial/fechas');
  }
  function generar_historial(){
    $this->form_validation->set_rules('historial[fecha_inicial]', lang('fecha.inicial'), 'trim|required');
    $this->form_validation->set_rules('historial[fecha_final]', lang('fecha.final'), 'trim|required');

    $historial = $this->input->post('historial');
    $data['fecha_final'] = $historial['fecha_final'];
    $data['fecha_inicial']= $historial['fecha_inicial'];
    if($historial['fecha_inicial'] <= $historial['fecha_final']){
      $id_usuario=$this->session->servidor->id_usuario;
      $data['datos_centro'] = $this->main->get('usuario',array('id_usuario'=> $id_usuario),array('centro'=>'id_centro'));

      //$data['id_centro'] = $this->session->servidor->id_centro;
      $usuario_logeado = $this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
      $data['usuario_logeado'] = $usuario_logeado;
      $data['denuncias'] = $this->main->getListOrder('denuncia', array('id_denuncia'=>'ASC'), array('denuncia.id_usuario'=>$id_usuario,'fecha_denuncia >=' => $historial['fecha_inicial'],'fecha_denuncia <=' => $historial['fecha_final']), null, null, array('denunciante'=>'id_denunciante','victima'=>'id_victima','denunciado'=>'id_denunciado'));

      $this->load->view('historial/ver_denuncia',$data);
    }else{
       $this->session->set_flashdata('alert', validation_errors());
       redirect('reporte-index');
    }
  }

}
