<?php

class proveedorControlador extends proveedorModelo {

    public function listarProveedores() {
        $listaProveedores = proveedorModelo::listar_proveedores();
        if(!isset($listaProveedores)) {
            $listaProveedores = [];
        }
        return $listaProveedores;
    }

    //aqui la logica
    public function guardar_proveedor_controlador() {
        $idProveedor = $_POST['idProveedor'];
        $txtNombre = $_POST['txtNombre'];
        $txtRuc = $_POST['txtRuc'];
        $txtCodigoJD = $_POST['txtCodigoJD'];

        if (isset($txtNombre) && isset($txtRuc) && isset($txtCodigoJD)) {
            $datos = [
                "id" => $idProveedor,
                "nombre" => strtoupper($txtNombre),
                "ruc" => strtoupper($txtRuc),
                "codigoJD" => strtoupper($txtCodigoJD)
            ];

            $respuesta = proveedorModelo::guardar_proveedor_modelo($datos);

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
