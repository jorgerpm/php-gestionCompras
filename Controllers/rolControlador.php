<?php

class rolControlador extends rolModelo {

    public function listarRoles() {
        $listaRoles = rolModelo::listar_roles();
        if(!isset($listaRoles)) {
            $listaRoles = [];
        }
        return $listaRoles;
    }

    //aqui la logica
    public function guardar_rol_controlador() {
        $idRol = $_POST['idRol'];
        $txtNombre = $_POST['txtNombre'];
        $chkPrincipal = isset($_POST['chkPrincipal']) ? true : false;
        $listStatus = $_POST['listStatus'];
        $cheklistRecepcion = isset($_POST['checkList']) ? true : false;

        if (isset($txtNombre) && isset($listStatus)) {
            $datos = [
                "id" => $idRol,
                "nombre" => mb_strtoupper($txtNombre, 'utf-8'),
                "principal" => $chkPrincipal,
                "cheklistRecepcion" => $cheklistRecepcion,
                "idEstado" => $listStatus,
                "autorizador" => isset($_POST['chkAutorizador']) ? true : false
            ];

            $respuesta = rolModelo::guardar_rol_modelo($datos);

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
        $rolDto = rolModelo::buscar_rol_porId_modelo($idRol);
        return $rolDto;
    }
    
    
    public function roles_check_list_controlador() {
        $listaRoles = rolModelo::roles_check_list_modelo();
        if(!isset($listaRoles)) {
            $listaRoles = [];
        }
        return $listaRoles;
    }
    
}
