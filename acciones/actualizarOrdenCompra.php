<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$ordenContrl = new ordenCompraControlador();
$respuesta = $ordenContrl->actualiza_orden_compra_controlador();
echo $respuesta;