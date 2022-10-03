<?php

class estadoModelo extends serviciosWebModelo {
    
    public function guardar_estado_modelo($datos){
        $respuesta = self::invocarPost('estado/guardarEstado', $datos);
        return $respuesta;
    }
    
    
    public function listar_estados() {
        $array = [];
        $listaData = self::invocarGet('estado/listarEstados', $array);
        return $listaData;
    }
}