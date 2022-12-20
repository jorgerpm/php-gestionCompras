<?php
class autorizacionControlador extends autorizacionModelo {
    
    public function guardar_autorizadores_controlador(){
        if(isset($_POST)){
            
            $index = $_POST['registrosTabla'];
            
            $data = array();
            
            for($i=0;$i<$index;$i++){
            
                $data[] = array(
                    "idOrdenCompra" => $_POST['txtIdOrdenCompra'],
                    "idUsuario" => $_POST['txtIdUserModal'.$i],
                    "usuarioModifica" => $_SESSION['Usuario']->id,
                    "usuariosEliminar" => $_POST['txtEliminaUser'],
                );
            }
            
            $respuesta = autorizacionModelo::guardar_autorizadores_modelo($data);
            
            if(isset($respuesta->respuesta)){
                if($respuesta->respuesta == "OK"){
                    return '<script>swal("", "Autorizadores guardados correctamente.", "success")'
                    . '.then((value) => {
                        $(`#btnSearch`).click(); 
                    });</script>';
                }
                else{
                    return '<script>swal("", "'.$respuesta->respuesta.'", "error");</script>';
                }
            }
            else{
                return '<script>swal("", "Error al guardar los autorizadores de la orden de compra.", "error");</script>';
            }
        }
    }
    
}