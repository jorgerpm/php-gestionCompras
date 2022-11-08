<?php
class ordenCompraModelo extends serviciosWebModelo {
    
    protected function guardar_ordencompra_modelo($data){
        $ordenCompra = self::invocarPost('ordenCompra/guardarOrdenCompra', $data);
        return $ordenCompra;
    }
}