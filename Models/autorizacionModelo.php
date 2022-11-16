<?php
class autorizacionModelo extends serviciosWebModelo {
    
    protected function guardar_autorizadores_modelo($datos){
        $respuesta = self::invocarPost('autorizacionOrdenCompra/guardarAutorizadores', $datos);
        return $respuesta;
    }
}