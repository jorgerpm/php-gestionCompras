<?php

class archivoXmlModelo extends serviciosWebModelo {
    
    public function guardar_estado_modelo($datos){
        $respuesta = self::invocarPost('archivoXml/listarArchivosXml', $datos);
        return $respuesta;
    }
    
    
    public function listar_archivos($fechaIni, $fechaFin, $idUser, $desde, $hasta) {
//        $dateIni = strtotime($fechaIni) * 1000;
//        $dateFin = strtotime($fechaFin) * 1000;
        $array = [];
        $listaArchivos = self::invocarGet('archivoXml/listarPorFecha?fechaInicio='.$fechaIni.'&fechaFinal='.$fechaFin.'&idUsuarioCarga='.$idUser.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaArchivos;
    }
}