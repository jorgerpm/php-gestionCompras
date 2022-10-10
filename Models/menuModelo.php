<?php
class menuModelo extends serviciosWebModelo {
    
    public function guardar_menu_modelo($datos){
        $respuesta = self::invocarPost('menu/guardarMenu', $datos);
        return $respuesta;
    }
    
    public function listar_menus() {
        $array = [];
        $listaMenus = self::invocarGet('menu/listarMenus', $array);
        return $listaMenus;
    }
    
    public function listar_menus_por_rol($idRolUsuario) {
        $array = [];
        $listaMenusPorRol = self::invocarGet('menu/listarMenusPorRol?idRol='.$idRolUsuario, $array);
        return $listaMenusPorRol;
    }
}