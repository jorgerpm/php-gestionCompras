<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$conCotiz = new cotizacionControlador();
$respuesta = $conCotiz->rechazar_todas_cotizaciones_controlador();
echo $respuesta;