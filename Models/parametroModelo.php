<?php
class parametroModelo extends serviciosWebModelo {
    
    protected function guardar_parametro_modelo($datos){
        $respuesta = self::invocarPost('parametro/guardarParametro', $datos);
        return $respuesta;
    }
    
    
    protected function listar_parametros_modelo() {
        $array = [];
        $listaParametros = self::invocarGet('parametro/listarParametros', $array);
        return $listaParametros;
    }
}