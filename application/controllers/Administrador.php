<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller
{
	/**
	 * Constructor del controlador administrador
	 * Funciones principales al entrar en el controlador
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-19
	 */
	public function __construct()
	{
		parent:: __construct();

		if(!$this->session->servidor)
			login();
	}

	/**
	 * Lista los usuarios registrados
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-19
	 * @return 			VOID
	 */
	public function usuarios()
	{
		 permiso('USUARIOS');

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

		$data['estados']	=	array('AC'=>'ACTIVO', 'DC'=>'INACTIVO');

		$roles =	$this->main->getListSelect('rol', 'id_rol, nombre', array('nombre'=>'ASC'), array('estado'=>'AC'));
		$data['roles'] = $this->main->dropdown($roles, '');
		$centros =	$this->main->getListSelect('centro', 'id_centro, nombre_centro', array('nombre_centro'=>'ASC'), array('estado'=>'AC'));
		$data['centros'] = $this->main->dropdown($centros, '');

		$data['usuarios'] = $this->main->getListOrder('usuario', array('id_usuario'=>'ASC'), null, null, null, array('rol'=>'id_rol'));
		$this->load->view('administrador/usuario', $data);
	}

	/**
	 * Recibe mediante POST los datos del nuevo usuario
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-20
	 * @return 			VOID
	 */

	public function funciones()
	{
		 permiso('FUNCIONES');

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

		$data['funciones'] = $this->main->getListOrder('funcion', array('id_funcion'=>'ASC'));
		$data['estados'] = array('AC'=>'ACTIVO', 'DC'=>'INACTIVO');
		$this->load->view('administrador/funcion', $data);
	}

	/**
	 * Recibe mediante POST los datos del nuevo usuario
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-20
	 * @return 			VOID
	 */
	public function registrarfuncion()
	{
		mb_internal_encoding("UTF-8");

		$this->form_validation->set_rules('funcion[nombre]', lang('nombre.funcion'), 'trim|required|mb_strtoupper|is_unique[funcion.nombre]');
		$this->form_validation->set_rules('funcion[estado]', lang('estado'), 'trim|required');

		if($this->form_validation->run())
		{
			$funcion = $this->input->post('funcion');

			$id = $this->main->insert('funcion', $funcion);

			if($id)
			{
				$usuarios = $this->main->getListSelect('usuario', 'id_usuario');

				foreach ($usuarios as $usuario)
				{
					$permiso['id_usuario'] = $usuario->id_usuario;
					$permiso['id_funcion'] = $id;
					$permiso['estado'] = 'DC';

					$this->main->insert('permiso', $permiso);
				}
				$audi['nombre_completo']=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
				$audi['fecha']=date("Y-m-d H:i:s");
				$audi['estado']='AC';
				$audi['tabla']='USUARIO';
				$audi['proceso']='REGISTRO DE FUNCIONES';
				$audi['id_usuario']=$this->session->servidor->id_usuario;
				$audi['user_name']=$this->session->servidor->usuario;
				$this->main->insert('auditoria',$audi);

				$this->session->set_flashdata('success', lang('registrado.correctamente'));
			}

			redirect('gestion-funciones');
		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-funciones');
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
	public function editarfuncion()
	{
		mb_internal_encoding("UTF-8");
		$this->form_validation->set_rules('funcion[nombre]', lang('nombre.funcion'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('funcion[estado]', lang('estado'), 'trim|required');
		$this->form_validation->set_rules('id_funcion', lang('identificador'), 'trim|required');


		if($this->form_validation->run())
		{
			$funcion = $this->input->post('funcion');

			$this->main->update('funcion', $funcion, array('id_funcion'=>$this->input->post('id_funcion')));

			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('gestion-funciones');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-funciones');
		}
	}

	/**
	 * Lista los servidores publicos registrados con los datos mas importantes
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. MAira Quiroz Acevedo
	 * @version			1.0  2018-10-24
	 * @return 			VOID
	 */
	public function gestiones()
	{
		 permiso('GESTIONES');

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
	 * Recibe mediante POST los datos del usuario a Actualizarce
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-20
	 * @return 			VOID
	 */
	public function editargestion()
	{

		$this->form_validation->set_rules('gestion[gestion]', lang('nombre.gestion'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('gestion[estado]', lang('estado'), 'trim|required');
		$this->form_validation->set_rules('id_gestion', lang('identificador'), 'trim|required');


		if($this->form_validation->run())
		{
			$rol = $this->input->post('gestion');

			$this->main->update('gestion', $rol, array('id_gestion'=>$this->input->post('id_gestion')));

			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('gestion-gestiones');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-gestiones');
		}
	}

	/**
	 * Lista los servidores publicos registrados con los datos mas importantes
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. MAira Quiroz Acevedo
	 * @version			1.0  2018-10-05
	 * @return 			VOID
	 */
	public function roles()
	{
		 permiso('ROLES');

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

		$data['roles'] = $this->main->getListOrder('rol', array('nombre'=>'ASC'));
		$data['estados'] = array('AC'=>'ACTIVO', 'DC'=>'INACTIVO');
		$this->load->view('administrador/rol', $data);
	}

	/**
	 * Recibe mediante POST los datos del nuevo usuario
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-20
	 * @return 			VOID
	 */
	public function registrarRol()
	{
		mb_internal_encoding("UTF-8");
		$this->form_validation->set_rules('rol[nombre]', lang('nombre.rol'), 'trim|required|mb_strtoupper|is_unique[rol.nombre]');
		$this->form_validation->set_rules('rol[estado]', lang('estado'), 'trim|required');

		if($this->form_validation->run())
		{
			$rol = $this->input->post('rol');

			$id = $this->main->insert('rol', $rol);

			if($id)
			{
				$this->session->set_flashdata('success', lang('registrado.correctamente'));
			}

			redirect('gestion-roles');
		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-roles');
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
	public function editarrol()
	{
		mb_internal_encoding("UTF-8");
		$this->form_validation->set_rules('rol[nombre]', lang('nombre.rol'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('rol[estado]', lang('estado'), 'trim|required');
		$this->form_validation->set_rules('id_rol', lang('identificador'), 'trim|required');


		if($this->form_validation->run())
		{
			$rol = $this->input->post('rol');

			$this->main->update('rol', $rol, array('id_rol'=>$this->input->post('id_rol')));

			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('gestion-roles');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-roles');
		}
	}

	/**
	 * Lista las categorias registrados con los datos mas importantes
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-10-11
	 * @return 			VOID
	 */


	public function categorias()
	{
		 permiso('TIPOLOGIAS');

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

		$data['categorias'] = $this->main->getListOrder('categoria', array('id_categoria'=>'ASC'));
		$data['estados'] = array('AC'=>'ACTIVO', 'DC'=>'INACTIVO');
		$this->load->view('administrador/categoria', $data);
	}

	/**
	 * Recibe mediante POST los datos de la nueva categoria
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-10-11
	 * @return 			VOID
	 */
	public function registrarcategoria()
	{
		mb_internal_encoding("UTF-8");
		$this->form_validation->set_rules('categoria[nombre]', lang('nombre.categoria'), 'trim|required|mb_strtoupper|is_unique[categoria.nombre]');
		$this->form_validation->set_rules('categoria[estado]', lang('estado'), 'trim|required');

		if($this->form_validation->run())
		{
			$categoria = $this->input->post('categoria');

			$id = $this->main->insert('categoria', $categoria);


				$this->session->set_flashdata('success', lang('registrado.correctamente'));


			redirect('gestion-categorias');
		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-categorias');
		}
	}

	/**
	 * Recibe mediante POST los datos de la categoria a Actualizarce
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-02-20
	 * @return 			VOID
	 */
	public function editarcategoria()
	{
    mb_internal_encoding("UTF-8");

		$this->form_validation->set_rules('categoria[nombre]', lang('nombre.categoria'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('categoria[estado]', lang('estado'), 'trim|required');
		$this->form_validation->set_rules('id_categoria', lang('identificador'), 'trim|required');


		if($this->form_validation->run())
		{

			//$funcion = array_map('mb_strtoupper', $this->input->post('categoria'));

			$funcion = $this->input->post('categoria');

			$this->main->update('categoria', $funcion, array('id_categoria'=>$this->input->post('id_categoria')));

			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('gestion-categorias');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-categorias');
		}
	}




	/**
	 * Lista los centros registrados con los datos mas importantes
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-10-11
	 * @return 			VOID
	 */

	public function centros()
	{
		 permiso('CENTROS');

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

		$data['centros'] = $this->main->getListOrder('centro', array('id_centro'=>'ASC'));
		$data['estados'] = array('AC'=>'ACTIVO', 'DC'=>'INACTIVO');
		$this->load->view('administrador/centro', $data);
	}

	/**
	 * Recibe mediante POST los datos de la nueva categoria
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-10-11
	 * @return 			VOID
	 */


	public function registrarcentro()
	{

		$this->form_validation->set_rules('centro[nombre_centro]', lang('nombre.centro'), 'trim|required|mb_strtoupper|is_unique[centro.nombre_centro]');
		$this->form_validation->set_rules('centro[codigo]', lang('codigo.centro'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('centro[estado]', lang('estado'), 'trim|required');

		if($this->form_validation->run()){
			$centro = $this->input->post('centro');
			$id = $this->main->insert('centro', $centro);
			$this->session->set_flashdata('success', lang('registrado.correctamente'));

			redirect('gestion-centros');
		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-centros');
		}
	}
	/**
	 * Recibe mediante POST los datos de la centro a Actualizarce
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. Maira Quiroz Acevedo
	 * @version			1.0  2018-02-20
	 * @return 			VOID
	 */
	public function editarcentro()
	{

		$this->form_validation->set_rules('centro[nombre_centro]', lang('nombre.centro'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('centro[codigo]', lang('codigo.centro'), 'trim|required|mb_strtoupper');
		$this->form_validation->set_rules('centro[estado]', lang('estado'), 'trim|required');
		$this->form_validation->set_rules('id_centro', lang('identificador'), 'trim|required');


		if($this->form_validation->run())
		{
			$funcion = $this->input->post('centro');

			$this->main->update('centro', $funcion, array('id_centro'=>$this->input->post('id_centro')));

			$this->session->set_flashdata('info', lang('actualizado.correctamente'));
			redirect('gestion-centros');

		}

		else
		{
			$this->session->set_flashdata('alert', validation_errors());
			redirect('gestion-centros');
		}
	}


	/**
	 * Lista los servidores publicos registrados con los datos mas importantes
	 *
	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
	 * @author			Ing. John Evert Aleman Orellana
	 * @version			1.0  2018-02-19
	 * @return 			VOID
	 */
	public function comprobantes()
	{
		 permiso('COMPROBANTES');

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

		$data['comprobantes'] = $this->main->getListOrder('comprobante', array('anio'=>'DESC'));

		$this->load->view('administrador/comprobante', $data);
	}






}
