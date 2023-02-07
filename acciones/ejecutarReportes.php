<?php

if (is_file('./Utils/configUtil.php')) {
    require_once './Utils/configUtil.php';
} else {
    require_once '../Utils/configUtil.php';
}

$controler = new parametroControlador();
$params = $controler->listarParametros();

//print_r($params);

foreach ($params as $param) {
//    echo $param->nombre;
    if ($param->nombre == "IP_SISTEMA") {
//        echo $param->valor.PHP_EOL;
        //        echo $_SERVER['HTTP_HOST'].PHP_EOL;

        $spl = explode(":", $param->valor);

        $url = $spl[0] . ":" . $spl[1] . ":".constantesUtil::$PUERTO_WEB_SERVICE."/".constantesUtil::$CONTEXTO_WEB_SERVICE."/ReporteServicio?reporte=" . $_POST['reporte'] . '&tipo=' . $_POST['tipo'];

        if ($_POST['tipo'] == "pdf") {
            $url = $url . '&id=' . $_POST['id'];
        } else {
            $url = $url . '&fechaIni=' . $_POST['fechaIni'] . "&fechaFin=" . $_POST['fechaFin'];
        }

        echo $url;
    }
}
