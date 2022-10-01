<?php
//recibir de la base de datos
require_once 'serviciosWebControlador.php';
$array = [];
$servicio = new serviciosWebControlador();
$respuesta = $servicio->invocarGet('proveedor/listarProveedores', $array);