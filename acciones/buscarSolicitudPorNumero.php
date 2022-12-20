<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

$solCont = new solicitudControlador();
$solicitudGet = $solCont->buscar_solicitud_por_numero($_POST['txtCodSol']);
print_r(json_encode($solicitudGet));
