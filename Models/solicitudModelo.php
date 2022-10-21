<?php

class solicitudModelo extends serviciosWebModelo {
    
    public function listar_solicitud_modelo($fechaIni, $fechaFin, $codigoSolicitud, $desde, $hasta) {
        $array = [];
        $listaSolicts = self::invocarGet('solicitud/listarSolicitudes?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codSolicitud='.$codigoSolicitud.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaSolicts;
    }
    
}