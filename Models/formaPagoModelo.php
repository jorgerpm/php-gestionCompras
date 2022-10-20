<?php
class formaPagoModelo extends serviciosWebModelo {
    
    public function guardar_forma_pago_modelo($datos){
        $respuesta = self::invocarPost('formaPago/guardarFormaPago', $datos);
        return $respuesta;
    }
    
    
    public function listar_formas_pago() {
        $array = [];
        $listaFormasPago = self::invocarGet('formaPago/listarFormasPago', $array);
        return $listaFormasPago;
    }
}