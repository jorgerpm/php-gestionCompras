<?php
class rolModelo extends serviciosWebModelo {
    
    protected function guardar_rol_modelo($datos){
        $respuesta = self::invocarPost('rol/guardarRol', $datos);
        return $respuesta;
    }
    
    
    protected function listar_roles() {
        $array = [];
        $listaRoles = self::invocarGet('rol/listarRoles', $array);
        return $listaRoles;
    }
    
    protected function buscar_rol_porId_modelo($idRol) {
        $array = [];
        $rolDto = self::invocarGet('rol/buscarRolPorId?idRol='.$idRol, $array);
        return $rolDto;
    }
    
    
    protected function roles_check_list_modelo() {
        $array = [];
        $listaRoles = self::invocarGet('rol/buscarRolCheckList', $array);
        return $listaRoles;
    }
}