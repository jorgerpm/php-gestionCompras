<?php

class cotizacionModelo extends serviciosWebModelo { 
    
    protected function guardar_cotizacion_modelo($data){
        $cotizacion = self::invocarPost('cotizacion/guardarCotizacion', $data);
        return $cotizacion;
    }
    
    protected function listar_cotizacion_modelo($fechaIni, $fechaFin, $codigoSol, $codigoRC, $desde, $hasta, $idRol, $rucProveedor) {
        $array = [];
        $listaSolicts = self::invocarGet('cotizacion/listarCotizaciones?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codigoSolicitud='.$codigoSol.'&codigoRC='.$codigoRC.'&desde='.$desde.'&hasta='.$hasta.'&idRol='.$idRol.'&rucProveedor='.urlencode($rucProveedor), $array);
        return $listaSolicts;
    }
    
    protected function buscar_cotizacion_codigorc_modelo($codigoSol, $ruc){
        $array = [];
        $cotizacion = self::invocarGet('cotizacion/buscarCotizacionRucNumeroSol?codigoSolicitud='.$codigoSol.'&ruc='.urlencode($ruc), $array);
        return $cotizacion;
    }
    
    
    protected function cambiar_estado_cotizacion_modelo($data){
        $cotizacion = self::invocarPost('cotizacion/cambiarEstadoCotizacion', $data);
        return $cotizacion;
    }
    
    protected function get_cotizaciones_para_comparativo_modelo($codigoSolicitud){
        $array = [];
        $cotizaciones = self::invocarGet('cotizacion/getCotizacionesParaComparativo?codigoSolicitud='.$codigoSolicitud, $array);
        return $cotizaciones;
    }
    
    protected function rechazar_todas_cotizaciones_modelo($data){
        $respuesta = self::invocarPost('cotizacion/rechazarTodasCotizaciones', $data);
        return $respuesta;
    }
}