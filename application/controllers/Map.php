<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Map extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    if(!$this->session->servidor)
        login();
  }
  function index(){
      $this->load->view('mapa/index');
  }
}
