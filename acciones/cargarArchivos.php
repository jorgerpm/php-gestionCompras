<?php

if (is_file('./Utils/configUtil.php')) {
    require_once './Utils/configUtil.php';
} else {
    require_once '../Utils/configUtil.php';
}

$carga = new cargarXmlControlador();
$respueta = $carga->cargar_archivo_controlador();
echo $respueta;

