<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perfil extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if(!$this->session->servidor)
            login();
    }



    public function gestion_denuncia()
    {
        $gestiones =  array('2018'=>'2018','2019'=>'2019');
        $data['gestiones'] = $gestiones;

        $this->load->view('inicio/gestion_denuncia', $data);
    }

    public function actualizar_gestion()
    {

        $this->form_validation->set_rules('gestion', lang('gestion.denuncia'), 'trim|required|integer|max_length[4]');

        if($this->form_validation->run())
        {

            $gestion = $this->input->post('gestion');

            $this->session->set_userdata('gestion', $gestion);

            $this->session->set_flashdata('success', lang('cambio.gestion').$gestion);
            redirect('inicio');
        }
    }


    /**
  	 * cerrar sesion
  	 *
  	 * @copyright		Gobierno Autonomo Municipal de Cochabamba
  	 * @author			Ing. maira quiroz
  	 * @version			1.0  2018-02-19
  	 * @return 			VOID
  	 */


     public function cerrar()
  {
         $this->session->userdata = Array();
         $this->session->sess_destroy();
         $this->session->unset_userdata('login');
         redirect('inicio','refresh');
  }
  /**
     * Cambiar contraseña de usuario en el sistema
     *
     * @author 		Maira Quiroz Acevedo
     * @copyright 	Gobierno Autonomo Municipal de Cochabamba
     *
     */
    public function contrasenias()
    {
        // add breadcrumbs
        //$this->breadcrumbs->push('Cambiar password', '/administracion/cambiar-password');
        $this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');

        $data = '';
        $this->form_validation->set_rules('login', lang('usuario'), 'trim|required');
        $this->form_validation->set_rules('passold', lang('contrasenia.anterior'), 'trim|required');
        $this->form_validation->set_rules('passnew', lang('contrasenia.nueva'), 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', lang('contrasenia.conf'), 'trim|required');

        if ($this->form_validation->run()){
            $usuario = $this->main->get('usuario', array('usuario'=>strtoupper(($this->input->post('login'))), 'contrasenia'=>md5(strtoupper(($this->input->post('passold')))), 'id_rol'=>strtoupper($this->input->post('id_rol')), 'estado'=>'AC'));

            if($usuario){
                $usuarioAct['contrasenia'] = md5(strtoupper($this->input->post('passnew')));
                $this->main->update('usuario', $usuarioAct, array('id_usuario'=>$usuario->id_usuario));
                $audi['nombre_completo']=$this->session->servidor->nombres.' '.$this->session->servidor->paterno.' '.$this->session->servidor->materno;
                $audi['fecha']=date("Y-m-d H:i:s");
                $audi['estado']='AC';
                $audi['tabla']='USUARIO';
                $audi['proceso']='EDITAR PASSWORD';
                $audi['id_usuario']=$this->session->servidor->id_usuario;
                $audi['user_name']=$this->session->servidor->usuario;
                $this->main->insert('auditoria',$audi);
                $this->session->set_flashdata('default', lang('actualizado.usuario'));
                redirect('perfil/cerrar');
            }
            else
            {
                $this->session->set_flashdata('default_error', 'Usuario y/o Contraseña incorrecto');
                $this->session->set_flashdata('default_error', 'Contraseña actual incorrecto');
                redirect(current_url());
            }
        }
        $this->load->view('administrador/cambiar_contrasenia', $data);
    }
}
