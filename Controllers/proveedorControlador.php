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
        $txtNombreComercial = $_POST['txtNombreComercial'];
        $txtRazonSocial = $_POST['txtRazonSocial'];
        $txtDireccion = $_POST['txtDireccion'];
        $txtTelefono1 = $_POST['txtTelefono1'];
        $txtTelefono2 = $_POST['txtTelefono2'];
        $txtCorreo = $_POST['txtCorreo'];
        $txtRuc = $_POST['txtRuc'];
        $txtCodigoJD = $_POST['txtCodigoJD'];
        $cbxIdEstado = $_POST['cbxListaEstado'];

        if (isset($txtRazonSocial) && isset($txtDireccion) && isset($txtTelefono1) && isset($txtCorreo) && isset($txtRuc) && isset($cbxIdEstado)) {
            $datos = [
                "id" => $idProveedor,
                "nombreComercial" => strtoupper($txtNombreComercial),
                "razonSocial" => strtoupper($txtRazonSocial),
                "direccion" => strtoupper($txtDireccion),
                "telefono1" => $txtTelefono1,
                "telefono2" => $txtTelefono2,
                "correo" => $txtCorreo,
                "ruc" => $txtRuc,
                "codigoJD" => strtoupper($txtCodigoJD),
                "idEstado" => strtoupper($cbxIdEstado)
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
