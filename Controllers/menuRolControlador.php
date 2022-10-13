<?php
class menuRolControlador extends menuRolModelo {
    
    public function listarMenusRol() {
        $listaMenus = menuRolModelo::listar_menus_rol();
        if(!isset($listaMenus)) {
            $listaMenus = [];
        }
        return $listaMenus;
    }
    
    public function listarMenusRolPorRol($idRol) {
        $listaMenuRol = menuRolModelo::listar_menusRol_por_rol($idRol);
        return $listaMenuRol;
    }
}
