<?php
$fechaInicial = "2022-02-02";
$fechaFinal = "2022-12-31";
$solicitudControlador = new solicitudControlador();
$listaSolicitudes = $solicitudControlador->listar_solicitud_controlador(1, 10);