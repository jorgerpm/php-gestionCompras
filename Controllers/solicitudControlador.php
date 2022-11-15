<?php
class solicitudControlador extends solicitudModelo {
    
    public function listar_solicitud_controlador($post, $regsPagina) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = solicitudModelo::listar_solicitud_modelo($post['dtFechaIni'], $post['dtFechaFin'], isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null, $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = solicitudModelo::listar_solicitud_modelo(date("Y-m-d"), date("Y-m-d"), null, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
    
    public function guardar_solicitud($post){
        //generar la lista de detalles.
        $registros = $post['registrosTabla'];
        
        $detalles = array();
        
        for($i=0;$i<$registros;$i++){
            $dt = [
                'id' => isset($post['txtIdDetalle'.$i]) ? $post['txtIdDetalle'.$i] : 0,
                'cantidad' => $post['txtCantidad'.$i],
                'detalle' => strtoupper($post['txtDetalle'.$i])
            ];
            
            $detalles[] = $dt;
        }
        
        $data = array(
            'id' => isset($post['txtId']) ? $post['txtId'] : 0,
            'fechaTexto' => $post['dtFechaSol'],
            'codigoRC' => strtoupper($post['txtCodRC']),
            'estado' => 'ENVIADO',
            'usuario' => $_SESSION['Usuario']->nombre,
            'correos' => $post['txtCorreos'],
            'observacion' => strtoupper($post['txtObserv']),
            'listaDetalles' => $detalles,
            'usuarioModifica' => $_SESSION['Usuario']->id,
        );
        
        $respuesta = solicitudModelo::guardar_solicitud_modelo($data);
        
        if($respuesta->id > 0){
            return '<script>swal("", "Solicitud enviada correctamente.", "success");</script>';
        }
        else{
            return '<script>swal("", "Error al enviar la solicitud.", "error");</script>';
        }
    }
    
    
    public function buscar_solicitud_por_numero($numeroRC){
        $solicitud = solicitudModelo::buscar_solicitud_por_numero($numeroRC);
//        if(!isset($solicitud)){
//            $solicitud = array();
//            $solicitud->listaDetalles = [];
//        }
        return $solicitud;
    }
}