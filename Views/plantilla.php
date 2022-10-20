<?php
ob_start();
session_start();


$plantilla = new vistasControlador();
$vistas = $plantilla->obtener_vistas_controlador();
if ($vistas == "login" || $vistas == "index") {
    require_once './Views/login.php';
} elseif ($vistas == "404") {
    echo "error 404";
} elseif ($vistas == "formularioRegistroProveedor") {
    require_once './Views/formularioRegistroProveedor.php';
} else {
    
    if (isset($_SESSION['Usuario'])) {
        include_once 'menuTemplate.php';
        include_once $vistas;
        include_once 'footer.php';
    } else {
        include_once './Views/login.php';
    }
}