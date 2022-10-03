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
}