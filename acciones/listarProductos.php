<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$productoControlador = new productoControlador();
$returnLista = $productoControlador->listarProductos($_POST);

echo json_encode($returnLista);