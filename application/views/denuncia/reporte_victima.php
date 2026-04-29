<?php
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        
       $this->SetY(5);
        $this->SetFont('dejavusans', 'B', 8);
        $this->Image(K_PATH_IMAGES.'logo.png', 220, 5, 60, 15, 'PNG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Cell(2, 5, '');
        $this->Cell(0, 5, 'Gobierno Autónomo Municipal de Cochabamba', 0, 1);
        $this->Cell(2, 5, '');
        $this->Cell(0, 5, 'Dirección de Adulto Mayor', 0, 1);
        $this->Cell(2, 5, '');
        $this->Cell(0, 5, 'Denuncias', 0, 1);
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(16, 22, 281, 22, $style);


        $this->SetFont('dejavusans', '', 6, '', true);
        if($this->getPage()>=2){
        	$this->ln(4);

            $this->Cell(1, 5, '');
            $html = '';

            $html.='
                    <table cellpadding="4" cellspacing="2" border="1">
                        <tr>
                            <th width="30px"><b>Nº</b></th>
                            <th width="60px"><b>CANTIDAD</b></th>
                            <th width="80px"><b>SEXO</b></th>
                            <th width="60px"><b>GESTION</b></th>

                        </tr>
                    </table>';
            $this->writeHTML($html, true, true, true, true, '');
        }
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 8);
        // Page number
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(16, 190, 281, 190, $style);
        setlocale(LC_ALL, 'es_MX');
        $fecha = date('d-m-Y h:i:s A');
        $this->Cell(50, 10, $fecha, 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('VICTIMAS ');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,25), array(0,64,128));
$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();
$pdf->SetFont('dejavusans', 'B', 15, '', true);
$pdf->Text(16, 25, 'VICTIMAS');
$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(16, 34, 281, 34, $style);
$pdf->ln(15);

//Cell($w, $h=0, $txt='', $border=0, $ln=0, $align='', $fill=0, $link='', $stretch=0, $ignore_min_height=false, $calign='T', $valign='M')
// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)
// test Cell stretching
$pdf->SetFont('dejavusans', '', 6, '', true);

$html = '';

$html.='
<table cellpadding="4" cellspacing="2" border="1">
	<tr>
		<th width="30px"><b>Nº</b></th>
        <th width="60px"><b>CANTIDAD</b></th>
        <th width="80px"><b>SEXO</b></th>
        <th width="60px"><b>GESTION</b></th>

	</tr>';

$bg = 0;
$color= 'background-color:#DFDFDF';

$numero = 1;

foreach ($victimas as $victima) {

    $date = new DateTime($victima->fecha_registro);

    $html.= '<tr style="text-align:justify; '. (($bg) ? $color : "").'">
				<td>'.$numero.'</td>
        <td>'.$date->format('d-m-Y H:i').'</td>
        <td>'.$victima->cantidad.'</td>
        <td>'.$victima->sexo.'</td>
        <td>'.$victima->gestion.'</td>
			 </tr>';
	$bg = !$bg;
    $numero++;
}

$html.='</table>';

$pdf->writeHTML($html, true, true, true, true, '');


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

 ?>
