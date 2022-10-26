<?php
class solicitudControlador extends solicitudModelo {
    
    public function listar_solicitud_controlador($post, $regsPagina) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = solicitudModelo::listar_solicitud_modelo($post['dtFechaIni'], $post['dtFechaFin'], isset($post['txtNumSol']) ? $post['txtNumSol'] : null, $post['txtDesde'], $regsPagina);
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
        session_start();
        //generar la lista de detalles.
        $registros = $post['registrosTabla'];
        
        $detalles = array();
        
        for($i=1;$i<$registros;$i++){
            $dt = [
                'id' => 0,
                'cantidad' => $post['txtCantidad'.$i],
                'detalle' => $post['txtDetalle'.$i]
            ];
            
            $detalles[] = $dt;
        }
        
        $data = array(
            'id' => 0,
            'fechaSolicitud' => $post['dtFechaSol'],
            'codigoRC' => $post['txtCodRC'],
            'estado' => 'ENVIADO',
            'usuario' => $_SESSION['Usuario']->nombre,
            'correos' => $post['txtCorreos'],
            'observacion' => $post['txtObserv'],
            'listaDetalles' => $detalles,
        );
        
        $respuesta = solicitudModelo::guardar_solicitud_modelo($data);
        
        if($respuesta->id > 0){
            return "Solicitud almacenada correctamente.";
        }
        else{
            return "Error al guardar la solicitud.";
        }
    }
}