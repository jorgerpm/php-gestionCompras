<?php

class archivoXmlModelo extends serviciosWebModelo {
    
    public function guardar_estado_modelo($datos){
        $respuesta = self::invocarPost('archivoXml/listarArchivosXml', $datos);
        return $respuesta;
    }
    
    
    public function listar_archivos($fechaIni, $fechaFin, $idUser) {
        $dateIni = strtotime($fechaIni) * 1000;
        $dateFin = strtotime($fechaFin) * 1000;
        $array = [];
        $listaArchivos = self::invocarGet('archivoXml/listarPorFecha?fechaInicio='.$dateIni.'&fechaFinal='.$dateFin.'&idUsuarioCarga='.$idUser, $array);
        return $listaArchivos;
    }
}