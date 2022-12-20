<?php

if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$soliControl = new solicitudControlador();
$respuesta = $soliControl->guardar_solicitud($_POST);
echo $respuesta;
