<?php
class ordenCompraControlador extends ordenCompraModelo {
    
    public function guardar_orden_compra(){
        
        $data = array(
                'codigoRC' => $_POST['txtCodigoRc'],
                'rucProveedor' => $_POST['txtRuc'],
                'estado' => 'GENERADO_OC',
                'usuario' => $_SESSION['Usuario']->nombre,
                'idUsuario' => $_SESSION['Usuario']->id,
            );
    
        $ordenCompra = ordenCompraModelo::guardar_ordencompra_modelo($data);
        
        if(isset($ordenCompra) && $ordenCompra->id > 0){
            return '<script>swal("", "Orden de compra generada correctamente.", "success");</script>';
        }
        else{
            return '<script>swal("", "Error al generar la orden de compra.", "error");</script>';
        }
        
    }
    
    // Posible cambio
    public function guardar_autorizacion(){
        
        if(isset($_POST['cbxListaEstado'])) {
            if(!empty($_POST['txtRazonRechazo'])){
                $data = array(
                        'idUsuario' => $_SESSION['Usuario']->id,
                        'observacion' => $_POST['txtRazonRechazo'],
                        'usuario' => $_SESSION['Usuario']->usuario,
                        'estado' => $_POST['cbxListaEstado'],
                        'id' => $_POST['txtId'],
                    );

                $ordenCompra = ordenCompraModelo::autorizar_ordencompra_modelo($data);

                if(isset($ordenCompra) && $ordenCompra->id > 0){
                    return '<script>swal("", "Autorización generada correctamente.", "success");</script>';
                }
                else{
                    return '<script>swal("", "Error al generar la autorización.", "error");</script>';
                }
            } else{
                return '<script>swal("", "Debe colocar la razón de rechazo.", "warning");</script>';
            }
        } else {
            return '<script>swal("", "Debe seleccionar un estado.", "warning");</script>';
        }
    }
    //Posible cambio
    
    public function listar_ordencompra_controlador($post, $regsPagina) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = ordenCompraModelo::listar_ordencompra_modelo($post['dtFechaIni'], $post['dtFechaFin'], isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null, $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = ordenCompraModelo::listar_ordencompra_modelo(date("Y-m-d"), date("Y-m-d"), null, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
}