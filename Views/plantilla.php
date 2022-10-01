<?php
require_once './Controllers/vistasControlador.php';

$plantilla = new vistasControlador();
$vistas = $plantilla->obtener_vistas_controlador();
if($vistas == "login" || $vistas == "index") {
    require_once './Views/login.php';
}elseif($vistas == "404") {
    echo "error 404";
}else {
    include_once 'menuTemplate.php';
    include_once $vistas;
    include_once 'footer.php';
}