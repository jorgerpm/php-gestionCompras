<?php

class archivoXmlControlador extends archivoXmlModelo {

    public function listar_archivos_controlador($post) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            return archivoXmlModelo::listar_archivos($post['dtFechaIni'], $post['dtFechaFin'], $post['listUsers']);
        }
        else{
            return archivoXmlModelo::listar_archivos(date("d-m-Y"), date("d-m-Y"), null);
        }
    }

    public function crear_columnas($respuesta) {
        $listvarj = json_decode($respuesta[0]->comprobante);

        $columns = [];
        array_push($columns, 'Estado');
        array_push($columns, 'Número de autorización');
        array_push($columns, 'Fecha de autorización');
        array_push($columns, 'Ambiente');

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
        
        array_push($columns, 'Usuario');
        array_push($columns, 'Tipo de documento');
        array_push($columns, 'Proveedor');
        array_push($columns, 'Url archivo xml');
        array_push($columns, 'Url archivo RIDE');

        return $columns;
    }

}
