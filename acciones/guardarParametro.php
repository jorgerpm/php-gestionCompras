<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$parametroCont = new parametroControlador();
$respuesta = $parametroCont->guardar_parametro_controlador();
echo $respuesta . "<script>$('#modalFormParametro').modal('hide');</script>";
