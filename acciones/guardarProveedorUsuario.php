<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$proveedorCont = new proveedorControlador();
$respuesta = $proveedorCont->guardar_proveedor_usuario_controlador();