<?php
class MYPDF extends TCPDF {

    //Page header
    public function Header()
    {
        // Logo
       $this->SetY(8);
        $this->SetFont('dejavusans', 'B', 8);
        $this->Image(K_PATH_IMAGES.'escudo.jpg', 17, 5, 17, 20, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Image(K_PATH_IMAGES.'logo.jpg', 165, 7, 35, 22, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Cell(20, 5, '');
        $this->Cell(0, 5, 'Departamento del Adulto Mayor', 0, 1);
        $this->Cell(20, 5, '');
        $this->Cell(0, 5, 'Dirección de Género Generacional y Familia', 0, 1);
        $this->Cell(20, 5, '');
        $this->Cell(0, 5, 'Secretaria de Desarrolo Humano', 0, 1);
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
$pdf->SetTitle('KARDEX INDIVIDUAL DE PERSONAS ADULTAS');

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
$pdf->Text(33, 30, 'KARDEX INDIVIDUAL DE PERSONAS ADULTAS');

$style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
$pdf->Line(18, 38, 195, 38, $style);
$pdf->ln(15);

$pdf->SetFont('dejavusans', '', 10, '', true);

if($kardex->foto != null){
  $fotografia = explode('.',$kardex->foto);
   $pdf->Image(FCPATH.'/public/fotos/adultos/'.$kardex->foto, 19, 45, 45, 48, $fotografia[1], '', '', true, 150, '', false, false, 1, false, false, false);

}else
   $pdf->Image(FCPATH.'/public/fotos/default.png', 19, 45, 45, 48, 'PNG', '', '', true, 150, '', false, false, 1, false, false, false);

$html = '';

$html.='
      <table cellpadding="6" cellspacing="2" border="1" style="text-align: justify">
      	<tr style="background-color: #A77251;">
              <th><b style="color: #FFFFFF;">I.- DATOS PERSONALES DEL ADULTO</b></th>
      	 </tr>
       </table>';
 $pdf->setX(66);
 $pdf->writeHTML($html, true, true, true, true, '');
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(40, 8, 'Nombre Completo:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(87, 8, $kardex->nombre_completo, 1, 1, 'C', 0, '', 3);

 $pdf->setX(67);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(40, 8, 'Fecha de Nacimiento:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(44, 8, fecha($kardex->fecha_nacimiento), 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(20, 8, 'Género:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(23, 8, $kardex->sexo, 1, 1, 'C', 0, '', 3);

 $sep_fecha = explode('-', $kardex->fecha_nacimiento);
 $anio_naci = $sep_fecha[0];
 $anio_act = date('Y');
 $edad = $anio_act - $anio_naci;

 $pdf->setX(67);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(12, 8, 'Edad:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(21, 8, $edad.' años', 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(18, 8, 'Nº Carnet:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(24, 8, $kardex->dni, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(20, 8, 'Expedido:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(32, 8, $kardex->expedido, 1, 1, 'C', 0, '', 3);


 $pdf->setX(67);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(30, 8, 'Dirección:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(97, 8, $kardex->domicilio, 1, 1, 'C', 0, '', 3);


 $pdf->setX(67);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(20, 8, 'Estado Civil:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(25, 8, $kardex->estado_civil, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(22, 8, 'Telefono:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(20, 8, $kardex->telefono, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(20, 8, 'Celular:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(20, 8, $kardex->celular, 1, 1, 'C', 0, '', 3);

 $pdf->setXY(19,100);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->SetFillColor(137, 84, 40);
 $pdf->SetTextColor(255, 255, 255);
 $pdf->Cell(0, 8, 'II.- DATOS COMPLEMENTARIOS', 1, 1, 'L', 1, '', 1);
 $pdf->SetTextColor(0, 0, 0);

 $pdf->setXY(19,108);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->Cell(25, 8, 'Formación:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(30, 8, $kardex->instruccion, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(20, 8, 'Trabaja:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(30, 8, $kardex->ocupacion, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(20, 8, 'Idioma(s):', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(51, 8, $kardex->idioma, 1, 1, 'C', 0, '', 3);

 $pdf->setXY(19,116);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(25, 8, 'Nº hijos:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(30, 8, $kardex->nro_hijos, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(20, 8, 'Nº Ñietos:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(30, 8, $kardex->nro_nietos, 1, 1, 'C', 0, '', 3);



 $pdf->setXY(19,130);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->SetFillColor(137, 84, 40);
 $pdf->SetTextColor(255, 255, 255);
 $pdf->Cell(0, 8, 'III.- DETALLE DE VIVIENDA', 1, 1, 'L', 1, '', 1);
 $pdf->SetTextColor(0, 0, 0);
 $nombre_parentesco = $this->main->getField ('parentesco', 'nombre',array('id_parentesco'=>$kardex->vive_con));
 $pdf->setXY(19,138);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->Cell(20, 8, 'Vive con:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(30, 8, $nombre_parentesco, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->Cell(25, 8, 'Persona Ref:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(57, 8, $kardex->nombre_referencia, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->Cell(20, 8, 'Telefono:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(24, 8, $kardex->telefono_referencia, 1, 0, 'C', 0, '', 3);


 $pdf->setXY(19,152);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->SetFillColor(137, 84, 40);
 $pdf->SetTextColor(255, 255, 255);
 $pdf->Cell(0, 8, 'IV.- DETALLE DE BENEFICIOS', 1, 1, 'L', 1, '', 1);
 $pdf->SetTextColor(0, 0, 0);

 $pdf->setXY(19,160);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->Cell(35, 8, 'Beneficio que Percibe:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(54, 8, $kardex->beneficio, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->Cell(30, 8, 'Seguro de Salud:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 9, '', true);
 $pdf->Cell(57, 8, $kardex->salud, 1, 1, 'C', 0, '', 3);



/*
$pdf->setXY(144,115);
$pdf->SetFont('helvetica', 'B', 9, '', true);
$pdf->SetFillColor(21, 94, 21);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(50, 8, 'SERVICIOS BASICOS', 1, 1, 'C', 1, '', 3);
$pdf->SetTextColor(0, 0, 0);
foreach ($servicios as $servicio) {
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->setX(144);
  $pdf->Cell(35, 8, $servicio->nombre_servicio, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('zapfdingbats', '', 16);
  if($servicio->estado === 'DC')
     $pdf->Cell(15, 8, TCPDF_FONTS::unichr(54), 1, 1, 'C', 0, '', 3);
  else
     $pdf->Cell(15, 8, TCPDF_FONTS::unichr(52), 1, 1, 'C', 0, '', 3);
}



$pdf->setXY(19,200);
$pdf->SetFont('helvetica', 'B', 10, '', true);
$pdf->SetFillColor(21, 94, 21);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(0, 8, 'II.- DATOS ESPECIFICOS DE LA DISCAPACIDAD', 1, 1, 'L', 1, '', 3);
$pdf->SetTextColor(0, 0, 0);

 $pdf->setXY(19,208);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(11, 8, 'Tipo:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 8, '', true);
 $pdf->Cell(45, 8, $kardex->discapacidad, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(12, 8, 'Grado:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 8, '', true);
 $pdf->Cell(22, 8, $kardex->grado_discapacidad, 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(20, 8, 'Porcentaje:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 8, '', true);
 $pdf->Cell(10, 8, $kardex->porcentaje_discapacidad.'%', 1, 0, 'C', 0, '', 3);
 $pdf->SetFont('helvetica', 'B', 9, '', true);
 $pdf->Cell(13, 8, 'Causa:', 1, 0, 'L', 0, '', 3);
 $pdf->SetFont('helvetica', '', 8, '', true);
 $pdf->Cell(43, 8, $kardex->causa_discapacidad, 1, 1, 'C', 0, '', 3);

 $pdf->setXY(19,220);
 $pdf->SetFont('helvetica', 'B', 10, '', true);
 $pdf->SetFillColor(21, 94, 21);
 $pdf->SetTextColor(255, 255, 255);
 $pdf->Cell(0, 8, 'III.- EDUCACION', 1, 1, 'L', 1, '', 3);
 $pdf->SetTextColor(0, 0, 0);

  $pdf->setXY(19,228);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(38, 8, 'Grado de Instrucción:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(50, 8, $kardex->grado_instruccion, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(38, 8, 'Educación Especial:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(50, 8, $kardex->nombre_centro_especial, 1, 1, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->setX(19);
  $pdf->Cell(38, 8, 'Educación Regular:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(138, 8, $kardex->nombre_centro_regular, 1, 1, 'C', 0, '', 3);

  $pdf->setXY(19,249);
  $pdf->SetFont('helvetica', 'B', 10, '', true);
  $pdf->SetFillColor(21, 94, 21);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(0, 8, 'IV.- LABORAL Y/O OCUPACIONAL', 1, 1, 'L', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);

  $pdf->setXY(19,257);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(20, 8, 'Profesión:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(40, 8, $kardex->profesion, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(20, 8, 'Ocupación:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(40, 8, $kardex->ocupacion, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(16, 8, 'Entidad:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(40, 8, $kardex->institucion_empresa, 1, 1, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->setX(19);
  $pdf->Cell(30, 8, 'Lugar de Trabajo:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(80, 8, $kardex->lugar_trabajo, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(30, 8, 'Tipo de Trabajo:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(36, 8, $kardex->su_trabajo, 1, 1, 'C', 0, '', 3);


  $pdf->AddPage();
  $pdf->setXY(19,30);
  $pdf->SetFont('helvetica', 'B', 10, '', true);
  $pdf->SetFillColor(21, 94, 21);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(0, 8, 'V.- SERVICIOS DE SALUD', 1, 1, 'L', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);

  $pdf->setXY(19,38);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(136, 8, 'Para el tratamiento terapeutico de su discapacidad, ud. acude a un Centro de Salud:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(40, 8, $kardex->salud_servicio, 1, 1, 'C', 0, '', 3);
  $pdf->setX(19);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(50, 8, 'Nombre del Centro de Salud:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(70, 8, $kardex->nombre_centro, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(16, 8, 'Tipo:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(40, 8, $kardex->tipo_centro_medico, 1, 1, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->setX(19);
  $pdf->Cell(85, 8, 'Medicamentos que requiere para su discapacidad:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(91, 8, $kardex->medicamentos, 1, 1, 'C', 0, '', 3);

  $pdf->setX(19);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(60, 8, 'Donde adquiere los medicamentos:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(56, 8, $kardex->adquiere_medicamentos, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(45, 8, 'Cuenta con ayuda tecnica:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(15, 8, $kardex->recibe_ayudas_tecnicas, 1, 1, 'C', 0, '', 3);
  $pdf->setX(19);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(156, 8, 'Necesita ayuda de otra persona para realizar sus actividades cotidianas:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(20, 8, $kardex->ayuda_permanente, 1, 1, 'C', 0, '', 3);

  $pdf->setXY(19,83);
  $pdf->SetFont('helvetica', 'B', 10, '', true);
  $pdf->SetFillColor(21, 94, 21);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(0, 8, 'VI.- VIVIENDA', 1, 1, 'L', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);

  $pdf->setX(19);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(40, 8, 'Tipo de Vivienda:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(50, 8, $kardex->tipo_vivienda, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(45, 8, 'Propiedad de la Vivienda:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(41, 8, $kardex->propiedad, 1, 1, 'C', 0, '', 3);

  $pdf->setXY(19,105);
  $pdf->SetFont('helvetica', 'B', 10, '', true);
  $pdf->SetFillColor(21, 94, 21);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(0, 8, 'VII.- PARTICIPACION EN ASOCIACION DE PERSONAS CON DISCAPACIDAD', 1, 1, 'L', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);

  $pdf->setX(19);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(110, 8, 'Está afiliado a una organización de personas con discapacidad:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(66, 8, $kardex->organizacion, 1, 1, 'C', 0, '', 3);

  $pdf->setXY(19,127);
  $pdf->SetFont('helvetica', 'B', 10, '', true);
  $pdf->SetFillColor(21, 94, 21);
  $pdf->SetTextColor(255, 255, 255);
  $pdf->Cell(0, 8, 'VIII.- SERVICIOS QUE OCUPA DEL DPTO. DE DESARROLLO DE PERSONAS CON DISCAPACIDAD', 1, 1, 'L', 1, '', 3);
  $pdf->SetTextColor(0, 0, 0);

  $pdf->setX(19);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(27, 8, 'Atencion Legal:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(10, 8, $kardex->atencion_legal, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(27, 8, 'Atencion Social:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(10, 8, $kardex->atencion_social, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(35, 8, 'Atencion Psicológica:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(10, 8, $kardex->atencion_psicologica, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(15, 8, 'I.L.S.B.:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(10, 8, $kardex->ilsb, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(22, 8, 'Calificación:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(10, 8, $kardex->calificacion, 1, 1, 'C', 0, '', 3);
  $pdf->setX(19);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(22, 8, 'Bus Escolar:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(10, 8, $kardex->bus_escolar, 1, 0, 'C', 0, '', 3);
  $pdf->SetFont('helvetica', 'B', 9, '', true);
  $pdf->Cell(50, 8, 'Actividades del Departamento:', 1, 0, 'L', 0, '', 3);
  $pdf->SetFont('helvetica', '', 8, '', true);
  $pdf->Cell(94, 8, $kardex->actividades_departamento, 1, 1, 'C', 0, '', 3);




//$pdf->writeHTML($docs, true, true, true, true, '');

/*
//$bg = 0;
//$color= 'background-color:#DFDFDF';
/*
foreach ($funcionarios as $funcionario)
{

   //var_dump($funcionario->nombre_completo);

   $html.= '<tr  style="text-align:justify; '. (($bg) ? $color : "").'">
				<td height="80px" valign="middle">'.$funcionario->nombre_completo.'</td>
                <td valign="middle">'.$funcionario->unidad.'</td>
                <td valign="middle">'.$funcionario->cargo.'</td>
                <td valign="middle"></td>
			 </tr>';
			 $bg = !$bg;
}

$html.='</table>';
*/



// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.*/
$pdf->Output('kardex-adultoMayor.pdf', 'I');
//============================================================+
// END OF FILE
//============================================================+

 ?>
