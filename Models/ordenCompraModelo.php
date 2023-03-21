<?php
class ordenCompraModelo extends serviciosWebModelo {
    
    protected function guardar_ordencompra_modelo($data){
        $ordenCompra = self::invocarPost('ordenCompra/generarOrdenCompra', $data);
        return $ordenCompra;
    }
    
    // posible cambio
    protected function autorizar_ordencompra_modelo($data){
        $ordenCompra = self::invocarPost('ordenCompra/autorizarOrdenCompra', $data);
        return $ordenCompra;
    }
    // posible cambio
    
    protected function listar_ordencompra_modelo($fechaIni, $fechaFin, $codigoRC, $codigoSolicitud, $desde, $hasta) {
        $array = [];
        $listaOrdenes = self::invocarGet('ordenCompra/listarOrdenesCompras?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codigoRC='.$codigoRC.'&codigoSolicitud='.$codigoSolicitud.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaOrdenes;
    }
    
    
    protected function listar_ordenes_autorizar_modelo($codigoRC, $codigoSolicitud, $idUsuario, $rolPrincipal, $desde, $hasta) {
        $array = [];
        $listaOrdenes = self::invocarGet('ordenCompra/listarOrdenesPorAutorizar?codigoRC='.$codigoRC.'&codigoSolicitud='.$codigoSolicitud.'&idUsuario='.$idUsuario.'&rolPrincipal='.$rolPrincipal.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaOrdenes;
    }
    
    
    protected function actualiza_orden_compra_modelo($data){
        $ordenCompra = self::invocarPost('ordenCompra/actualizarOrdenCompra', $data);
        return $ordenCompra;
    }
}