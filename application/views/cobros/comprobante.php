<?php
class MYPDF extends TCPDF {

}


// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, 'LETTER', true, 'UTF-8', false);

// set document information
$pdf->SetTitle('COMPROBANTE BONO DE DISCAPACIDAD');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
//$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set default font subsetting mode
//$pdf->setFontSubsetting(true);

$pdf->AddPage();

$pdf->SetY(40);
$pdf->SetFont('courier', 'B', 10, '', true);
$pdf->setX(16);

$pdf->Image(K_PATH_IMAGES.'logo.png', 5, 10, 40, 40, 'PNG');
$pdf->SetFont('helvetica', 'B', 11, '', true);
$pdf->Text(55, 25, 'GOBIERNO AUTÓNOMO MUNICIPAL DE COCHABAMBA');
$pdf->SetFont('helvetica', 'B', 9, '', true);
$pdf->Text(43, 30, 'BONO MUNICIPAL DE AYUDA ECONÓMICA PARA PERSONAS CON DISCAPACIDAD');
$pdf->Text(85, 35, '"ÁNGELICA PEÑALOZA"');

$pdf->SetFont('courier', '', 22, '', true);
$pdf->Text(153, 40, 'Nº:'.$pago->nro_comprobante);

$timestamp = explode(' ', $pago->fecha_cobro);

setlocale(LC_MONETARY, 'es_BO.UTF-8');
$monto = number_format($pago->monto, 2);

$html = '<table><tbody><tr><td height="20" style="text-align:left; "><b>BENEFICIARIO:</b>'.$pago->nombre.'</td><td height="20" style="text-align:rigth"><b>GESTIÓN:</b>'.$pago->nombre_gestion.'</td></tr>';
$html .= '<tr><td height="20" style="text-align:left; "><b>DOCUMENTO DE IDENTIDAD:</b>'.$pago->dni.'</td><td height="20" style="text-align:rigth; "><b>FECHA DE COBRO:</b>'.fecha($timestamp[0]).'</td></tr>';
$html .= '<tr><td text-align:left><b>MONTO:</b>'.$monto.' Bs.</td><td></td></tr></tbody></table>';

$pdf->SetY(55);
$pdf->SetFont('courier', '', 10, '', true);
$pdf->writeHTML($html, true, 0, true, true);

$firmas = '<table><tbody><tr><td width="20%"></td><td width="30%" height="110" border="1" style="text-align:center;"><b>FIRMA O HUELLA</b></td><td border="1" width="30%" height="110" style="text-align:center"><b>SELLO DE PAGO</b></td><td width="20%"></td></tr></tbody></table>';

$pdf->SetY(77);
$pdf->SetFont('courier', '', 10, '', true);
$pdf->writeHTML($firmas, true, 0, true, true);

$nota = '<p><b>NOTA: </b>El presente Bono fue cobrado por el '.$pago->cobrador.' del beneficiario cuyo nombre es: '.$pago->nombre_cobrador.'</p>';

if($pago->cobrador != 'BENEFICIARIO' AND $pago->cobrador != NULL)
{
  $pdf->SetY(125);
  $pdf->SetFont('courier', '', 8, '', true);
  $pdf->writeHTML($nota, true, 0, true, true);
}

// set style for barcode
$style_qr = array(
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

// QRCODE,L : QR-CODE Low error correction

$codigo = $pago->nombre.'; '.$pago->nro_comprobante.'; '.$pago->fecha_cobro;
$pdf->write2DBarcode($codigo, 'QRCODE,H', 180, 15, 25, 25, $style_qr, 'N');


$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt', 'join' => 'miter', 'dash' => 8);
$pdf->Line(10, 135, 205, 135, $style);

$pdf->SetY(47);
$pdf->SetFont('courier', 'B', 10, '', true);
$pdf->setX(16);

$pdf->Image(K_PATH_IMAGES.'logo.png', 5, 137, 40, 40, 'PNG');
$pdf->SetFont('helvetica', 'B', 11, '', true);

$pdf->Text(55, 152, 'GOBIERNO AUTÓNOMO MUNICIPAL DE COCHABAMBA');
$pdf->SetFont('helvetica', 'B', 9, '', true);
$pdf->Text(43, 157, 'BONO MUNICIPAL DE AYUDA ECONÓMICA PARA PERSONAS CON DISCAPACIDAD');
$pdf->Text(85, 162, '"ÁNGELICA PEÑALOZA"');

$pdf->write2DBarcode($codigo, 'QRCODE,H', 180, 140, 25, 25, $style_qr, 'N');


$pdf->SetFont('courier', '', 22, '', true);
$pdf->Text(153, 167, 'Nº:'.$pago->nro_comprobante);

$pdf->SetY(182);
$pdf->SetFont('courier', '', 10, '', true);
$pdf->writeHTML($html, true, 0, true, true);



$firmas = '<table><tbody><tr><td width="20%"></td><td width="30%" height="110" border="1" style="text-align:center;"><b>FIRMA O HUELLA</b></td><td border="1" width="30%" height="110" style="text-align:center"><b>SELLO DE PAGO</b></td><td width="20%"></td></tr></tbody></table>';

$pdf->SetY(207);
$pdf->SetFont('courier', '', 10, '', true);
$pdf->writeHTML($firmas, true, 0, true, true);

if($pago->cobrador != 'BENEFICIARIO' AND $pago->cobrador != NULL)
{
  $pdf->SetY(255);
  $pdf->SetFont('courier', '', 8, '', true);
  $pdf->writeHTML($nota, true, 0, true, true);
}


$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

 ?>
