<?php
class vistasModelo {
    protected static function obtener_vistas_modelo($vistas) {
        include_once './Utils/listasBlancas.php';
        $listaBlanca = listasBlancas::$LISTASBLANCAS;
        if(in_array($vistas, $listaBlanca)) {
            if(is_file("./Views/" . $vistas . ".php")) {
                $contenido = "./Views/" . $vistas . ".php";
            }else {
                $contenido = "404";
            }
        } elseif($vistas=="login" || $vistas=="index") {
            $contenido = "login";
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}