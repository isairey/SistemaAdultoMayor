<?php
class MYPDF extends TCPDF {

    //Page header
    public function Header()
    {
        // Logo
       $this->SetY(8);
        $this->SetFont('dejavusans', 'B', 8);
        $this->Image(K_PATH_IMAGES.'escudo.jpg', 17, 5, 17, 20, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Cell(20, 5, '');
        $this->Cell(0, 5, 'Gobierno Autónomo Municipal de Cochabamba', 0, 1);
        $this->Cell(20, 5, '');
        $this->Cell(0, 5, 'Dirección de Género Generacional y Familia', 0, 1);
        $this->Cell(20, 5, '');
        $this->Cell(0, 5, 'Departamento de Desarrollo de Personas con Discapacidad', 0, 1);
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(18, 27, 280, 27, $style);
    }

    // Page footer
    public function Footer()
    {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 8);
        // Page number
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(18, 193, 280, 193, $style);
        $this->Cell(50, 10, fecha(date('Y-m-d')), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('REPORTE DE COBROS REALIZADOS');

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
$pdf->SetFont('dejavusans', 'B', 13, '', true);
$pdf->Text(70, 30, 'REPORTE DE COBROS REALIZADOS GESTION MUNICIPAL '.$this->session->userdata('gestion'));

$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(18, 38, 280, 38, $style);
$pdf->ln(15);

$pdf->SetFont('dejavusans', '', 10, '', true);


$pdf->setXY(19,45);
$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->SetFillColor(21, 94, 21);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(12, 8, 'Nº', 1, 0, 'C', 1, '', 3);
$pdf->Cell(60, 8, 'NOMBRE BENEFICIARIO', 1, 0, 'C', 1, '', 3);
$pdf->Cell(20, 8, 'C.I.', 1, 0, 'C', 1, '', 3);
$pdf->Cell(18, 8, 'GESTIÓN', 1, 0, 'C', 1, '', 3);
$pdf->Cell(57, 8, 'FECHA DE COBRO', 1, 0, 'C', 1, '', 3);
$pdf->Cell(22, 8, 'Nº COMPR.', 1, 0, 'C', 1, '', 3);
$pdf->Cell(30, 8, 'QUIEN COBRO', 1, 0, 'C', 1, '', 3);
$pdf->Cell(40, 8, 'PAGADO POR', 1, 1, 'C', 1, '', 3);



$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 7, '', true);
$n = 1; $monto = 0;
foreach ($reporte as $print)
{
$fecha_hora = explode(' ', $print->fecha_cobro);

$pdf->setX(19);
   if($n%2==1)
      $pdf->SetFillColor(255, 255, 255);
   else
      $pdf->SetFillColor(210, 210, 210);

   $pdf->Cell(12, 8, $n, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(60, 8, $print->nombre, 1, 0, 'L', 1, '', 3);
   $pdf->Cell(20, 8, $print->dni, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(18, 8, $print->nombre_gestion, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(57, 8, fecha($fecha_hora[0]).' Hrs:'.$fecha_hora[1], 1, 0, 'C', 1, '', 3);
   $pdf->Cell(22, 8, $print->nro_comprobante, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(30, 8, $print->cobrador, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(40, 8, $print->pagado_por, 1, 1, 'C', 1, '', 3);

   $n+=1;

   $monto += $print->monto;
}
$pdf->SetFont('helvetica', 'B', 10, '', true);
$pdf->setX(19);
$pdf->Cell(219, 8, 'TOTALES', 1, 0, 'C', 1, '', 3);
$pdf->Cell(40, 8, number_format($monto, 2, ',', '.'), 1, 1, 'C', 1, '', 3);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.*/
$pdf->Output('reporte-de-cobros.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+

 ?>
