<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$ordCompraContr = new ordenCompraControlador();
$respuesta = $ordCompraContr->guardar_orden_compra();
echo $respuesta;