<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$cotContrl = new cotizacionControlador();
$respuesta = $cotContrl->cambiar_estado_cotizacion_controlador();
echo $respuesta;

