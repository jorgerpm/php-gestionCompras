<?php

class solicitudModelo extends serviciosWebModelo {
    
    protected function listar_solicitud_modelo($fechaIni, $fechaFin, $codigoRC, $desde, $hasta) {
        $array = [];
        //$listaSolicts = self::invocarGet('solicitud/listarSolicitudes?fechaInicial='.'2022-01-01'.'&fechaFinal='.'2022-12-30'.'&codSolicitud='.$codigoSolicitud.'&desde='.'1'.'&hasta='.'10', $array);
        $listaSolicts = self::invocarGet('solicitud/listarSolicitudes?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codigoRC='.$codigoRC.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaSolicts;
    }
    
    protected function guardar_solicitud_modelo($data){
        $solicitud = self::invocarPost('solicitud/guardarSolicitud', $data);
        return $solicitud;
    }
    
    protected function buscar_solicitud_por_numero($numeroRC){
        $array = [];
        $solicitud = self::invocarGet('solicitud/buscarSolicitudPorNumero?numeroRC='.$numeroRC, $array);
        return $solicitud;
    }
    
}