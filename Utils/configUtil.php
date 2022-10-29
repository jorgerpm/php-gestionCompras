<?php
//require_once 'messages.php';
date_default_timezone_set('America/Guayaquil');

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
