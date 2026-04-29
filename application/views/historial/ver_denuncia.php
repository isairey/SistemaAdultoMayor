<?php
global $footer_container;
$footer_container= $usuario_logeado;
class MYPDF extends TCPDF {

    //Page header
    public function Header()
    {
        // Logo
       $this->SetY(12);
        $this->SetFont('dejavusans', 'B', 8);
        $this->Image(K_PATH_IMAGES.'escudo.jpg', 17, 5, 19, 25, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Image(K_PATH_IMAGES.'logo.jpg', 250, 6, 33, 25, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Cell(25, 5, '');
        $this->Cell(0, 5, 'Secretaria de Desarrollo Humano', 0, 1);
        $this->Cell(25, 5, '');
        $this->Cell(0, 5, 'Dirección Género, Generacional y Familia', 0, 1);
        $this->Cell(25, 5, '');
        $this->Cell(0, 5, 'Departamento del Adulto Mayor', 0, 1);
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(18, 30, 282, 30, $style);
    }

    // Page footer
    public function Footer()
    {
       global $footer_container;
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 8);
        // Page number
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(18, 280, 195, 280, $style);
        $this->Cell(50, 10, fecha(date('Y-m-d')), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(150, 10, 'Usuario : '.$footer_container, 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(0, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


// create new PDF document
$pdf = new MYPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetTitle('HISTORIAL DE DENUNCIAS');

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
$pdf->Text(48, 32, 'HISTORIAL DE DENUNCIAS DEL '.fecha($fecha_inicial).' HASTA '.fecha($fecha_final));
$pdf->SetFont('dejavusans', 'B', 11, '', true);
$pdf->Text(90,42, 'SUBALCALDIA '.$datos_centro->nombre_centro.' - DATOS GENERALES');

$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(18, 40, 282, 40, $style);
$pdf->ln(15);

$pdf->SetFont('dejavusans', '', 8, '', true);

$html = '';

$numero=1;

  $pdf->setXY(14,50);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(4, 8, 'Nº', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(23, 8, 'FECHA DENUN.', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(45, 8, 'TIPOLOGÍA', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(45, 8, 'DENUNCIANTE', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(45, 8, 'VICTIMA', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(23, 8, 'FECHA NAC.', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(9, 8, 'EDAD', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(15, 8, 'GENERO', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(24, 8, 'DERIVADO POR', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(25, 8, 'REMITIDO A', 0, 0, 'C', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', 'B', 8, '', true);
  $pdf->SetFillColor(255, 160, 40);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(25, 8, 'DOCUMENTOS', 0, 0, 'C', 1, '', 3);

  $pdf->SetTextColor(0, 0, 0);
  $pdf->SetFont('helvetica', '', 7, '', true);

  $pdf->setY(55);
foreach ($denuncias as $denuncia){
  $victima = $this->main->getField('victima','nombre_completo', array('id_victima'=> $denuncia->id_victima));
  $sep_fecha = explode('-', $denuncia->fecha_nacimiento);
  $anio_naci = $sep_fecha[0];
  $anio_act = date('Y');
  $edad = $anio_act - $anio_naci;

  $der= "AREA PSICOLOGICA, AREA SOCIAL";
  if($denuncia->derivacion == $der){
      $derivacion = "PSICOLOGIA, SOCIAL";
  }
  else {
    $derivacion = $denuncia->derivacion;
  }
  $instacias_jurisdicinales = $this->main->getField('area_legal','instancias_jurisdicionales',array('id_denuncia'=>$denuncia->id_denuncia));
  if($instacias_jurisdicinales == "TRIBUNAL DEPARTAMENTAL DE JUSTICIA"){
      $instacias_jurisdicinales = "TRIB. DEP. DE JUSTICIA";
  }


  $pdf->writeHTML($html, true, true, true, true, '');

  $pdf->Cell(4, 8, $numero, 0, 0, 'L', 0, '', 3);

  $pdf->Cell(23, 8, fecha($denuncia->fecha_denuncia), 0, 0, 'C', 0, '', 3);

  $pdf->Cell(45, 8, $denuncia->tipologia, 0, 0, 'C', 0, '', 3);

  $pdf->Cell(45, 8, $denuncia->denunciante, 0, 0, 'C', 0, '', 3);

  $pdf->Cell(45, 8, $victima, 0, 0, 'C', 0, '', 3);

  $pdf->Cell(23, 8, fecha($denuncia->fecha_nacimiento), 0, 0, 'C', 0, '', 3);

  $pdf->Cell(9, 8, $edad, 0, 0, 'C', 0, '', 3);

  $pdf->Cell(15, 8, $denuncia->sexo, 0, 0, 'C', 0, '', 3);

  $pdf->Cell(24, 8, $derivacion, 0, 0, 'C', 0, '', 3);

  $pdf->Cell(25, 8, $instacias_jurisdicinales, 0, 1, 'C', 0, '', 3);

  $numero++;
}

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.*/
$pdf->Output('denuncias.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

 ?>
