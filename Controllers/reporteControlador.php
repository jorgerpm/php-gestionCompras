<?php

class reporteControlador extends reporteModelo {

    public function ejecutar_reportepdf_controlador() {
        $reporteDto = reporteModelo::ejecutar_reportepdf_modelo($_POST['reporte'], $_POST['id']);
        
        if(isset($reporteDto) && $reporteDto->respuesta == "OK"){
//            $output_file = "tmp/".$_POST['reporte'].".pdf";
//            $ifp = fopen("../".$output_file, 'wb' );
//            fwrite( $ifp, base64_decode( $reporteDto->reporteBase64 ) );
//            fclose( $ifp ); 
//            base64_decode($reporteDto->reporteBase64);
//            return $output_file;
            return $reporteDto->reporteBase64;
        }
        
        return "";
    }
    
    public function ejecutar_reportexls_controlador() {
        $reporteDto = reporteModelo::ejecutar_reportexls_modelo($_POST['reporte'], $_POST['fechaIni'], $_POST['fechaFin']);
        
        if(isset($reporteDto) && $reporteDto->respuesta == "OK"){
//            $output_file = "tmp/".$_POST['reporte'].".xls";
//            $ifp = fopen("../".$output_file, 'wb' );
//            fwrite( $ifp, base64_decode( $reporteDto->reporteBase64 ) );
//            fclose( $ifp ); 
//            base64_decode($reporteDto->reporteBase64);
//            return $output_file;
            return $reporteDto->reporteBase64;
        }
        
        return "";
    }
    
}
