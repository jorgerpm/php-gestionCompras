<?php
class integracionJDControlador extends integracionJDModelo {

    public function buscar_orden_jd_controlador() {

        $data = [
            "codigoRC" => mb_strtoupper(trim($_POST['codigoRC']), 'utf-8')
        ];
                
        $respuesta = integracionJDModelo::buscar_orden_jd_modelo($data);

        if(!isset($respuesta)){
            $respuesta = null;
        }
        
        return $respuesta;
    }
    
    
}