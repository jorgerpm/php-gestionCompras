<?php

class solicitudModelo extends serviciosWebModelo {
    
    protected function listar_solicitud_modelo($fechaIni, $fechaFin, $codigoSolicitud, $desde, $hasta) {
        $array = [];
        //$listaSolicts = self::invocarGet('solicitud/listarSolicitudes?fechaInicial='.'2022-01-01'.'&fechaFinal='.'2022-12-30'.'&codSolicitud='.$codigoSolicitud.'&desde='.'1'.'&hasta='.'10', $array);
        $listaSolicts = self::invocarGet('solicitud/listarSolicitudes?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codSolicitud='.$codigoSolicitud.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaSolicts;
    }
    
    protected function guardar_solicitud_modelo($data){
        $solicitud = self::invocarPost('solicitud/guardarSolicitud', $data);
        return $solicitud;
    }
    
}