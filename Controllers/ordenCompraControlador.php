<?php
class ordenCompraControlador extends ordenCompraModelo {
    
    public function guardar_orden_compra(){
        
        $data = array(
                'codigoRC' => $_POST['txtCodigoRc'],
                'estado' => 'GENERADO_OC',
                'usuario' => $_SESSION['Usuario']->nombre,
            );
    
        $ordenCompra = ordenCompraModelo::guardar_ordencompra_modelo($data);
        
        if(isset($ordenCompra) && $ordenCompra->id > 0){
            return '<script>swal("", "Orden de compra generada correctamente.", "success");</script>';
        }
        else{
            return '<script>swal("", "Error al generar la orden de compra.", "error");</script>';
        }
        
    }
}