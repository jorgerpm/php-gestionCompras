<?php
$idRolUsuario = $_SESSION['Usuario']->idRol;
$menuControlador = new menuControlador();
$listaMenuPorRol = $menuControlador->listarMenusPorRol($idRolUsuario);