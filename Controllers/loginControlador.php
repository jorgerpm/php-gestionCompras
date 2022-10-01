<?php
session_start();
if(isset($_POST['usuario']) && isset($_POST['clave'])){
    require_once 'serviciosWebControlador.php';
    $array = [
        'usuario' => $_POST['usuario'],
        'clave' => $_POST['clave']
    ];
    
    $servicio = new serviciosWebControlador();
    $respuesta = $servicio->invocarPost('usuario/loginSistema', $array);
    if(isset($respuesta) && $respuesta->id > 0) {
        header("location: ../home");
        $_SESSION['Usuario'] = $respuesta;
    }else {
        require_once '../Assets/js/functions_alertas.js';
        $alerta=[
            "Alerta"=>"simple",
            "Titulo"=>"Ocurrió un error inesperado",
            "Texto"=>"Nombre de usuario o contraseña incorrectos",
            "Tipo"=>"error"
        ];
        unset($_SESSION['Usuario']); //destruye la sesión
        header("location: ../login");
    }
}