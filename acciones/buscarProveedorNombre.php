<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$provCont = new proveedorControlador();
if(isset($_POST['txtNombreProveedor'])){
    $nom = $_POST['txtNombreProveedor'];
    if(strlen($nom) > 2){
        $listaProvs = $provCont->listarProveedoresActivosNombre();

        echo json_encode($listaProvs);
    }
}