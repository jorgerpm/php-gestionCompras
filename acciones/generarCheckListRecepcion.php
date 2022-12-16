<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$ordenContrl = new checkListRecepcionControlador();
$respuesta = $ordenContrl->generar_checkListRecepcion_controlador();
echo $respuesta;
