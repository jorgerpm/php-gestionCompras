<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}


if(isset($_POST['txtRucProv'])){
    $rucProveedor = $_POST['txtRucProv'];
}
else{
    $rucProveedor = $_SESSION['Usuario']->usuario;
}
$proveedorControlador = new proveedorControlador();
$proveedor = $proveedorControlador->buscarProveedorRuc($rucProveedor);

if(isset($_POST['txtRucProv'])){
    echo json_encode($proveedor);
}