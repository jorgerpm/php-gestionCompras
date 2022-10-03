<?php

//require_once '../Utils/configUtil.php';

class rolControlador extends rolModelo {

    public function listarRoles() {
        $listaRoles = rolModelo::listar_roles();
        return $listaRoles;
    }

    //aqui la logica
    public function guardar_rol_controlador() {
        $idRol = $_POST['idRol'];
        $txtNombre = $_POST['txtNombre'];
        $listStatus = $_POST['listStatus'];

        if (isset($txtNombre) && isset($listStatus)) {
            $datos = [
                "id" => $idRol,
                "nombre" => strtoupper($txtNombre),
                "idEstado" => $listStatus
            ];

            $respuesta = rolModelo::guardar_rol_modelo($datos);

            if ($respuesta->id > 0) {
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

}
