<?php

class preguntaControlador extends preguntaModelo {

    public function listar_preguntas_controlador() {
        $listaPreguntas = preguntaModelo::listar_preguntas_modelo();
        if(!isset($listaPreguntas)) {
            $listaPreguntas = [];
        }
        return $listaPreguntas;
    }

    //aqui la logica
    public function guardar_pregunta_controlador() {
        
        $idPregunta = $_POST['idPregunta'];
        $idRol = $_POST['listRoles'];
        $txtPregunta = $_POST['txtPregunta'];
        $listStatus = $_POST['listStatus'];

        if (isset($txtPregunta) && isset($listStatus)) {
            $datos = [
                "id" => $idPregunta,
                "pregunta" => mb_strtoupper($txtPregunta, 'utf-8'),
                "idRol" => $idRol,
                "idEstado" => $listStatus,
                "usuarioModifica" => $_SESSION['Usuario']->id,
            ];

            $respuesta = preguntaModelo::guardar_pregunta_modelo($datos);

            if (isset($respuesta) && $respuesta->id > 0) {
                return '<script>swal("", "Datos almacenados correctamente", "success")
                    .then((value) => {
                        $(`#btnBuscar`).click();
                    });</script>';
            } else {
                return '<script>swal("", "Error al almacenar los datos.", "error");</script>';
            }
            
        } else {
            return '<script>swal("", "Complete los campos requeridos del formulario.", "error");</script>';
        }
    }

    public function buscar_rol_porId_controlador($idRol) {
        $listaPreguntas = preguntaModelo::buscar_preguntas_porRol_modelo($idRol);
        return $listaPreguntas;
    }
    
    
}
