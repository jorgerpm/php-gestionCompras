<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$proveedorControlador = new proveedorControlador();
return $proveedorControlador->cargaMasivaProveedores();