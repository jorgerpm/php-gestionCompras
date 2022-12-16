<?php
date_default_timezone_set('America/Guayaquil');

session_start();

//esta seccion es para verificar el tiempo de inacntividad en la pagina, 
//se controla con la sesion, si ya pasa el tiempo configurado se termina la session y
//se redirecciona a la pagina de login
if (isset($_SESSION['tiempo'])) {
    $vida_session = time() - $_SESSION['tiempo'];
    //include_once '';
    if($vida_session > 600/*constantesUtil::$TIEMPO_SESION*/){
        //Removemos sesión.
        session_unset();
        //Destruimos sesión.
        session_destroy();              
        //Redirigimos pagina.
        header("Location: index");

        exit();
    }
}
$_SESSION['tiempo'] = time();


spl_autoload_register(function($class) {
//    $parts = explode('_', $class);
//    $path = implode(DIRECTORY_SEPARATOR, $parts);
    if (strpos($class, "Controlador")) {
        $pathClass = 'Controllers/' . $class . '.php';
    } elseif (strpos($class, "Modelo")) {
        $pathClass = 'Models/' . $class . '.php';
    } elseif (strpos($class, "Util")) {
        $pathClass = 'Utils/' . $class . '.php';
    } else {
        $pathClass = $class . '.php';
    }

    if (is_file('./' . $pathClass)) {
        require_once './' . $pathClass;
    } else {
        require_once '../' . $pathClass;
    }
});


