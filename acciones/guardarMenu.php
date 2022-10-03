<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$menuCont = new menuControlador();
$respuesta = $menuCont->guardar_menu_controlador();
echo $respuesta . "<script>$('#modalFormMenu').modal('hide');</script>";
