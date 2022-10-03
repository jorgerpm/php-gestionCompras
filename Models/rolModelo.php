<?php
class rolModelo extends serviciosWebModelo {
    
    public function guardar_rol_modelo($datos){
        $respuesta = self::invocarPost('rol/guardarRol', $datos);
        return $respuesta;
    }
    
    
    public function listar_roles() {
        $array = [];
        $listaRoles = self::invocarGet('rol/listarRoles', $array);
        return $listaRoles;
    }
}