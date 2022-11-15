<?php
class historicoDocumentoControlador extends historicoDocumentoModelo {

public function listar_historico_controlador($post, $regsPagina) {
        if(isset($post) && isset($post['txtNumeroRC'])){
            $respuesta = historicoDocumentoModelo::listar_historico_modelo($post['txtNumeroRC'], (isset($post['txtTipoDocumento']) ? $post['txtTipoDocumento'] : null), $post['txtDesde'], $regsPagina);
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