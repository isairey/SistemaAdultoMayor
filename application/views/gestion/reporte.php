<?php
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
       $this->SetY(5);
        $this->SetFont('dejavusans', 'B', 8);
        $this->Image(K_PATH_IMAGES.'escudo.jpg', 17, 5, 12, 15, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Cell(15, 5, '');
        $this->Cell(0, 5, 'Gobierno Autónomo Municipal de Cochabamba', 0, 1);
        $this->Cell(15, 5, '');
        $this->Cell(0, 5, 'Dirección de Genero Generacional y Familia', 0, 1);
        $this->Cell(15, 5, '');
        $this->Cell(0, 5, 'Departamento de Desarrollo de Personas con Discapacidad', 0, 1);
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(16, 22, 195, 22, $style);

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 8);
        // Page number
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(16, 280, 195, 280, $style);
        $this->Cell(50, 10, fecha(date('Y-m-d')), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('REPORTE DE GESTIÓN');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
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

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// dejavusans or times to reduce file size.
$pdf->SetFont('dejavusans', '', 14, '', true);


// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

$pdf->SetY(30);
$pdf->SetFont('dejavusans', 'B', 11, '', true);
$pdf->SetFillColor(220,220,220);
$pdf->setCellPaddings( $left = 3, $top = 1, $right = 3, $bottom = 1);
$pdf->Cell(0, 0, 'INFORME DE GESTIÓN', 1, 1, 'L', 1, 0);

$pdf->SetFont('dejavusans', '', 9, '', true);

$pdf->SetY(45);
$pendiente_de_pago = number_format($gestion->desembolso-$gestion->pagado, 2, ',', '.');
$pagado = number_format($gestion->pagado, 2, ',', '.');
$desembolso = number_format($gestion->desembolso, 2, ',', '.');


$informe_gestion = '<table border="1" style="text-align:center"><thead><tr><th><b>DETALLE FINANCIERO</b></th></tr></thead><tbody><tr><td border="1" width="16%"><b>GESTIÓN</b></td>';
$informe_gestion.= '<td width="28%"><b>DESEMBOLSO (Bs.)</b></td><td width="28%"><b>COBRADO (Bs.)</b></td><td width="28%"><b>PENDIENTE (Bs.)</b></td></tr>';
$informe_gestion.= '<tr><td>'.$gestion->mes.'-'.$gestion->anio.'</td><td>'.$desembolso.'</td><td>'.$pagado.'</td><td>'.$pendiente_de_pago.'</td></tr></tbody></table>';


$pdf->writeHTML($informe_gestion, true, true, true, true, '');

$pdf->SetY(70);
$cobradores = $this->main->total('pago', array('id_gestion'=>$gestion->id_gestion, 'estado'=>'DC'));
$pendientes = $gestion->beneficiarios - $cobradores;

$informe_beneficiarios = '<table border="1" style="text-align:center"><thead><tr><th><b>DETALLE DE BENEFICIARIOS</b></th></tr></thead><tbody><tr><td border="1" width="25%"><b>HABILITADOS</b></td>';
$informe_beneficiarios.= '<td width="25%"><b>NUEVOS</b></td><td width="25%"><b>COBRADORES</b></td><td width="25%"><b>PENDIENTES</b></td></tr>';
$informe_beneficiarios.= '<tr><td>'.$gestion->beneficiarios.'</td><td>'.$gestion->nuevos_beneficiarios.'</td><td>'.$cobradores.'</td><td>'.$pendientes.'</td></tr></tbody></table>';


$pdf->writeHTML($informe_beneficiarios, true, true, true, true, '');

$pdf->SetY(95);
$pdf->SetFont('dejavusans', 'B', 11, '', true);
$pdf->SetFillColor(220,220,220);
$pdf->setCellPaddings( $left = 3, $top = 1, $right = 3, $bottom = 1);
$pdf->Cell(0, 0, 'INFORME FINANCIERO', 1, 1, 'L', 1, 0);


$detalle_financiero = $this->main->getListSelect('pago', 'SUM(CAST( monto AS numeric )) AS cobrado, mes_cobro, COUNT(id_pago) AS personas',  array('mes_cobro'=>'ASC') , array('id_gestion'=>$gestion->id_gestion, 'estado'=>'DC'), null, null, null,'mes_cobro');

$detalle_cobros = '<center><table border="1" style="text-align:center" width="80%"><thead><tr><th colspan="3"><b>DETALLE DE COBROS POR MES</b></th></tr></thead><tbody><tr><td><b>MES</b></td><td><b>MONTO COBRADO</b></td><td><b>BENEFICIARIOS</b></td></tr>';


$pdf->SetY(105); $pdf->SetX(40);

$total_cobrado = 0; $total_personas=0;

foreach ($detalle_financiero as $detalle)
{
  $detalle_cobros.= '<tr><td>'.$detalle->mes_cobro.'</td><td>'.number_format($detalle->cobrado, 2, ',', '.').'</td><td>'.$detalle->personas.'</td></tr>';

  $total_cobrado += $detalle->cobrado;
  $total_personas+= $detalle->personas;
}
$detalle_cobros.= '<tr><td><b>TOTALES</b></td><td><b>'.number_format($total_cobrado, 2, ',', '.').'</b></td><td><b>'.$total_personas.'</b></td></tr></tbody></table></center>';
$pdf->SetFont('dejavusans', '', 9, '', true);
$pdf->writeHTML($detalle_cobros, true, true, true, true, '');


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

 ?>