<?php
//recibir de la base de datos
require_once '../Models/serviciosWebModelo.php';
$array = [];
$servicio = new serviciosWebModelo();
$respuesta = $servicio->invocarGet('parametro/listarParametros', $array);