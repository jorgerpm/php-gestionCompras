<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$cotcontr = new checkListRecepcionControlador();
$respuesta = $cotcontr->guardar_checklist_controlador();
echo $respuesta;