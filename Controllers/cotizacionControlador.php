<?php
class cotizacionControlador extends cotizacionModelo {
    
    public function guardar_cotizacion(){
        //generar la lista de detalles.
        
        $listaDetalles = json_decode($_POST['listaDetalles'], true);
        
        //print_r($listaDetalles);
        
        $detalles = array();
        
        foreach ($listaDetalles as $valor){
            $dt = [
                'id' => 0,
                'cantidad' => $valor['cantidad'],
                'detalle' => strtoupper($valor['detalle']),
                'valorUnitario' => $valor['valorUnitario'],
                'valorTotal' => $valor['valorTotal'],
                'tieneIva' => $valor['tieneIva'],
                'observacion' => strtoupper($valor['observDetalle']),
            ];
            
            $detalles[] = $dt;
        }
        
        $data = array(
                'fechaTexto' => DateTime::createFromFormat('d/m/Y',$_POST['txtFecha'])->format('Y-m-d'),
                'codigoRC' => $_POST['txtCodigoRc'],
                'codigoCotizacion' => $_POST['txtCodigoCotizacion'],
                'estado' => 'COTIZADO',
                'usuario' => $_SESSION['Usuario']->nombre,
                'rucProveedor' => $_POST['txtRuc'],
            
                'subtotal' => $_POST['lblSubtotal'],
                'subtotalSinIva' => $_POST['lblSubtotalSinIva'],
                'iva' => $_POST['lblIva'],
                'total' => $_POST['lblTotal'],
                'descuento' => 0,
            
                'observacion' => strtoupper($_POST['txtObservaciones']),
                'adicionales' => strtoupper($_POST['txtRubrosAdicionales']),
                'tiempoEntrega' => $_POST['txtTiempoEntrega'],
                'validezCotizacion' => strtoupper($_POST['txtValidezCotizacion']),
                'formaPago' => $_POST['listFormaPago'],
                'listaDetalles' => $detalles,
                'usuarioModifica' => $_SESSION['Usuario']->id,
            );
    
        $cotizacion = cotizacionModelo::guardar_cotizacion_modelo($data);
        
        if(isset($cotizacion)){
            if($cotizacion->id > 0){
                return '<script>swal("", "Cotizacion enviada correctamente.", "success");</script>';
            }
            if(isset($cotizacion->respuesta) && $cotizacion->respuesta != "OK"){
                return '<script>swal("", "'.$cotizacion->respuesta.'", "error");</script>';
            }
        }
        else{
            return '<script>swal("", "Error al enviar la cotizacion.", "error");</script>';
        }
    }
    
    
    public function listar_cotizacion_controlador($post, $regsPagina) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = cotizacionModelo::listar_cotizacion_modelo($post['dtFechaIni'], $post['dtFechaFin'], isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null, $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = cotizacionModelo::listar_cotizacion_modelo(date("Y-m-d"), date("Y-m-d"), null, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
    
    public function buscar_cotizacion_codigorc(){
        if(isset($_GET['codigoRC'])){
            $codigoRC = $_GET['codigoRC'];
            
            $ruc = $_SESSION['Usuario']->usuario;
            
            $respuesta = cotizacionModelo::buscar_cotizacion_codigorc_modelo($codigoRC, $ruc);
            return $respuesta;
        }
    }
    
    public function cambiar_estado_cotizacion_controlador(){
 
        $data = array(
            "id" => $_POST['txtIdCot'],
            "estado" => $_POST['cbxListaEstado'],
            "observacion" => strtoupper($_POST['txtRazonRechazo']),
            "usuario" => $_SESSION['Usuario']->nombre,
            "usuarioModifica" => $_SESSION['Usuario']->id,
        );
        
        $cotizacion = cotizacionModelo::cambiar_estado_cotizacion_modelo($data);
        
        if(isset($cotizacion)){
            if($cotizacion->id > 0){
                return '<script>swal("", "Datos almacenados correctamente.", "success")'
                    . '.then((value) => {
                        $(`#btnSearch`).click(); 
                    });</script>';
            }
            if(isset($cotizacion->respuesta) && $cotizacion->respuesta != "OK"){
                return '<script>swal("", "'.$cotizacion->respuesta.'", "error");</script>';
            }
        }
        else{
            return '<script>swal("", "Error al guardar la cotizacion.", "error");</script>';
        }
    }
}