<?php

class cotizacionModelo extends serviciosWebModelo { 
    
    protected function guardar_cotizacion_modelo($data){
        $cotizacion = self::invocarPost('cotizacion/guardarCotizacion', $data);
        return $cotizacion;
    }
    
    protected function listar_cotizacion_modelo($fechaIni, $fechaFin, $codigoRC, $desde, $hasta) {
        $array = [];
        $listaSolicts = self::invocarGet('cotizacion/listarCotizaciones?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codigoRC='.$codigoRC.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaSolicts;
    }
    
    protected function buscar_cotizacion_codigorc_modelo($codigoRC, $ruc){
        $array = [];
        $cotizacion = self::invocarGet('cotizacion/buscarCotizacionRucNumeroRC?codigoRC='.$codigoRC.'&ruc='.$ruc, $array);
        return $cotizacion;
    }
    
    
    protected function cambiar_estado_cotizacion_modelo($data){
        $cotizacion = self::invocarPost('cotizacion/cambiarEstadoCotizacion', $data);
        return $cotizacion;
    }
}