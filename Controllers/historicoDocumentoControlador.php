<?php
class historicoDocumentoControlador extends historicoDocumentoModelo {

public function listar_historico_controlador($post, $regsPagina) {
        if(isset($post)){
            
            if(($post['txtNumeroSol'] == null || $post['txtNumeroSol'] == '') && ($post['txtNumeroRC'] == null || $post['txtNumeroRC'] == '')){
                return array();
            }
            else{
                $respuesta = historicoDocumentoModelo::listar_historico_modelo(
                    (isset($post['txtNumeroSol']) ? $post['txtNumeroSol'] : null), (isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null),
                    (isset($post['txtTipoDocumento']) ? $post['txtTipoDocumento'] : null), $post['txtDesde'], $regsPagina);
            }
        }
        else{
            return "ingrese el codigo de rc a consultar.";
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }

}