<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$contrl = new preguntaControlador();
$respuesta = $contrl->guardar_pregunta_controlador();
echo $respuesta ;//. "<script>$('#modalFormRol').modal('hide');</script>";

