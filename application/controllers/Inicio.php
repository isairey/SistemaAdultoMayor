<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio extends CI_Controller{

  public function __construct()
  {
     parent:: __construct();

     if(!$this->session->servidor)
        login();
  }

  function index()
  {
    $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

     //$data['anio'] = $this->session->userdata('gestion');

     //$data['monto'] = $this->main->getSelect('pago', 'SUM(monto) AS pagar', array('anio'=>$this->session->userdata('gestion')), array('gestion'=>'id_gestion'));
     //$data['dinero'] = $this->main->getSelect('pago', 'SUM(monto) AS pagado', array('anio'=>$this->session->userdata('gestion'), 'pago.estado'=>'DC'), array('gestion'=>'id_gestion'));

     //$beneficiarios = $this->main->getListSelect('pago', 'id_beneficiario', array('id_beneficiario'=>'ASC') ,array('anio'=>$data['anio']), null, null, array('gestion'=>'id_gestion'), 'id_beneficiario');
     //$data['beneficiarios'] = count($beneficiarios);

     //$cobradores = $this->main->getListSelect('pago', 'id_beneficiario', array('id_beneficiario'=>'ASC'), array('pago.estado'=>'DC', 'anio'=>$data['anio']), null, null, array('gestion'=>'id_gestion'), 'id_beneficiario');
     //$data['cobradores'] = count($cobradores);



     //$this->load->view('inicio/index',$data);
      $this->load->view('inicio/index');
      //$this->load->view('administrador/usuario');
  }



}
