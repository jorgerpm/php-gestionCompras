<?php

if (is_file('./Utils/configUtil.php')) {
    require_once './Utils/configUtil.php';
} else {
    require_once '../Utils/configUtil.php';
}

$contr = new integracionJDControlador();
$respuesta = $contr->buscar_orden_jd_controlador();
echo (json_encode($respuesta));