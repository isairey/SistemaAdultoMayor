<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once dirname(__FILE__) . '/tcpdf/tcpdf.php';

class Pdf extends TCPDF
{
	protected $flagHeaderHtml = false;
	protected $flagFooterHtml = false;
	protected $htmlFooterData = '';


    function __construct()
    {
        parent::__construct();
    }

    public function Header()
	{
		if( $this->getFlagHeaderHtml() == true )
		{
			$headerData = $this->getHeaderData();
	        $this->SetFont('helvetica', '', 7, '', true);
	        $this->writeHTML($headerData['string']);
		}
		else{
			parent::Header();
		}


	}

	public function Footer()
	{
		if ( $this->htmlFooterData!='')
		{
	        // Position at 15 mm from bottom
	        $this->SetY(-35);
	        // Set font
	        $this->SetFont('helvetica', '', 7, '', true);
	        // Page number
	        $this->writeHTML($this->htmlFooterData, true, 0, true, 0);
	        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
		} else
		{
			parent::Footer();
		}
    }

	public function setHeaderHtml($flag){
		$this->flagHeaderHtml = $flag;
	}

	public function getFlagHeaderHtml(){
		return $this->flagHeaderHtml;
	}


	public function setFooterDataHtml($data){
		$this->htmlFooterData = $data;
	}

	public function getFlagFooterHtml(){
		return $this->flagFooterHtml;
	}
}
