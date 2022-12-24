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
                'detalle' => mb_strtoupper($valor['detalle'], 'utf-8'),
                'valorUnitario' => str_replace(",", "", $valor['valorUnitario']),
                'valorTotal' => str_replace(",", "", $valor['valorTotal']),
                'tieneIva' => $valor['tieneIva'],
                'observacion' => mb_strtoupper($valor['observDetalle'], 'utf-8'),
            ];
            
            $detalles[] = $dt;
        }
        
        $data = array(
                'fechaTexto' => DateTime::createFromFormat('d/m/Y',$_POST['txtFecha'])->format('Y-m-d'),
                'codigoRC' => $_POST['txtCodigoRc'],
                'codigoSolicitud' => $_POST['txtCodSol'],
                'codigoCotizacion' => $_POST['txtCodSol'] . "-" . $_POST['txtRuc'], //$_POST['txtCodigoCotizacion'],
                'estado' => 'COTIZADO',
                'usuario' => $_SESSION['Usuario']->nombre,
                'rucProveedor' => $_POST['txtRuc'],
            
                'subtotal' => str_replace(",", "", $_POST['lblSubtotal']),
                'subtotalSinIva' => str_replace(",", "", $_POST['lblSubtotalSinIva']),
                'iva' => str_replace(",", "", $_POST['lblIva']),
                'total' => str_replace(",", "", $_POST['lblTotal']),
                'descuento' => 0,
            
                'observacion' => mb_strtoupper($_POST['txtObservaciones'], 'utf-8'),
                'adicionales' => mb_strtoupper($_POST['txtRubrosAdicionales'], 'utf-8'),
                'tiempoEntrega' => $_POST['txtTiempoEntrega'],
                'validezCotizacion' => mb_strtoupper($_POST['txtValidezCotizacion'], 'utf-8'),
                'formaPago' => $_POST['listFormaPago'],
                'listaDetalles' => $detalles,
                'usuarioModifica' => $_SESSION['Usuario']->id,
            );
            
        $cotizacion = cotizacionModelo::guardar_cotizacion_modelo($data);
        
        if(isset($cotizacion)){
            if($cotizacion->id > 0){
                return '<script>swal("", "Cotizacion enviada correctamente.", "success")'
                . '.then((value) => {
                        window.location.href = "formularioCotizacion"; 
                    });</script>';
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
            $respuesta = cotizacionModelo::listar_cotizacion_modelo($post['dtFechaIni'], $post['dtFechaFin'], (isset($post['txtNumSol']) ? $post['txtNumSol'] : null), (isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null), $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = cotizacionModelo::listar_cotizacion_modelo(date("Y-m-d"), date("Y-m-d"), null, null, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
    
    public function buscar_cotizacion_codigo_sol(){
        if(isset($_GET['codigoSol'])){
            $codigoSol = $_GET['codigoSol'];
            
            $ruc = $_SESSION['Usuario']->usuario;
            
            $respuesta = cotizacionModelo::buscar_cotizacion_codigorc_modelo($codigoSol, $ruc);
            return $respuesta;
        }
    }
    
    public function cambiar_estado_cotizacion_controlador(){
 
        $data = array(
            "id" => $_POST['txtIdCot'],
            "estado" => $_POST['cbxListaEstado'],
            "observacion" => mb_strtoupper($_POST['txtRazonRechazo'], 'utf-8'),
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
    
    
    
    public function get_cotizaciones_para_comparativo_controlador() {
        
        if(isset($_POST['txtNumSol'])){
            $respuesta = cotizacionModelo::get_cotizaciones_para_comparativo_modelo($_POST['txtNumSol']);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
    
    public function rechazar_todas_cotizaciones_controlador(){
        if(isset($_POST['codigoSolicitud']) && isset($_POST['codigoRC'])){
            
            $data = array(
                "codigoSolicitud" => $_POST['codigoSolicitud'],
                "codigoRC" => $_POST['codigoRC'],
                "usuarioModifica" => $_SESSION['Usuario']->id,
                "observacion" => mb_strtoupper($_POST['obsRechazo'], 'utf-8'),
            );
            
            $respuesta = cotizacionModelo::rechazar_todas_cotizaciones_modelo($data);
            
            if(isset($respuesta) && $respuesta->respuesta == "OK"){
                return '<script>swal("", "Cotizaciones rechazadas correctamente.", "success")'
                    . '.then((value) => {
                        $(`#btnSearch`).click(); 
                    });</script>';
            }
            elseif(isset($respuesta)){
                return '<script>swal("", "'.$respuesta->respuesta.'", "error");</script>';
            }
            else{
                return '<script>swal("", "Error al rechazar las cotizaciones.", "error");</script>';
            }
        }
    }
}