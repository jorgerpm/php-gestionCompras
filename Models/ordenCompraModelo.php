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
    
    protected function listar_ordencompra_modelo($fechaIni, $fechaFin, $codigoRC, $desde, $hasta) {
        $array = [];
        $listaOrdenes = self::invocarGet('ordenCompra/listarOrdenesCompras?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codigoRC='.$codigoRC.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaOrdenes;
    }
}