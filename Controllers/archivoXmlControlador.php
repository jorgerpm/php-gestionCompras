<?php

class archivoXmlControlador extends archivoXmlModelo {

    public function listar_archivos_controlador($post) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = archivoXmlModelo::listar_archivos($post['dtFechaIni'], $post['dtFechaFin'], isset($post['listUsers']) ? $post['listUsers'] : null);
        }
        else{
            $respuesta = archivoXmlModelo::listar_archivos(date("Y-m-d"), date("Y-m-d"), ($_SESSION['Rol']->principal == 0) ? $_SESSION['Usuario']->id : null);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }

    public function crear_columnas($respuesta) {
        

        $columns = [];
        array_push($columns, 'Estado');
        array_push($columns, 'Número de autorización');
        array_push($columns, 'Fecha de autorización');
        array_push($columns, 'Ambiente');

        if(isset($respuesta[0]->comprobante)){
        $listvarj = json_decode($respuesta[0]->comprobante);
        $docum = null;
        if (isset($listvarj->factura)) {
            $docum = $listvarj->factura;
        }

        if ($docum != null) {
            foreach ($docum->infoTributaria as $key => $val) {
                array_push($columns, $key);
            }
            foreach ($docum->infoFactura as $key => $val) {
                if (!isset($val->pago) && !isset($val->totalImpuesto)) {
                    array_push($columns, $key);
                }
            }
        }
        }
        array_push($columns, 'Usuario');
        array_push($columns, 'Tipo de documento');
        array_push($columns, 'Proveedor');
        array_push($columns, 'Url archivo xml');
        array_push($columns, 'Url archivo RIDE');

        return $columns;
    }

}
