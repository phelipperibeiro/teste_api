<?php

namespace App\Services;

class UtilsService
{

    public static function getSheets($fileName)
    {
        try {
            $fileType = \PHPExcel_IOFactory::identify($fileName);
            $objReader = \PHPExcel_IOFactory::createReader($fileType);
            $objPHPExcel = $objReader->load($fileName);
            $sheets = [];
            foreach ($objPHPExcel->getAllSheets() as $sheet) {
                $sheets[$sheet->getTitle()] = $sheet->toArray();
            }
            return $sheets;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}
