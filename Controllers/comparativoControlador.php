<?php
class comparativoControlador extends comparativoModelo {
    
    public function listar_comparativos_controlador($post, $regsPagina) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = comparativoModelo::listar_comparativos_modelo($post['dtFechaIni'], $post['dtFechaFin'], (isset($post['txtNumeroSol']) ? $post['txtNumeroSol'] : null), (isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null), $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = comparativoModelo::listar_comparativos_modelo(date("Y-m-d"), date("Y-m-d"), null, null, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
//        print_r($respuesta);
        return $respuesta;
    }
}