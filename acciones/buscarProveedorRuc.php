<?php
session_start();
$rucProveedor = $_SESSION['Usuario']->usuario;
$proveedorControlador = new proveedorControlador();
$proveedor = $proveedorControlador->buscarProveedorRuc($rucProveedor);