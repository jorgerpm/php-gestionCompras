<?php
class checkListRecepcionModelo extends serviciosWebModelo {

    protected function generar_checkListRecepcion_modelo($data){
        $ordenCompra = self::invocarPost('checkListRecepcion/generarCheckList', $data);
        return $ordenCompra;
    }

    protected function listar_checklist_modelo($fechaIni, $fechaFin, $codigoSol, $codigoRC, $desde, $hasta, $todos) {
        $array = [];
        
        $lista = self::invocarGet('checkListRecepcion/listarCheckList?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin
                .'&codigoSolicitud='.$codigoSol.'&codigoRC='.$codigoRC
                .'&idUsuario='.$_SESSION['Usuario']->id.'&rolPrincipal='.($_SESSION['Rol']->principal==1?'true':'false')
                .'&desde='.$desde.'&hasta='.$hasta.'&buscarTodo='.$todos, $array);
        
        return $lista;
    }
    
    protected function guardar_checklist_modelo($data){
        $ordenCompra = self::invocarPost('checkListRecepcion/guardarCheckListRecepcion', $data);
        return $ordenCompra;
    }
}