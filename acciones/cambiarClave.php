<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$usuarioControlador = new usuarioControlador();
session_start();
$respuesta = $usuarioControlador->cambiar_clave();