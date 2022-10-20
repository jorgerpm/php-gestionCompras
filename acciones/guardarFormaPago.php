<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$formaPagoCont = new formaPagoControlador();
$respuesta = $formaPagoCont->guardar_forma_pago_controlador();
echo $respuesta . "<script>$('#modalFormFormaPago').modal('hide');</script>";
