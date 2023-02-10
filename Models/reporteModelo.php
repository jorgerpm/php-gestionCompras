<?php

class reporteModelo extends serviciosWebModelo {

    protected function ejecutar_reportepdf_modelo($reporte, $id) {
        $array = [];
        $reporteDto = self::invocarGet('reportes/generarReportePdf?reporte=' . $reporte . '&id=' . $id, $array);
        return $reporteDto;
    }

    protected function ejecutar_reportexls_modelo($reporte, $fechaIni, $fechaFin) {
        $array = [];
        $reporteDto = self::invocarGet('reportes/generarReporteXls?reporte=' . $reporte . "&fechaIni=".$fechaIni."&fechaFin=".$fechaFin, $array);
        return $reporteDto;
    }
    
}
