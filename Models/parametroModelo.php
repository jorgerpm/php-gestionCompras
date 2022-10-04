<?php
class parametroModelo extends serviciosWebModelo {
    
    public function guardar_parametro_modelo($datos){
        $respuesta = self::invocarPost('parametro/guardarParametro', $datos);
        return $respuesta;
    }
    
    
    public function listar_parametros() {
        $array = [];
        $listaParametros = self::invocarGet('parametro/listarParametros', $array);
        return $listaParametros;
    }
}