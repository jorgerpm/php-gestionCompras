<?php
class menuRolModelo extends serviciosWebModelo {
    
    public function listar_menus_rol() {
        $array = [];
        $listaMenusRol = self::invocarGet('menuRol/listarMenuRoles', $array);
        return $listaMenusRol;
    }
    
    public function listar_menusRol_por_rol($idRol) {
        $array = [];
        $listaMenusRol = self::invocarGet('menuRol/listarMenuRolPorRol?idRol='.$idRol, $array);
        return $listaMenusRol;
    }
    
    public function actualizar_permisos($datos) {
        self::invocarPost('menuRol/guardarPermisos', $datos);
    }
}