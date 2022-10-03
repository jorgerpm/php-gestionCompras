<?php

if (is_file('./Utils/configUtil.php')) {
    require_once './Utils/configUtil.php';
} else {
    require_once '../Utils/configUtil.php';
}

ob_start();
session_start();

if (isset($_POST['usuario']) && isset($_POST['clave'])) {
    //require_once '../Models/serviciosWebModelo.php';
    $array = [
        'usuario' => $_POST['usuario'],
        'clave' => $_POST['clave']
    ];

    $servicio = new serviciosWebModelo();
    $respuesta = $servicio->invocarPost('usuario/loginSistema', $array);
    if (isset($respuesta) && $respuesta->id > 0) {
        $_SESSION['Usuario'] = $respuesta;
        header('Location: ../home');
    } else {
//        print_r($respuesta);
        unset($_SESSION['Usuario']); //destruye la sesión
//unset($_POST['usuario']);
        $_SESSION['no'] = "no";
        header('Location: ../');
    }
} else {
    echo "<br>ddddddddddddd<br>";
//unset($_POST['usuario']);
//session_unset();
//session_destroy();
//header('Location: ./login');
}
//    }
//}
