<?php

class integracionJDModelo extends serviciosWebModelo { 

    protected function buscar_orden_jd_modelo($data){
        $respuesta = self::invocarPost('solicitud/buscarRCJD', $data);
        return $respuesta;
    }
    
}