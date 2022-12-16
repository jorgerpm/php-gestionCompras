<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$controlador = new preguntaControlador();
$listaPreguntas = $controlador->listar_preguntas_controlador();