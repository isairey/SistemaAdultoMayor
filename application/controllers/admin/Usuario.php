<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }



  /**
	 * Lista los usuarios registrados
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-19
	 * @return 			VOID
	 */
	public function index()
	{
		 permiso('USUARIOS');

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

		$data['estados']	=	array('AC'=>'ACTIVO', 'DC'=>'INACTIVO');

		$roles =	$this->main->getListSelect('rol', 'id_rol, rol', array('rol'=>'ASC'), array('estado'=>'AC'));
		$data['roles'] = $this->main->dropdown($roles, '');

    $centros =	$this->main->getListSelect('centro', 'id_centro, nombre_centro', array('nombre_centro'=>'ASC'));
		$data['centros'] = $this->main->dropdown($centros, '');

		$data['usuarios'] = $this->main->getListOrder('usuario', array('id_usuario'=>'ASC'), null, null, null, array('rol'=>'id_rol','centro'=>'id_centro'));
		$this->load->view('administrador/usuario', $data);
	}

  public function registrar()
	{

		$this->form_validation->set_rules('usuario[nombres]', lang('nombres'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('usuario[paterno]', lang('primer.apellido'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('usuario[materno]', lang('segundo.apellido'), 'trim|mb_strtoupper');
		$this->form_validation->set_rules('usuario[dni]', lang('dni'), 'trim|required|is_unique[usuario.dni]|mb_strtoupper');
		$this->form_validation->set_rules('usuario[id_rol]', lang('rol'), 'trim|required');
    $this->form_validation->set_rules('usuario[id_centro]', lang('centro'), 'trim|required');
		$this->form_validation->set_rules('usuario[usuario]', lang('usuario'), 'trim|required|is_unique[usuario.usuario]|mb_strtoupper');
		$this->form_validation->set_rules('contrasenia', lang('contrasenia'), 'trim|required');
		$this->form_validation->set_rules('usuario[estado]', lang('estado'), 'trim|required');

		if($this->form_validation->run())
		{
			$usuario = $this->input->post('usuario');

			$usuario['contrasenia'] = md5($this->input->post('contrasenia'));
			$usuario['rol']	= $this->main->getField('rol', 'nombre', array('id_rol'=>$usuario['id_rol']));

			$usuario['nombre_completo'] = $usuario['nombres'].' '.$usuario['paterno'].' '.$usuario['materno'];

			$id = $this->main->insert('usuario', $usuario);

			$funciones = $this->main->getListSelect('funcion', 'id_funcion');

			foreach ($funciones as $funcion)
			{
				$permiso['id_usuario'] = $id;
				$permiso['id_funcion'] = $funcion->id_funcion;
				$permiso['estado'] = 'DC';

				$this->main->insert('permiso', $permiso);
			}


      $audi['nombre_completo']=$usuario['nombres'].' '.$usuario['paterno'].' '.$usuario['materno'];
      $audi['fecha']=date("Y-m-d H:i:s");
      $audi['tabla']='USUARIO';
      $audi['estado']='AC';
      $audi['proceso']='REGISTRO DE USUARIO';
      $audi['id_usuario']=$this->session->servidor->id_usuario;
      $audi['user_name']=$this->session->servidor->usuario;
      $this->main->insert('auditoria',$audi);

			$this->session->set_flashdata('success', lang('registrado.correctamente'));
			redirect('gestion-usuarios');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-usuarios');
		}
	}

	/**
	 * Recibe mediante POST los datos del usuario a Actualizarce
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-20
	 * @return 			VOID
	 */
	public function editar()
	{
		$this->form_validation->set_rules('usuario[nombres]', lang('nombres'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('usuario[paterno]', lang('apellido.paterno'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('usuario[materno]', lang('apellido.materno'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('usuario[dni]', lang('dni'), 'trim|required|callback_check_dni_usuario|mb_strtoupper');
		$this->form_validation->set_rules('usuario[id_rol]', lang('rol'), 'trim|required');
    $this->form_validation->set_rules('usuario[id_centro]', lang('centro'), 'trim|required');
		$this->form_validation->set_rules('usuario[estado]', lang('estado'), 'trim|required');
		$this->form_validation->set_rules('id_usuario', lang('usuario'), 'trim|required');

		if($this->form_validation->run())
		{
			$usuario = $this->input->post('usuario');
			$usuario['rol']	= $this->main->getField('rol', 'nombre', array('id_rol'=>$usuario['id_rol']));
			$usuario['nombre_completo'] = $usuario['nombres'].' '.$usuario['paterno'].' '.$usuario['materno'];
			$this->main->update('usuario', $usuario, array('id_usuario'=>$this->input->post('id_usuario')));

      $audi['nombre_completo']=$usuario['nombres'].' '.$usuario['paterno'].' '.$usuario['materno'];
      $audi['fecha']=date("Y-m-d H:i:s");
      $audi['tabla']='USUARIO';
      $audi['estado']='AC';
      $audi['proceso']='EDICION DE USUARIO';
      $audi['id_usuario']=$this->session->servidor->id_usuario;
      $audi['user_name']=$this->session->servidor->usuario;
      $this->main->insert('auditoria',$audi);


			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('gestion-usuarios');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-usuarios');
		}
	}




  /**
   *  validar DNI de Usuario ocupacion como unica
   *
   *  @author 		John Evert Aleman Orellana
   *  @copyright 	Gobierno Autonomo Municipal de Cochabamba
   *  @version		1.0  2018-02-20
   *  @return 		BOOLEAN
   */
  public function check_dni_usuario($dni){
     $cantidad_dni    =   $this->main->total('usuario', array('dni'=>$dni, 'id_usuario'=>$this->input->post('id_usuario')));
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
