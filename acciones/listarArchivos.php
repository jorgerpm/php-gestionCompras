<?php

if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$archiCont = new archivoXmlControlador();
$respuesta = $archiCont->listar_archivos_controlador($_POST);
$columns = $archiCont->crear_columnas($respuesta);
//echo '<script>window.location.href=""</script>';