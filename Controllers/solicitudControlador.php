<?php
class solicitudControlador extends solicitudModelo {
    
    public function listar_solicitud_controlador($post, $regsPagina) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = solicitudModelo::listar_solicitud_modelo($post['dtFechaIni'], $post['dtFechaFin'], isset($post['txtNumSol']) ? $post['txtNumSol'] : null, $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = solicitudModelo::listar_solicitud_modelo(date("Y-m-d"), date("Y-m-d"), null, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
}