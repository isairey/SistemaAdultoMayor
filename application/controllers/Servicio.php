<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicio extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

   /**
    * Un Listado del detalle de todos los cobros realizado por el beneficiario
    *
    * @return JSON
    */
  /*  function getdetalleAdulto()
  {
    $id = $this->input->get('id');
    $select = 'kardex.id_kardex, kardex.telefono,kardex.celular,kardex.ocupacion,kardex.vive_con,kardex_foto';
    //$conductor = $this->main->getSelect('conductor','*',array('conductor.id_solicitud'=>$id,'conductor.estado'=>'AC'),array('detalle_conductor'=>'id_detalle_conductor'));
    $detconductor =$this->main->getSelect('kardex',$select,array('detalle_conductor.id_detalle_conductor'=>$id),array('conductor'=>'id_detalle_conductor'));
    echo json_encode($detconductor); die();
*/

  /**
    * Un Listado del detalle de todos los cobros realizado por el beneficiario sin funcionalidad de pago
    *
    * @return JSON
    */
  function getCobros()
  {
    $id = $this->input->post('id');

    $data['beneficiario'] = $this->main->get('beneficiario', array('id_beneficiario'=>$id));

    $gestion = $this->session->userdata('gestion');

    $select = 'id_pago, nombre_gestion, monto, fecha_cobro, pago.estado, nombre_cobrador, cobrador, dni_cobrador, nro_comprobante';

    $data['pagos'] = $this->main->getListSelect('pago', $select, array('id_pago'=>'ASC') ,array('id_beneficiario'=>$id, 'gestion.anio'=>$gestion), null, null, array('gestion'=>'id_gestion'));

    $data['cobradores'] = array('BENEFICIARIO'=>'BENEFICIARIO', 'PADRE/MADRE'=>'PADRE/MADRE', 'TUTOR'=>'TUTOR', 'GUARDADOR'=>'GUARDADOR');

    $this->load->view('cobros/cobros', $data, FALSE);
  }

  /**
   * Actualiza un pago realizado y cargo todos los demas detalles de pagos
   *
   * @return JSON
   */
  function updatePago()
  {
    $id = $this->input->post('id');

    $comprobante_actual = $this->main->getField('comprobante', 'numero_actual', array('anio'=>$this->session->userdata('gestion')));
    $comprobante_actual += 1;

    $this->main->update('comprobante', array('numero_actual'=>$comprobante_actual), array('anio'=>$this->session->userdata('gestion')));

    $comprobante_actual = str_pad($comprobante_actual, 5, "0", STR_PAD_LEFT);

    $pago['nombre_cobrador'] = $this->input->post('nombre');
    $pago['dni_cobrador'] = $this->input->post('dni');
    $pago['cobrador'] = $this->input->post('cobrador');

    $estado_pago = $this->main->get('pago', array('id_pago'=>$id));

    $pago['fecha_cobro'] = date('Y-m-d H:i:s');
    $pago['mes_cobro'] = date('n');
    $pago['pagado_por'] = $this->session->userdata('servidor')->nombres.' '.$this->session->userdata('servidor')->paterno;
    $pago['id_usuario'] = $this->session->userdata('servidor')->id_usuario;
    $pago['estado'] = 'DC';
    $pago['nro_comprobante'] = substr($this->session->userdata('gestion'), 2).'-'.$comprobante_actual;


    $this->main->update('pago', $pago, array('id_pago'=>$id));

    $gestion = $this->session->userdata('gestion');

    $data['beneficiario'] = $this->main->get('beneficiario', array('id_beneficiario'=>$estado_pago->id_beneficiario));

    $select = 'id_pago, nombre_gestion, monto, fecha_cobro, pago.estado, nombre_cobrador, cobrador, dni_cobrador, nro_comprobante';

    $data['pagos'] = $this->main->getListSelect('pago', $select, array('id_pago'=>'ASC') ,array('id_beneficiario'=>$estado_pago->id_beneficiario, 'gestion.anio'=>$gestion), null, null, array('gestion'=>'id_gestion'));
    $data['cobradores'] = array('BENEFICIARIO'=>'BENEFICIARIO', 'PADRE/MADRE'=>'PADRE/MADRE', 'TUTOR'=>'TUTOR', 'GUARDADOR'=>'GUARDADOR');

    $monto_pagado_gestion = (int)$this->main->getField('gestion', 'pagado', array('id_gestion'=>$estado_pago->id_gestion));

    $this->main->update('gestion', array('pagado'=>($monto_pagado_gestion + (int)$estado_pago->monto)), array('id_gestion'=>$estado_pago->id_gestion));

    $this->load->view('cobros/cobros', $data, FALSE);
  }


   /**
    * Una Tupla de los datos del Usuario
    *
    * @return JSON
    */
  function getUsuario()
  {
    $id = $this->input->get('id');
    $usuario = $this->main->getSelect('usuario', 'id_usuario, nombres, paterno, materno, dni, usuario, id_rol,id_centro, estado',array('id_usuario'=>$id));

    echo json_encode($usuario); die();
  }
  /**
   * Una Tupla de los datos de la Denuncia
   *
   * @return JSON
   */
 function getDenuncia()
 {
   $id = $this->input->get('id');
   $select = 'denuncia.id_denuncia, denuncia.id_categoria_secundaria,denuncia.id_centro,denuncia.nombre_centro,denuncia.id_categoria,denuncia.tipologia,denuncia.subalcaldia as sa_denuncia,denuncia.distrito as dis_denuncia,denuncia.otb as otb_denuncia,denuncia.codigo_denuncia,denuncia.descripcion,denuncia.derivacion,denuncia.id_parentesco,denuncia.parentesco_victima,denuncia.datos_complementarios, denuncia.id_denunciante,denuncia.denunciante,denuncia.fecha_denuncia,denuncia.id_usuario,denuncia.registrado_por,denuncia.id_victima,denuncia.victima,denunciante.nombre_completo,denunciante.dni_denunciante,denunciante.expedido_denunciante,denunciante.genero as genero_denunciante,denunciante.fecha_nacimiento,denunciante.direccion,denunciante.telefono,denuncia.procedencia,
   victima.nombre_completo, victima.domicilio,victima.dni,victima.expedido,victima.fecha_nacimiento,victima.sexo,denunciado.id_denunciado, denunciado.nombre_completo as nombre_denunciado,denunciado.dni as denunciado_dni,denunciado.expedido_denunciado,denunciado.genero as genero_denunciado, denunciado.edad as edad_denunciado, denunciado.domicilio as domicilio_denunciado, denunciado.celular as celular_denunciado , victima.ocupacion_victima, victima.grado_victima, victima.edad_victima,victima.lugar_nacimiento_victima,victima.hijos_victima,victima.vive_victima,victima.estado_civil_victima,victima.numero_referencia_victima, victima.vivienda_victima, victima.vivienda_victima_otro, victima.idioma_victima,victima.idioma_victima_otro, victima.seguro_victima, victima.seguro_victima_otro, victima.beneficio_victima,victima.beneficio_victima_otro';
   $denuncia = $this->main->getSelect('denuncia', $select,array('denuncia.id_denuncia'=>$id),array('denunciante'=>'id_denunciante','victima'=>'id_victima','denunciado'=>'id_denunciado'));
  // $denunciado=$this->main->getSelect('denunciante','*',arrar());
   echo json_encode($denuncia); die();
 }

 function getKardex()
 {
   $id = $this->input->get('id');
   $select = '*';
   $kardex = $this->main->getSelect('kardex', $select,array('kardex.id_kardex'=>$id));
  // $denunciado=$this->main->getSelect('denunciante','*',arrar());
   echo json_encode($kardex); die();
 }
 function getKardexVic()
 {
   $id = $this->input->get('id');
   $dni= $this->main->getField('victima', 'dni', array('id_victima'=>$id));
   $select = '*';
   $kardex = $this->main->getSelect('kardex', $select,array('kardex.dni'=>$dni),null);

   echo json_encode($kardex); die();
 }
 function getInforme()
 {
   $id = $this->input->get('id');
   //$select = '';
   $informe = $this->main->getSelect('denuncia', 'area_legal.*, denuncia.id_denuncia',array('denuncia.id_denuncia'=>$id), array('area_legal'=>'id_denuncia'));

   echo json_encode($informe); die();
 }
 function getPsicologico()
 {
   //echo "hola";
   $id = $this->input->get('id');
   //$select = '';
   $informepsicologico = $this->main->getSelect('denuncia','area_psicologica.*, denuncia.id_denuncia',array('denuncia.id_denuncia'=>$id), array('area_psicologica'=>'id_denuncia'));

   echo json_encode($informepsicologico); die();
 }
 function getSocial()
 {
   $id = $this->input->get('id');

   $informesocial = $this->main->getSelect('denuncia', 'area_social.*, denuncia.id_denuncia',array('denuncia.id_denuncia'=>$id), array('area_social'=>'id_denuncia'));

   echo json_encode($informesocial); die();
 }

  /**
   * Una Tupla de los datos de la Funcion
   *
   * @return JSON
   */
  function getFuncion()
  {
    $id = $this->input->get('id');
    $funcion = $this->main->get('funcion', array('id_funcion'=>$id));

    echo json_encode($funcion); die();
  }

  /**
  * Una Tupla de los datos del Rol
  *
  * @return JSON
  */
  function getRol()
  {
    $id = $this->input->get('id');
    $rol = $this->main->get('rol', array('id_rol'=>$id));

    echo json_encode($rol); die();
  }

  function getGestion()
  {
    $id = $this->input->get('id');
    $gestion = $this->main->get('gestion', array('id_gestion'=>$id));

    echo json_encode($gestion); die();
  }


  function getCategoria()
  {
    $id = $this->input->get('id');
    $categoria = $this->main->get('categoria', array('id_categoria'=>$id));

    echo json_encode($categoria); die();
  }

  function getCentro()
  {
    $id = $this->input->get('id');
    $centro = $this->main->get('centro', array('id_centro'=>$id));

    echo json_encode($centro); die();
  }

  /**
   * Una Lista de las funciones del Usuario
   *
   * @return JSON
   */
  function getFunciones()
  {
    $id_usuario = $this->input->post('id');

    $data['funciones'] = $this->main->getListSelect('permiso', 'permiso.*, funcion.nombre' , array('permiso.id_funcion'=>'ASC'), array('id_usuario'=>$id_usuario), null, null, array('funcion'=>'id_funcion'));
    $this->load->view('ajax/funciones_usuario', $data);
  }

  /**
  * Una Tupla de los datos del Rol
  *
  * @return JSON
  */
  /*function getKardex()
  {
    $id = $this->input->post('id');
    $kardex = $this->main->get('kardex', array('id_kardex'=>$id));

    echo json_encode($kardex); die();
  }
*/

  function getVivienda()
  {
    $id = $this->input->post('id');
    $kardex = $this->main->getSelect('kardex','tipo_vivienda, propiedad, id_kardex',array('id_kardex'=>$id));

    $servicios = $this->main->getList('servicios_disp', array('servicios_disp.id_kardex'=>$id), null, null, array('serv_basicos'=>'id_servicio'));

    echo json_encode(array('kardex'=>$kardex, 'servicios'=>$servicios)); die();
  }

  function getServiciosBasicos()
  {
    $id = $this->input->post('id');

    $data['servicios'] = $this->main->getListOrder('servicios_disp', array('nombre_servicio'=>'ASC'), array('id_kardex'=>$id), null, null, array('serv_basicos'=>'id_servicio'));

    $this->load->view('kardex/servicios_basicos', $data);
  }

  function  updateServiciosBasicos()
  {
    $id = $this->input->post('id');
    $kardex = $this->input->post('id_kardex');
    $estado = $this->input->post('estado');

    $this->main->update('servicios_disp', array('estado'=>$estado), array('id_servicios_disp'=>$id));

    $data['servicios'] = $this->main->getListOrder('servicios_disp', array('nombre_servicio'=>'ASC'), array('id_kardex'=>$kardex), null, null, array('serv_basicos'=>'id_servicio'));

    $this->load->view('kardex/servicios_basicos', $data);
  }

  function getVive()
  {
    $id = $this->input->post('id');
    $kardex = $this->main->getSelect('kardex','persona_referencia, parentesco, id_kardex, telefono_referencia',array('id_kardex'=>$id));

    $familiares = $this->main->getList('vive_con', array('vive_con.id_kardex'=>$id), null, null, array('familiar'=>'id_familiar'));

    echo json_encode(array('kardex'=>$kardex, 'familiares'=>$familiares)); die();
  }

  function getViveCon()
  {
    $id = $this->input->post('id');

    $data['viven'] = $this->main->getListOrder('vive_con', array('familiar'=>'ASC'), array('id_kardex'=>$id), null, null, array('familiar'=>'id_familiar'));

    $this->load->view('kardex/detalle_vive', $data);
  }

  function  updateViveCon()
  {
    $id = $this->input->post('id');
    $kardex = $this->input->post('id_kardex');
    $estado = $this->input->post('estado');

    $this->main->update('vive_con', array('estado'=>$estado), array('id_vive_con'=>$id));

    $data['viven'] = $this->main->getListOrder('vive_con', array('familiar'=>'ASC'), array('id_kardex'=>$kardex), null, null, array('familiar'=>'id_familiar'));

    $this->load->view('kardex/detalle_vive', $data);
  }


  function getTieneDocumento()
  {
    $id = $this->input->post('id');

    $data['documentos'] = $this->main->getListOrder('tiene_documento', array('documento'=>'ASC'), array('id_kardex'=>$id), null, null, array('documento'=>'id_documento'));

    $this->load->view('kardex/detalle_documento', $data);
  }

  function  updateTieneDocumento()
  {
    $id = $this->input->post('id');
    $kardex = $this->input->post('id_kardex');
    $estado = $this->input->post('estado');

    $this->main->update('tiene_documento', array('estado'=>$estado), array('id_tiene_documento'=>$id));

    $data['documentos'] = $this->main->getListOrder('tiene_documento', array('documento'=>'ASC'), array('id_kardex'=>$kardex), null, null, array('documento'=>'id_documento'));

    $this->load->view('kardex/detalle_documento', $data);
  }


  /**
   * Actualizara un Permiso dependiendo el caso
   *
   * @return HTML
   *
   */
  function updatePermiso()
  {
    $id_permiso = $this->input->post('id');
    $estado = $this->input->post('estado');

    $this->main->update('permiso', array('estado'=>$estado), array('id_permiso'=>$id_permiso));

    $id_usuario = $this->main->getField('permiso', 'id_usuario', array('id_permiso'=>$id_permiso));

    $data['funciones'] = $this->main->getListSelect('permiso', 'permiso.*, funcion.nombre' , array('permiso.id_funcion'=>'ASC'), array('id_usuario'=>$id_usuario), null, null, array('funcion'=>'id_funcion'));
    $this->load->view('ajax/funciones_usuario', $data);
  }

  /**
   * Actualiza la Latitud y Longitud del Domicilio del Postulante
   *
   * @return VOID
   */
  function updateLatLon()
  {
   $dato['latitud'] = $this->input->post('newLat');
   $dato['longitud'] = $this->input->post('newLng');

   $id_postulante = $this->session->postulante->id_postulante;

   $id = $this->main->getField('declaracion', 'id_declaracion', array('id_postulante'=>$id_postulante, 'estado'=>'PENDIENTE'));

   $this->main->update('declaracion', $dato, array('id_declaracion'=>$id));
  }

  /**
   * Obtiene los datos registrados de la declaracion
   *
   * @return JSON
   */
  function getDeclaracion()
  {
     $id = $this->input->get('id');
     $declaracion = $this->main->get('declaracion', array('id_declaracion'=>$id));

     echo json_encode($declaracion);
  }

  /**
   * Registrara un nuevo Familiar y retornara los familiares registrados
   *
   * @return JSON
   */
  function insertFamilia()
  {
    $id = $this->session->postulante->id_postulante;

    $id_declaracion = $this->main->getField('declaracion', 'id_declaracion',array('id_postulante'=>$id,'estado'=>'PENDIENTE'));

    $familia['id_declaracion'] = $id_declaracion;
    $familia['id_parentesco'] = $this->input->get('id_parentesco');
    $familia['grado_parentesco'] = $this->input->get('parentesco');
    $familia['nombres'] = mb_strtoupper($this->input->get('nombres'), 'utf-8');
    $familia['apellido_paterno'] = mb_strtoupper($this->input->get('appat'), 'utf-8');
    $familia['apellido_materno'] = mb_strtoupper($this->input->get('apmat'), 'utf-8');
    $familia['ocupacion']  =  mb_strtoupper($this->input->get('ocupacion'), 'utf-8');
    $familia['lugar_trabajo']  =  mb_strtoupper($this->input->get('trabaja'), 'utf-8');

    $this->main->insert('familiar', array_map('strtoupper', $familia));

    $mifamilia = $this->main->getListOrder('familiar', array('id_familiar'=>'ASC'), array('id_declaracion'=>$id_declaracion, 'estado'=>'AC'));

    echo json_encode(array('familia'=>$mifamilia));

  }

  /**
   * Registrara un nuevo Familiar y retornara los familiares registrados
   *
   * @return JSON
   */
  function quitarFamilia()
  {
    $id_familiar = $this->input->get('id_familia');

    $id = $this->session->postulante->id_postulante;

    $id_declaracion = $this->main->getField('declaracion', 'id_declaracion',array('id_postulante'=>$id,'estado'=>'PENDIENTE'));

    $this->main->update('familiar', array('estado'=>'IN'), array('id_familiar'=>$id_familiar));

    $mifamilia = $this->main->getListOrder('familiar', array('id_familiar'=>'ASC'), array('id_declaracion'=>$id_declaracion, 'estado'=>'AC'));

    echo json_encode(array('familia'=>$mifamilia));
  }

  /**
   * Actualizara los registros de la declaracion jurada en doble renumeracion
   *
   * @return VOID
   */
  function updateDoblePercepcion()
  {
     $id = $this->input->post('id');
     $data['no_doble_percepcion'] = strtoupper($this->input->post('respuesta'));
     $data['institucion'] = strtoupper($this->input->post('institucion'));
     $data['funcion'] = strtoupper($this->input->post('funcion'));
     $data['monto'] = strtoupper($this->input->post('monto'));

     $this->main->update('declaracion', $data, array('id_declaracion'=>$id));

  }

  /**
   * Actualizara los registros de la declaracion jurada de otras incompatibilidades
   *
   * @return VOID
   */
  function updatePolice()
  {
     $id = $this->input->post('id');
     $data['sentencia_pendiente'] = strtoupper($this->input->post('sentencia_pendiente'));
     $data['tipo_sentencia'] = strtoupper($this->input->post('tipo_sentencia'));
     $data['proceso'] = strtoupper($this->input->post('proceso'));
     $data['estado_proceso'] = strtoupper($this->input->post('estado_proceso'));
     $data['destituido'] = strtoupper($this->input->post('destituido'));
     $data['destituido_motivo'] = strtoupper($this->input->post('destituido_motivo'));

     $this->main->update('declaracion', $data, array('id_declaracion'=>$id));

  }

  /**
   * Actualizara los registros de la declaracion jurada de otras incompatibilidades
   *
   * @return VOID
   */
  function updateIncompatible()
  {
     $id = $this->input->post('id');
     $data['tengo_renta'] = strtoupper($this->input->post('tengo_renta'));
     $data['suspencion_temporal'] = strtoupper($this->input->post('suspencion_temporal'));
     $data['matrimonio_gamc'] = strtoupper($this->input->post('matrimonio'));
     $data['representacion_empresa'] = strtoupper($this->input->post('representacion_empresa'));
     $data['nombre_empresa'] = strtoupper($this->input->post('nombre_empresa'));

     $this->main->update('declaracion', $data, array('id_declaracion'=>$id));

  }

  /**
   * Actualizara los registros de la declaracion jurada de otras incompatibilidades
   *
   * @return VOID
   */
  function updateDomicilio()
  {
     $id = $this->input->post('id');
     $data['calle_principal'] = $this->input->post('calle_principal');
     $data['barrio_zona'] = $this->input->post('barrio_zona');
     $data['numero_domicilio']= $this->input->post('numero_domicilio');
     $data['nombre_edificio']= $this->input->post('nombre_edificio');
     $data['numero_piso'] = $this->input->post('numero_piso');
     $data['numero_departamento'] = $this->input->post('numero_departamento');
     $data['nombre_urbanizacion'] = $this->input->post('nombre_urbanizacion');
     $data['bloque_departamento'] = $this->input->post('bloque_departamento');
     $data['referencias'] = $this->input->post('referencias');
     $data['tipo_vivienda'] = $this->input->post('tipo_vivienda');


     $this->main->update('declaracion', $data, array('id_declaracion'=>$id));

  }

  /**
   * Actualizara el listado de servidores públicos
   *
   * @return JSON
   */
  function updateServidor()
  {
     $data['nombre_completo'] = $this->input->post('nombre_completo');
     $data['nombres'] = $this->input->post('nombres');
     $data['apellido_paterno'] = $this->input->post('paterno');
     $data['apellido_materno'] = $this->input->post('materno');
     $data['unidad'] = strtoupper($this->input->post('unidad'));
     $data['nro_item'] = $this->input->post('nro_item');
     $data['tipo_contrato'] = $this->input->post('tipo_contrato');
     $data['dni'] = $this->input->post('dni');
     $data['cargo'] = $this->input->post('cargo');



     $id = $this->main->insert('funcionario', $data);

     $msg = 'Error al procesar el registro';

     if($id)
     {
        $msg = 'Servidor Público registrado correctamente: '.$data['nombre_completo'];
     }

     echo json_encode($msg);
  }

  function limpiarFuncionarios()
  {

     $this->db->query("TRUNCATE TABLE public.funcionario RESTART IDENTITY RESTRICT;");

     redirect('gestion-servidores');
  }

}
