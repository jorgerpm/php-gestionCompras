<?php
class comparativoModelo extends serviciosWebModelo {
    
    protected function listar_comparativos_modelo($fechaIni, $fechaFin, $codigoSol, $codigoRC, $desde, $hasta) {
        $array = [];
        $lista = self::invocarGet('comparativo/listarComparativos?fechaInicial='.$fechaIni.'&fechaFinal='.$fechaFin.'&codigoSolicitud='.$codigoSol.'&codigoRC='.$codigoRC.'&desde='.$desde.'&hasta='.$hasta, $array);
        return $lista;
    }
}