<?php
class preguntaModelo extends serviciosWebModelo {
    
    protected function guardar_pregunta_modelo($datos){
        $respuesta = self::invocarPost('preguntaChecklistRecepcion/guardarPregunta', $datos);
        return $respuesta;
    }
    
    
    protected function listar_preguntas_modelo() {
        $array = [];
        $listaPreguntas = self::invocarGet('preguntaChecklistRecepcion/listarPreguntas', $array);
        return $listaPreguntas;
    }
    
    protected function buscar_preguntas_porRol_modelo($idRol) {
        $array = [];
        $listaPreguntas = self::invocarGet('preguntaChecklistRecepcion/buscarPreguntasPorRol?idRol='.$idRol, $array);
        return $listaPreguntas;
    }
    
    
    
}