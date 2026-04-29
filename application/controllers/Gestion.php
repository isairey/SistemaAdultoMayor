<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gestion extends CI_Controller {


	public function __construct()
	{
		parent:: __construct();

		$this->load->library('excel');

		if(!$this->session->userdata('servidor'))
			login();
	}

	public function index(){

		 permiso('GESTION');

		$this->breadcrumbs->push('<div class="medium-12 columns"><i class="fa fontello-user"></i>'. $this->session->servidor->nombres.' '.$this->session->servidor->paterno.nbs(5).'<i class="fa fontello-calendar"></i>'.fecha(date('Y-m-d')).'</div>', 'inicio');	 

		$data['gestiones'] = $this->main->getListOrder('gestion', array('anio'=>'DESC','mes'=>'DESC'));
		$this->load->view('gestion/index', $data);
	}

	public function registrar(){
		$this->form_validation->set_rules('gestion', lang('gestion.validator.gestion'), 'trim|required|callback_check_gestion');

		if($this->form_validation->run()){
			//05-2018
			$gestion = $this->input->post('gestion');
			$arraygestion = explode("-", $gestion);
			if($this->main->total('gestion',array('mes'=>$arraygestion[0],'anio'=>$arraygestion[1])) == 0){
				if($this->main->total('gestion',array('archivo'=>'PENDIENTE')) == 0){
					$this->main->insert('gestion',array('anio'=>$arraygestion[1],'mes'=>$arraygestion[0],'archivo'=>'PENDIENTE','estado'=>'AC'));
					$this->session->set_flashdata('success', lang('registrado.correctamente'));
				}else{
					$this->session->set_flashdata('alert',lang('gestion.sinarchivo'));
				}
			}else{
				$this->session->set_flashdata('alert',lang('gestion.gestionrepetida'));
			}
		}else{
			$this->session->set_flashdata('alert', validation_errors());
		}
		redirect('gestion');
	}

	public function check_gestion($gestion){
	  	if (preg_match('/^(0[1-9]|1[012])\-([2-9][0-9)]{3})$/', $gestion)){
	    	return TRUE;
	  	}else{
	  		$this->form_validation->set_message('check_gestion', '{field} '.lang('gestion.valor.invalido'));
	    	return FALSE;
	  	}
	}

	public function cargar_beneficiarios()
        {
			$id_gestion = $this->input->post('id_gestion');
			$gestion = $this->main->get('gestion', array('id_gestion'=>$id_gestion));


			$config['upload_path']          = './public/archivos_excel';
            $config['allowed_types']        = 'xlsx|xls';
            $config['max_size']             = 1000;
			$config['file_name']				= $gestion->anio.$gestion->mes;


            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('userfile'))
            {
                $error = array('error' => $this->upload->display_errors());

				$this->session->set_flashdata('alert', $this->upload->display_errors());
				redirect('gestion');

            }

            else
            {
				$data = array('upload_data' => $this->upload->data());
				$archivo = $data['upload_data']['file_name'];
				$this->main->update('gestion', array('archivo'=>$archivo), array('id_gestion'=>$id_gestion));

				$objPHPExcel  = $this->excel->getObjectPhp('./public/archivos_excel/'.$archivo);

				$objPHPExcel->setActiveSheetIndex('0');

				$worksheet = $objPHPExcel->getActiveSheet();

				$cont_title = 3;  $nuevos = 0;

				$rows =  $worksheet->getHighestRow();
				$monto = $this->main->get('monto', array('estado'=>'AC'));

				for ($i=3; $i <= $rows; $i++)
				{

					$dni =  strval($worksheet->getCell('B'.$i)->getValue());
					$nombre =  strval($worksheet->getCell('C'.$i)->getValue());
					$firma =  strval($worksheet->getCell('D'.$i)->getValue());

					$existe_beneficiario = $this->main->get('beneficiario', array('dni'=>$dni));

					$id_beneficiario = 0;

					if($existe_beneficiario == null)
					{
						$beneficiario['dni'] = $dni;
						$beneficiario['nombre'] = $nombre;

						$id_beneficiario = $this->main->insert('beneficiario', $beneficiario);
						$nuevos += 1;
					}

					else
					{
						$id_beneficiario = $existe_beneficiario->id_beneficiario;
					}

					$registro_pago = $this->main->get('pago', array('id_gestion'=>$id_gestion, 'id_beneficiario'=>$id_beneficiario));

					if($registro_pago == null)
					{
						$pago['id_gestion'] = $id_gestion;
						$pago['nombre_gestion'] = $gestion->mes.'-'.$gestion->anio;
						$pago['id_beneficiario'] = $id_beneficiario;
						$pago['nombre_beneficiario'] = $nombre;
						$pago['id_monto'] = $monto->id_monto;
						$pago['monto'] = $monto->monto;
						if($firma === '1')
						{
							$pago['estado'] = 'DC';
							$pago['fecha_cobro'] = '2018-06-22';
							$monto_pagado += $monto->monto;
						}
						else
						{
							$pago['estado'] = 'AC';

						}
						$this->main->insert('pago', $pago);
					}

				}
					$monto = (int)$this->main->getField('monto', 'monto', array('estado'=>'AC'));
					$this->main->update('gestion', array('beneficiarios'=>$rows-2, 'nuevos_beneficiarios'=>$nuevos, 'desembolso'=>($rows-2)*$monto, 'pagado'=>$monto_pagado), array('id_gestion'=>$id_gestion));

					$this->session->set_flashdata('success', lang('archivo.correcto'));
					redirect('gestion');
                }
        }

    public function reporte($id_gestion)
    {
    	//Datos de la Gestion
    	$data['gestion'] = $this->main->get('gestion', array('id_gestion'=>$id_gestion));

    	$this->load->view('gestion/reporte', $data);
    }
}
