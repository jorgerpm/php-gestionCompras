<?php
require_once 'serviciosWebControlador.php';

class rolControlador {
    public function listarRoles() {
        $array = [];
        $servicio = new serviciosWebControlador();
        $listaRoles = $servicio->invocarGet('rol/listarRoles', $array);
        return $listaRoles;
    }
}

