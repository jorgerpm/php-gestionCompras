<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$rolCont = new rolControlador();
$respuesta = $rolCont->guardar_rol_controlador();
echo $respuesta . "<script>$('#modalFormRol').modal('hide');</script>";
//echo '<script>window.location.href = "rol"</script>';
