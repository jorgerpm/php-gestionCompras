<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$autContr = new autorizacionControlador();
$respuesta = $autContr->guardar_autorizadores_controlador();
echo $respuesta;