<?php
class vistasModelo {
    protected static function obtener_vistas_modelo($vistas) {
//        include_once './Utils/listasBlancasUtil.php';
        $listaBlanca = listasBlancasUtil::$LISTASBLANCAS;
        if(in_array($vistas, $listaBlanca)) {
            if(is_file("./Views/" . $vistas . ".php")) {
                $contenido = "./Views/" . $vistas . ".php";
            }else {
                $contenido = "404";
            }
        } elseif($vistas=="login" || $vistas=="index") {
            $contenido = "login";
        } elseif($vistas=="formularioRegistroProveedor") {
            $contenido = "formularioRegistroProveedor";
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}