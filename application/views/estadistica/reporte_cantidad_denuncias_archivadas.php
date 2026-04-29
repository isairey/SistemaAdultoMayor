<?php
global $footer_container;
$footer_container= $usuario_logeado;
class MYPDF extends TCPDF {

    //Page header
    public function Header()
    {
        // Logo
       $this->SetY(12);
        $this->SetFont('dejavusans', 'B', 9);
        $this->Image(K_PATH_IMAGES.'escudo.jpg', 17, 5, 19, 25, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Image(K_PATH_IMAGES.'logo.jpg', 150, 8, 45, 25, 'JPG', '', '', true, 150, '', false, false, 0, false, false, false);
        $this->Cell(22, 5, '');
        $this->Cell(0, 5, 'Secretaria de Desarrollo Humano', 0, 1);
        $this->Cell(22, 5, '');
        $this->Cell(0, 5, 'Dirección Género, Generacional y Familia', 0, 1);
        $this->Cell(22, 5, '');
        $this->Cell(0, 5, 'Departamento del Adulto Mayor', 0, 1);
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(18, 30, 195, 30, $style);
    }

    // Page footer
    public function Footer()
    {global $footer_container;
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('dejavusans', 'I', 8);
        // Page number
        $style = array('width' => 0.5, 'color' => array(0, 0, 0), 'cap' => 'butt');
        $this->Line(18, 280, 195, 280, $style);
        $this->Cell(50, 10, fecha(date('Y-m-d')), 0, false, 'L', 0, '', 0, false, 'T', 'M');
        $this->Cell(65, 10, 'Usuario : '.$footer_container, 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Cell(80, 10, 'Pagina '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}


// create new PDF document
$pdf = new MYPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// datos por defecto de cabecera, se pueden modificar en el archivo tcpdf_config.php de libraries/config
      $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
      $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
      $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
      $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
      $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
      $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// se pueden modificar en el archivo tcpdf_config.php de libraries/config
      $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//relación utilizada para ajustar la conversión de los píxeles
      $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


// ---------------------------------------------------------
// establecer el modo de fuente por defecto
      $pdf->setFontSubsetting(true);

// Establecer el tipo de letra

//Si tienes que imprimir carácteres ASCII estándar, puede utilizar las fuentes básicas como
// Helvetica para reducir el tamaño del archivo.
      $pdf->SetFont('helvetica', '', 14, '', true);

// Añadir una página
// Este método tiene varias opciones, consulta la documentación para más información.
      $pdf->AddPage();

//fijar efecto de sombra en el texto
      $pdf->setTextShadow(array('enabled' => true, 'depth_w' => 0.2, 'depth_h' => 0.2, 'color' => array(196, 196, 196), 'opacity' => 1, 'blend_mode' => 'Normal'));

// Establecemos el contenido para imprimir
      $anio = $this->session->gestion;

      $inicio = $anio.'-01-01';
      $fin = $anio.'-12-31';

      $where['fecha_denuncia >='] = $inicio;
      $where['fecha_denuncia <='] = $fin;
      $where['denuncia_archivada ='] =1;
      if(!empty($this->session->servidor->id_centro))
         $where['id_centro ='] = $this->session->servidor->id_centro;

      ////* DENUNCIAS ARCHIVADAS */
      $select_denuncia_arch = 'COUNT(denuncia.denuncia_archivada) AS ar';
      $denuncia_archivadas = $this->main->getListSelect('denuncia', $select_denuncia_arch, null, $where);

      $where_den['fecha_denuncia >='] = $inicio;
      $where_den['fecha_denuncia <='] = $fin;
      if(!empty($id_centro))
         $where_den['id_centro ='] = $id_centro;
      $select_total_denuncia = 'COUNT(denuncia.id_denuncia) AS total';
      $total_denuncias =$this->main->getListSelect('denuncia',$select_total_denuncia,null,$where_den);

      $where_cerr['fecha_denuncia >='] = $inicio;
      $where_cerr['fecha_denuncia <='] = $fin;
      $where_cerr['denuncia_cerrada ='] =1;
      if(!empty($id_centro))
         $where_cerr['id_centro ='] = $id_centro;
      $select_denuncia_cerr = 'COUNT(denuncia.denuncia_cerrada) AS ce';
      $denuncia_cerradas = $this->main->getListSelect('denuncia', $select_denuncia_cerr, null, $where_cerr);


      //consulta de denuncias en situacion de acogida
      foreach ($total_denuncias as $fila)
      {
        $den = "Total Denuncias";
        $cant3 = $fila->total;

      }
      foreach ($denuncia_archivadas as $fila)
      {
        $arch = "Denuncias Archivadas";
        $cant1 = $fila->ar;
        $porcentaje1 = round(($cant1 * 100)/$cant3,2);
      }
      foreach ($denuncia_cerradas as $fila)
      {
        $cerr = "Denuncias Cerradas";
        $cant2 = $fila->ce;
        $porcentaje2 = round(($cant2 * 100)/$cant3,2);
      }


      //preparamos y maquetamos el contenido a crear
      $html = '';
      $html .= "<style type=text/css>";
      $html .= "th{color: #fff; font-weight: bold; background-color: #A77251; text-align: center}";
      $html .= "td{background-color: #CBD0D0; color: #222; text-align: center}";
      $html .= "</style>";
      $html .= "<h2>Total de Denuncias de la Gestión ".$anio."</h2><h4>Actualmente: ".$cant3."</h4>";
      $html .= "<div class='large-6 columns large-centered'>";
      $html .= "<table width='70%'>";
      $html .= "<tr><th>Acogida</th><th>Cantidad</th><th>Porcentaje</th></tr>";


      //$porcentaje1 = round(($cant1 * 100)/$cant3,2);
      //$porcentaje2 = round(($cant2 * 100)/$cant3,2);

      $html .= "<tr><center><td align='center' class='instancias'>" . $arch . "</td align='center' ><td class='cantidad'>" . $cant1. "</td><td class='porcentaje'> ".$porcentaje1." %</td></center></tr>";
      $html .= "<tr><center><td align='center' class='instancias'>" . $cerr . "</td align='center' ><td class='cantidad'>" . $cant2. "</td><td class='porcentaje'> ".$porcentaje2." %</td></center></tr>";
      $html .= "<tr><center><td align='center' class='instancias'><strong>" . $den . "</strong></td align='center' ><td class='cantidad'><strong> " . $cant3. "</strong></td><td  class='porcentaje'><strong> 100.00 %</strong></td></center></tr>";

    $html .= "</table>";
    $html .= "</div>";

// Imprimimos el texto con writeHTMLCell()
      $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

// ---------------------------------------------------------
// Cerrar el documento PDF y preparamos la salida
// Este método tiene varias opciones, consulte la documentación para más información.


      $nombre_archivo = utf8_decode("Denuncias Cerradas y Archivadas ".$anio.".pdf");
      $pdf->Output($nombre_archivo, 'I');

 ?>
