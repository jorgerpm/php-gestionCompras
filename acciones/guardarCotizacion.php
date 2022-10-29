<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$cotcontr = new cotizacionControlador();
$respuesta = $cotcontr->guardar_cotizacion();
echo $respuesta;