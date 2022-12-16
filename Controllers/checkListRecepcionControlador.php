<?php
class checkListRecepcionControlador extends checkListRecepcionModelo {
    
    public function generar_checkListRecepcion_controlador(){
    
        if(isset($_POST)){
            
            $index = $_POST['registrosTabla'];
            
            $detalles = array();
            
            for($i=0;$i<$index;$i++){
            
                $detalles[] = array(
                    "idUsuario" => $_POST['txtIdUserRecep'.$i],
                    "idRol" => $_POST['txtIdRolRecep'.$i],
                );
            }
            
            $data = array(
                "ordenCompra" => array(
                    "id" => $_POST['txtIdOrdenCompraRecep'],
                ),
                "usuarioModifica" => $_SESSION['Usuario']->id,
                "usuario" => $_SESSION['Usuario']->nombre,
                "listaDetalles" => $detalles,
            );
            
            
            $respuesta = checkListRecepcionModelo::generar_checkListRecepcion_modelo($data);
            
            if(isset($respuesta->respuesta)){
                if($respuesta->respuesta == "OK"){
                    return '<script>swal("", "Receptores guardados correctamente.", "success")'
                    . '.then((value) => {
                        $(`#btnSearch`).click(); 
                    });</script>';
                }
                else{
                    return '<script>swal("", "'.$respuesta->respuesta.'", "error");</script>';
                }
            }
            else{
                return '<script>swal("", "Error al guardar los receptores de la orden de compra.", "error");</script>';
            }
        }
    }
    
    
    public function listar_checklist_controlador($post, $regsPagina){
        if(isset($post) && isset($post['dtFechaIni']) && isset($post['dtFechaFin'])){
            $respuesta = checkListRecepcionModelo::listar_checklist_modelo($post['dtFechaIni'], $post['dtFechaFin'], (isset($post['txtNumeroSol']) ? $post['txtNumeroSol'] : null), (isset($post['txtNumeroRC']) ? $post['txtNumeroRC'] : null), $post['txtDesde'], $regsPagina);
        }
        else{
            $respuesta = checkListRecepcionModelo::listar_checklist_modelo(date("Y-m-d"), date("Y-m-d"), null, null, 0, $regsPagina);
        }
        
        if(!isset($respuesta)){
            $respuesta = [];
        }
//        print_r($respuesta);
        return $respuesta;
    }
    
    
    public function guardar_checklist_controlador(){
        
        $detalles = array();
        foreach($_POST as $k => $v){
            if(strpos($k, 'cmbPreg') !== false){
//                echo $k;
                $idDetalle = str_replace("cmbPreg", "", $k);
//                echo $idDetalle.'<br>';
                
                $detalle = array(
                    "id" => $idDetalle,
                    "respuesta" => $v,
                    "observacion" => isset($_POST['txtNovedad'.$idDetalle]) ? strtoupper($_POST['txtNovedad'.$idDetalle]) : null,
                );
                
                $detalles[] = $detalle;
            }
        }
        
        $data = array(
            "id" => $_POST['txtIdCheckList'],
            "listaDetalles" => $detalles,
            "usuarioModifica" => $_SESSION['Usuario']->id,
            "fechaRecepcionBodega" => isset($_POST['txtFechaRecepta']) ? $_POST['txtFechaRecepta'] : null,
            "codigoMaterial" => isset($_POST['txtCodMaterialRecep']) ? $_POST['txtCodMaterialRecep']: null,
            "cantidadRecibida" => isset($_POST['txtCantidadRecep']) ? $_POST['txtCantidadRecep'] : null,
        );
        
//        print_r($data);
        
        $respuesta = checkListRecepcionModelo::guardar_checklist_modelo($data);
        
        if(isset($respuesta) && $respuesta->respuesta == "OK"){
            return '<script>swal("", "Datos guardados correctamente.", "success")'
                    . '.then((value) => {
                        $(`#btnSearch`).click(); 
                    });</script>';
        }
        elseif(isset($respuesta)){
            return '<script>swal("", "'.$respuesta->respuesta.'", "error");</script>';
        }
        else{
            return '<script>swal("", "Error al guardar los datos.", "error");</script>';
        }
        
    }
    
}