<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$userControl = new usuarioControlador();
$respuesta = $userControl->recuperar_clave_controlador();
echo $respuesta;

