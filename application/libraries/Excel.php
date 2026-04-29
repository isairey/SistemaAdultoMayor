<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once __DIR__."/PHPExcel/PHPExcel/IOFactory.php";
require_once __DIR__."/PHPExcel/PHPExcel.php";

class Excel extends PHPExcel 
{
    const FONT_SIZE_BASE = 10;
    const FONT_ARIAL = "Arial";

    public function __construct() {
        parent::__construct();
    }

    public function saveFile($name)
    {
        $filename=$name.date('dmYHis').'.xls';
        $file = FCPATH.'public/temp/'.$filename;

        $objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');  
        $objWriter->save($file);
        return 'public/temp/'.$filename;
    }

    public function descargarExcel($name)
    {
    	$filename=$name.date('dmYHis').'.xls'; //save our workbook as this file name XLSX

		header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
		header('Content-Type: application/vnd.ms-excel'); //mime type 
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
		header("Content-Type: application/force-download");
		header("Content-Transfer-Encoding: binary");
     
		$objWriter = PHPExcel_IOFactory::createWriter($this, 'Excel5');  
		$objWriter->save('php://output');
    }

    public function getObjectPhp($file)
    {
        $inputFileType = PHPExcel_IOFactory::identify($file);
        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
        return $objReader->load($file);
    }

    /**
    * obtiene la lista de todos los sheet de un objecto getObjectPhp, mediante un patron especificado
    * @copyright       Gobierno Autonomo Municipal de Cochabamba
    * @author          Ing. Ronald Achá Ramos
    * @version         1.0  2018-03-28
    */
    public function getSheets($objPHPExcel, $patron) 
    {
        try {
            $sheets = [];
            $i = 0;
            foreach ($objPHPExcel->getAllSheets() as $sheet) {
                $title = trim( strtolower($sheet->getTitle()));
                if(null != $sheet->getTitle() &&   !empty($sheet->getTitle()) && strpos(strtolower($sheet->getTitle()), strtolower($patron) ) !== false){
                    $sheets[ $title ] =  $sheet;
                    $i++;
                }
            }
            return $sheets;
        } catch (Exception $e) {
             die($e->getMessage());
        }
    }

    /**
    * Elimina una workSheet (hoja), mediante su titulo
    * @copyright       Gobierno Autonomo Municipal de Cochabamba
    * @author          Ing. Ronald Achá Ramos
    * @version         1.0  2018-04-04
    */
    public function deleteWorkSheet( $nameWorkSheet )
    {
        $this->setActiveSheetIndexByName($nameWorkSheet );
        $sheetIndex = $this->getActiveSheetIndex();
        $this->removeSheetByIndex($sheetIndex);
    }

    public function getStyleArial10(){
        return $styleArray = array(
                            'font'  => array(
                            'bold'  => false,
                            'size'  => Excel::FONT_SIZE_BASE,
                            'name'  => Excel::FONT_ARIAL
                        ));
    }

    public function getStyleArial12()
    {
        return $styleArray = array(
                            'font'  => array(
                            'bold'  => false,
                            'size'  => Excel::FONT_SIZE_BASE+2,
                            'name'  => Excel::FONT_ARIAL
                        ));
    }

    public function getStyleArial14()
    {
        return $styleArray = array(
                            'font'  => array(
                            'bold'  => false,
                            'size'  => Excel::FONT_SIZE_BASE+4,
                            'name'  => Excel::FONT_ARIAL
                        ));
    }

    public function getStyleBoldArial14()
    {
        return $styleArray = array(
                            'font'  => array(
                            'bold'  => true,
                            'size'  => Excel::FONT_SIZE_BASE+4,
                            'name'  => Excel::FONT_ARIAL
                        ));
    }

    public function getBorderThinBlack()
    {
        return array('borders' => 
                                array('right' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'), ),
                                      'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),),
                                      'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),),
                                      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),) 
                                     )
                            );
    }

    public function getBorderTopBottomThinBlack()
    {
        return array('borders' => 
                                array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),),
                                      'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN,'color' => array('argb' => '000000'),) 
                                     )
                            );
    }
}
