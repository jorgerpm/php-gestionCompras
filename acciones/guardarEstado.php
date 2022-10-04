<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$estadoCont = new estadoControlador();
$respuesta = $estadoCont->guardar_estado_controlador();
echo $respuesta . "<script>$('#modalFormEstado').modal('hide');</script>";
