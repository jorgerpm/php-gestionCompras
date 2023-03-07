<?php
class solicitudControlador extends solicitudModelo {
    
    public function listar_solicitud_controlador($post, $regsPagina) {
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = solicitudModelo::listar_solicitud_modelo($post['dtFechaIni'], $post['dtFechaFin'], (isset($post['txtNumSol']) ? $post['txtNumSol'] : null), (isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null), $_SESSION['Usuario']->id, $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = solicitudModelo::listar_solicitud_modelo(date("Y-m-d"), date("Y-m-d"), null, null, $_SESSION['Usuario']->id, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
        
        return $respuesta;
    }
    
    public function guardar_solicitud($post){
        
        if(!isset($_SESSION['Usuario'])){
            return '<script>window.location.replace("index");</script>';
        }
        else{
            //generar la lista de detalles.
            $registros = $post['registrosTabla'];

            $detalles = array();

            for($i=0;$i<$registros;$i++){

                //aqui la parte del archivo que se carga con cada detalle
                $destino = null;
                //echo "va a entraar " . isset($_FILES['archivoDeta'.$i]);
                if(isset($_FILES['archivoDeta'.$i])){
                    $carpeta = "../archivosDetalles/";
                    opendir($carpeta);
                    $destino = $carpeta . $_FILES['archivoDeta'.$i]['name'];
                    copy($_FILES['archivoDeta'.$i]['tmp_name'], $destino);

                    $destino = str_replace("../", "", $destino);
                  //  echo $destino;
                }

                $dt = [
                    'id' => isset($post['txtIdDetalle'.$i]) ? $post['txtIdDetalle'.$i] : 0,
                    'cantidad' => $post['txtCantidad'.$i],
                    'detalle' => mb_strtoupper($post['txtDetalle'.$i], 'utf-8'),
                    'pathArchivo' => $destino,
                ];

                $detalles[] = $dt;
            }

            $data = array(
                'id' => isset($post['txtId']) ? $post['txtId'] : 0,
                'fechaTexto' => $post['dtFechaSol'],
                'codigoRC' => mb_strtoupper($post['txtCodRC'], 'utf-8'),
                'codigoSolicitud' => mb_strtoupper($post['txtCodsol'], 'utf-8'),
                'estado' => 'ENVIADO',
                'usuario' => $_SESSION['Usuario']->nombre,
                'correos' => $post['txtCorreos'],
                'observacion' => mb_strtoupper($post['txtObserv'], 'utf-8'),
                'listaDetalles' => $detalles,
                'usuarioModifica' => $_SESSION['Usuario']->id,
                "montoAprobado" => $post['txtMontoAprob'],
                "fechaAutorizaRC" => $post['dtFechaAprobRC'],
                "estadoRC" => mb_strtoupper($post['txtEstadoRC'], 'utf-8'),
                "unidadNegocioRC" => mb_strtoupper($post['txtUnidadNegoRC'], 'utf-8'),
            );

            $respuesta = solicitudModelo::guardar_solicitud_modelo($data);

            if(isset($respuesta) && $respuesta->id > 0){
                return '<script>swal("", "Solicitud enviada correctamente con código solicitud: '.$respuesta->codigoSolicitud.'", "success")'
                . '.then((value) => {'
                        .(isset($post['txtId']) && $post['txtId']>0 ? '$(`#btnSearch`).click();' : 'window.location.href = "solicitudCotizacion";')
                        .'});</script>';
            }
            elseif(isset($respuesta)){
                return '<script>swal("", "'.$respuesta->respuesta.'", "error");</script>';
            }else{
                return '<script>swal("", "Error al enviar la solicitud.", "error");</script>';
            }
        }
    }
    
    
    public function buscar_solicitud_por_numero($numeroSolicitud){
        $solicitud = solicitudModelo::buscar_solicitud_por_numero_modelo($numeroSolicitud, $_SESSION['Usuario']->id);
//        if(!isset($solicitud)){
//            $solicitud = array();
//            $solicitud->listaDetalles = [];
//        }
        return $solicitud;
    }
    
    public function getUltimoCodigoSolicitud(){
        $numSolicitud = solicitudModelo::getUltimoCodigoSolicitud();
        return $numSolicitud;
    }
}