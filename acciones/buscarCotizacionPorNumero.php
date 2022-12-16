<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$cotcontr = new cotizacionControlador();
$respuesta = $cotcontr->buscar_cotizacion_codigo_sol();
print_r(json_encode($respuesta));
