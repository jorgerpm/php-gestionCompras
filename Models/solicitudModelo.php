<?php

class solicitudModelo extends serviciosWebModelo {
    
    protected function listar_solicitud_modelo($fechaIni, $fechaFin, $codigoSolicitud, $codigoRC, $idUsuario, $desde, $hasta) {
        $array = [];
        //$listaSolicts = self::invocarGet('solicitud/listarSolicitudes?fechaInicial='.'2022-01-01'.'&fechaFinal='.'2022-12-30'.'&codSolicitud='.$codigoSolicitud.'&desde='.'1'.'&hasta='.'10', $array);
        $listaSolicts = self::invocarGet('solicitud/listarSolicitudes?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codigoSolicitud='.$codigoSolicitud.'&codigoRC='.$codigoRC.'&desde='.$desde.'&hasta='.$hasta.'&idUsuario='.$idUsuario, $array);
        return $listaSolicts;
    }
    
    protected function guardar_solicitud_modelo($data){
        $solicitud = self::invocarPost('solicitud/guardarSolicitud', $data);
        return $solicitud;
    }
    
    protected function buscar_solicitud_por_numero_modelo($numeroSolicitud, $idUsuario){
        $array = [];
        $solicitud = self::invocarGet('solicitud/buscarSolicitudPorNumero?numeroSolicitud='.$numeroSolicitud.'&idUsuario='.$idUsuario, $array);
        return $solicitud;
    }
    
    protected function getUltimoCodigoSolicitud(){
        $array = [];
        $solicitud = self::invocarGet('solicitud/getUltimoCodigoSolicitud', $array);
        return $solicitud;
    }
    
}