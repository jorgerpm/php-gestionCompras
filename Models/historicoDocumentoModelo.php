<?php
class historicoDocumentoModelo extends serviciosWebModelo {

    
    protected function listar_historico_modelo($codigoSol, $codigoRC, $tipoDocumento, $desde, $hasta) {
        $array = [];
        $listaSolicts = self::invocarGet('historialDocumento/buscarHistorialDocs?codigoSolicitud='.$codigoSol.'&codigoRC='.$codigoRC.'&tipoDocumento='.$tipoDocumento.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaSolicts;
    }
    
}