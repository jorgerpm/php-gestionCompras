<?php
require_once './Models/vistasModelo.php';

class vistasControlador extends vistasModelo {
    public function obtener_plantilla_controlador() {
        return require_once './Views/plantilla.php';
    }
    
    public function obtener_vistas_controlador() {
        if(isset($_GET['url'])) {
            $ruta = explode("/", $_GET['url']);
            $respuesta = vistasModelo::obtener_vistas_modelo($ruta[0]);
        }else {
            $respuesta = "login";
        }
        return $respuesta;
    }
}
