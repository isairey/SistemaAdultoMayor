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
        $this->Cell(0, 5, 'Departamento de Tesorería', 0, 1);
        $this->Cell(20, 5, '');
        $this->Cell(0, 5, 'Caja Pagadora', 0, 1);
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
$pdf->SetTitle('REPORTE DE PAGOS PENDIENTES');

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
$pdf->Text(30, 30, 'REPORTE DE PAGOS PENDIENTES GESTION MUNICIPAL '.$this->session->userdata('gestion'));

$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(18, 38, 195, 38, $style);
$pdf->ln(15);

$pdf->SetFont('dejavusans', '', 10, '', true);


$pdf->setXY(19,45);
$pdf->SetFont('helvetica', 'B', 8, '', true);
$pdf->SetFillColor(21, 94, 21);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(15, 8, 'Nº', 1, 0, 'C', 1, '', 3);
$pdf->Cell(95, 8, 'NOMBRE BENEFICIARIO', 1, 0, 'C', 1, '', 3);
$pdf->Cell(35, 8, 'C.I.', 1, 0, 'C', 1, '', 3);
$pdf->Cell(28, 8, 'GESTIÓN', 1, 1, 'C', 1, '', 3);




$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('helvetica', '', 9, '', true);
$n = 1;

//var_dump($reporte); die();
foreach ($reporte as $print)
{

$pdf->setX(19);
   if($n%2==1)
      $pdf->SetFillColor(255, 255, 255);
   else
      $pdf->SetFillColor(210, 210, 210);

   $pdf->Cell(15, 8, $n, 1, 0, 'C', 1, '', 3);
   $pdf->setCellPaddings( $left = '5', $top = '', $right = '', $bottom = '');
   $pdf->Cell(95, 8, $print->nombre, 1, 0, 'L', 1, '', 3);
   $pdf->Cell(35, 8, $print->dni, 1, 0, 'C', 1, '', 3);
   $pdf->Cell(28, 8, $print->nombre_gestion, 1, 1, 'C', 1, '', 3);

   $n+=1;
}

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.*/
$pdf->Output('reporte-pendientes.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+

 ?>
