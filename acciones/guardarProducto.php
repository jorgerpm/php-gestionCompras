<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$productoCont = new productoControlador();
$respuesta = $productoCont->guardar_producto_controlador();
echo $respuesta . "<script>$('#modalFormProducto').modal('hide');</script>";