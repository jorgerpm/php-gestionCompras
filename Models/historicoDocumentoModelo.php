<?php
class historicoDocumentoModelo extends serviciosWebModelo {

    
    protected function listar_historico_modelo($codigoRC, $tipoDocumento, $desde, $hasta) {
        $array = [];
        $listaSolicts = self::invocarGet('historialDocumento/buscarHistorialDocs?codigoRC='.$codigoRC.'&tipoDocumento='.$tipoDocumento.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $listaSolicts;
    }
    
}