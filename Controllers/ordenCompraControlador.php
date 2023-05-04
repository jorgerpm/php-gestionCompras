<?php
class ordenCompraControlador extends ordenCompraModelo {
    
    public function guardar_orden_compra(){
        
        $data = array(
                'codigoSolicitud' => $_POST['txtNumSol'],
                'rucProveedor' => $_POST['txtRuc'],
                'estado' => 'GENERADO_OC',
                'usuario' => $_SESSION['Usuario']->nombre,
                'idUsuario' => $_SESSION['Usuario']->id,
                'observacion' => mb_strtoupper($_POST['txtObserOC'], 'utf-8'),
            'detalleFinal' => mb_strtoupper($_POST['txtDetaFinal'], 'utf-8'),
            'observacionComparativo' => mb_strtoupper($_POST['txtObsComp'], 'utf-8'), //esta es la observacion para el comparativo
                "listaDetalles" => $_POST['detallesProd'],
            );
        
//            print_r($_POST['detallesProd']);
    
        $ordenCompra = ordenCompraModelo::guardar_ordencompra_modelo($data);
        
        if(isset($ordenCompra) && $ordenCompra->id > 0){
            return '<script>swal("", "Orden de compra generada correctamente.", "success")'
                    . '.then((value) => {
                        $(`#btnSearch`).click(); 
                    });</script>';
        }
        else if(isset($ordenCompra) && isset($ordenCompra->respuesta)){
            return '<script>swal("", "'.$ordenCompra->respuesta.'", "error");</script>';
        }else{
            return '<script>swal("", "Error al generar la orden de compra.", "error");</script>';
        }
        
    }
    
    // Posible cambio
    public function guardar_autorizacion(){
        
        if(isset($_POST['cbxListaEstado'])) {
            if(!empty($_POST['txtRazonRechazo']) || $_POST['cbxListaEstado'] == "AUTORIZADO"){
                $data = array(
                        'idUsuario' => $_SESSION['Usuario']->id,
                        'observacion' => mb_strtoupper($_POST['txtRazonRechazo'], 'utf-8'),
                        'usuario' => $_SESSION['Usuario']->usuario,
                        'estado' => $_POST['cbxListaEstado'],
                        'id' => $_POST['txtId'],
                    );

                $ordenCompra = ordenCompraModelo::autorizar_ordencompra_modelo($data);

                if(isset($ordenCompra) && $ordenCompra->id > 0){
                    return '<script>swal("", "Autorización generada correctamente.", "success")'
                    . '.then((value) => {
                        $(`#btnSearch`).click(); 
                    });</script>';
                }
                else if(isset($ordenCompra) && isset($ordenCompra->respuesta)){
                    return '<script>swal("", "'.$ordenCompra->respuesta.'", "error");</script>';
                }else{
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
            $respuesta = ordenCompraModelo::listar_ordencompra_modelo($post['dtFechaIni'], $post['dtFechaFin'], isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null, 
                    isset($post['txtNumeroSol']) ? $post['txtNumeroSol'] : null, $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = ordenCompraModelo::listar_ordencompra_modelo(date("Y-m-d"), date("Y-m-d"), null, null, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
    
    public function listar_ordenes_autorizar_controlador($post, $regsPagina) {
        $rolPrincipal = $_SESSION['Rol']->principal == 1 ? "true" : "false";
        $iduser = $_SESSION['Usuario']->id;
        
        if(isset($post)){
            $respuesta = ordenCompraModelo::listar_ordenes_autorizar_modelo(isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null, isset($post['txtNumeroSolB']) ? $post['txtNumeroSolB'] : null, $iduser, $rolPrincipal, $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = ordenCompraModelo::listar_ordenes_autorizar_modelo(null, null, $iduser, $rolPrincipal, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
    
    public function actualiza_orden_compra_controlador(){
        
        
//        print_r($_POST['cantDetas']);
        
        $datelles = [];
        
       for($i=0;$i<$_POST['cantDetas'];$i++){
           $datelles[$i] = array(
               'id' => $_POST['idDetalle'.$i],
               'codigoProducto' => mb_strtoupper($_POST['txtCodProd'.$i], 'utf-8'),
               'detalle' => mb_strtoupper($_POST['lblDetalle'.$i], 'utf-8'),
           );
       }
        
        
        $data = array(
            'idUsuario' => $_SESSION['Usuario']->id,
            'usuario' => $_SESSION['Usuario']->usuario,
            'id' => $_POST['txtId'],
            'listaDetalles' => $datelles,
        );
        
//        print_r($data);
//        echo PHP_EOL;
        
        $respuesta = ordenCompraModelo::actualiza_orden_compra_modelo($data);
        
//        print_r($respuesta);
        
        return '<script>swal("", "Datos actualizados correctamente.", "success")'
                    . '.then((value) => {
                        $(`#btnSearch`).click(); 
                    });</script>';
    }
}