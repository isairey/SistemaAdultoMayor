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
        $this->Line(18, 27, 195, 27, $style);
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
        $this->Line(18, 280, 195, 280, $style);
        $this->Cell(50, 10, fecha(date('Y-m-d')), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('REPORTE DE PAGOS REALIZADOS');

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
$pdf->Text(30, 30, 'REPORTE DE PAGOS REALIZADOS GESTION MUNICIPAL '.$this->session->userdata('gestion'));

$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(18, 38, 195, 38, $style);
$pdf->ln(15);

$pdf->SetFont('dejavusans', '', 10, '', true);


$pdf->setXY(19,45);
$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->SetFillColor(21, 94, 21);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(12, 8, 'Nº', 1, 0, 'C', 1, '', 3);
$pdf->Cell(23, 8, 'GESTIÓN', 1, 0, 'C', 1, '', 3);
$pdf->Cell(35, 8, 'BENEFICIARIOS', 1, 0, 'C', 1, '', 3);
$pdf->Cell(35, 8, 'DESEMBOLSO', 1, 0, 'C', 1, '', 3);
$pdf->Cell(35, 8, 'COBRADO', 1, 0, 'C', 1, '', 3);
$pdf->Cell(35, 8, 'PENDIENTE DE COBRO', 1, 1, 'C', 1, '', 3);




$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 10, '', true);
$n = 1; $total_desembolso = 0; $total_pagado = 0;
foreach ($pagos as $print)
{

$pdf->setX(19);
   if($n%2==1)
      $pdf->SetFillColor(255, 255, 255);
   else
      $pdf->SetFillColor(210, 210, 210);

   $pdf->Cell(12, 9, $n, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(23, 9, $print->mes.'-'.$print->anio, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(35, 9, $print->beneficiarios, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(35, 9, number_format($print->desembolso,2,',','.').' Bs.', 1, 0, 'C', 1, '', 3);
   $pdf->Cell(35, 9, number_format($print->pagado,2,',','.').' Bs.', 1, 0, 'C', 1, '', 3);
   $pdf->Cell(35, 9, number_format($print->desembolso-$print->pagado,2,',','.'). ' Bs.', 1, 1, 'C', 1, '', 3);

   $total_desembolso +=$print->desembolso;
   $total_pagado +=$print->pagado;

   $n+=1;
}

$pdf->setX(19);

$pdf->Cell(70, 9, 'TOTALES', 1, 0, 'C', 1, '', 3);
$pdf->Cell(35, 9, number_format($total_desembolso,2,',','.').' Bs.', 1, 0, 'C', 1, '', 3);
$pdf->Cell(35, 9, number_format($total_pagado,2,',','.').' Bs.', 1, 0, 'C', 1, '', 3);
$pdf->Cell(35, 9, number_format($total_desembolso-$total_pagado,2,',','.'). ' Bs.', 1, 1, 'C', 1, '', 3);


// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.*/
$pdf->Output('reporte-de-cobros.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+

 ?>
