<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if ( ! function_exists('login')){
	function login()
	{
		$CI =& get_instance();
			if($CI->input->post('login')!==FALSE){
				$CI->form_validation->set_rules('login', lang('login'), 'required');
				$CI->form_validation->set_rules('pass', lang('password'), 'required');

				if ($CI->form_validation->run())
				{
					$nombre_usuario = strtoupper(set_value('login'));
					$contrasenia = md5(strtoupper(set_value('pass')));

					if($usuario = $CI->main->get('usuario', array('usuario'=>$nombre_usuario, 'contrasenia'=>$contrasenia, 'estado'=>'AC')))
					{
						$CI->session->set_userdata('servidor',$usuario);
						$CI->session->set_userdata('gestion', date('Y'));

						$CI->session->set_flashdata('default', lang('bienvenido').$CI->session->servidor->nombres.' '.$CI->session->servidor->paterno.' '.$CI->session->servidor->materno);

						redirect(current_url());
					}
					else
					{
						$CI->session->set_flashdata('default', 'Usuario y/o Contraseña incorrecto');
						redirect(current_url());
					}
				}

				else
				{
					if($CI->input->post())
					{
						$CI->session->set_flashdata('default', lang('login.vacio'));
						redirect(current_url());
					}
				}

				if(!$CI->session->userdata('servidor'))
				{
					$data['login'] = $CI->session->flashdata('login');
					exit($CI->load->view('seccion/login.php', $data, TRUE));
				}
			}
	}
}

if( ! function_exists('mostrar'))
{
	function mostrar($funcion)
	{
		$CI =& get_instance();

		$where_permiso['funcion.nombre'] = $funcion;
		$where_permiso['permiso.id_usuario'] = $CI->session->userdata('servidor')->id_usuario;
		$where_permiso['permiso.estado'] = 'AC';

		$permiso = $CI->main->total('permiso', $where_permiso, array('funcion'=>'id_funcion', 'usuario'=>'id_usuario'));

		if($permiso)
			return TRUE;

		else
			return FALSE;
	}
}


if( ! function_exists('permiso'))
{
	function permiso($funcion)
	{
		$CI =& get_instance();

		$where_permiso['funcion.nombre'] = $funcion;
		$where_permiso['permiso.id_usuario'] = $CI->session->userdata('servidor')->id_usuario;
		$where_permiso['permiso.estado'] = 'AC';

		$permiso = $CI->main->total('permiso', $where_permiso, array('funcion'=>'id_funcion', 'usuario'=>'id_usuario'));

		if($permiso)
			return TRUE;

		else
			$CI->load->view('error/error_401');
	}
}



if(! function_exists('audit'))
{
	function audit($proceso)
	{
		$CI =& get_instance();

		$datos['nombre_completo'] 		= 	$CI->session->userdata('usuario')->nombre_completo;
	    $datos['fecha_hora']			=	date('Y-m-d H:i:s');
	    $datos['proceso'] 				= 	$proceso;
 		$datos['ip']					=	$CI->input->ip_address();

 		//var_dump($datos); die();

		$CI->main->insert('auditoria', $datos);
	}
}

/**
 * Helper que devuelve una fecha literal
 *
 * @author			Ing. John Evert Aleman Orellana
 * @copyright		Gobierno Autonomo Municipal de Cochabamba
 * @version			1.0
 * @var 				DATE
 * @return 			STRING
 */
if(! function_exists('fecha')) {
	function fecha($fecha="") {
		$CI =& get_instance();

		if($fecha != null) {
			$formato = explode('-', $fecha);

			switch ($formato[1]) {

			case 1: return $formato[2]." ENERO DE ".$formato[0];
			case 2: return $formato[2]." FEBRERO DE ".$formato[0];
			case 3: return $formato[2]." MARZO DE ".$formato[0];
			case 4: return $formato[2]." ABRIL DE ".$formato[0];
			case 5: return $formato[2]." MAYO DE ".$formato[0];
			case 6: return $formato[2]." JUNIO DE ".$formato[0];
			case 7: return $formato[2]." JULIO DE ".$formato[0];
			case 8: return $formato[2]." AGOSTO DE ".$formato[0];
			case 9: return $formato[2]." SEPTIEMBRE DE ".$formato[0];
			case 10: return $formato[2]." OCTUBRE DE ".$formato[0];
			case 11: return $formato[2]." NOVIEMBRE DE ".$formato[0];
			case 12: return $formato[2]." DICIEMBRE DE ".$formato[0];

			}
		}

		else
			return '';
	}
}

if(! function_exists('edad'))
{
	function edad($fecha_nacimiento)
	{
		if ($fecha_nacimiento)
		{
			$fecha = new DateTime($fecha_nacimiento);
			$now = new DateTime(date('Y-m-d'));

    		$edad  = $fecha->diff($now);

    		return $edad->format('%y AÑOS CON %m MESES Y %d DÍAS');
		}
	}
}
