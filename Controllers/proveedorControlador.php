<?php

class proveedorControlador extends proveedorModelo {

    public function buscarProveedorRuc($rucProveedor) {
        $buscarProveedorRuc = proveedorModelo::buscar_proveedor_ruc($rucProveedor);
        return $buscarProveedorRuc;
    }
    
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

    public function guardar_proveedor_usuario_controlador() {
        $idProveedor = $_POST['idProveedor'];
        $txtRucProveedor = $_POST['txtRucProveedor'];
        $txtRazonSocial = $_POST['txtRazonSocial'];
        $txtNombreComercial = $_POST['txtNombreComercial'];
        $txtDireccion = $_POST['txtDireccion'];
        $txtCorreo = $_POST['txtCorreo'];
        $txtTelefono1 = $_POST['txtTelefono1'];
        $txtTelefono2 = $_POST['txtTelefono2'];
        $txtClave = $_POST['txtClave'];
        $cbxIdEstado = 1;

        if (isset($txtRazonSocial) && isset($txtDireccion) && isset($txtTelefono1) && isset($txtCorreo) && isset($txtRucProveedor) && isset($txtClave) && isset($cbxIdEstado)) {
            $datos = [
                "id" => $idProveedor,
                "ruc" => $txtRucProveedor,
                "razonSocial" => strtoupper($txtRazonSocial),
                "nombreComercial" => strtoupper($txtNombreComercial),
                "direccion" => strtoupper($txtDireccion),
                "correo" => $txtCorreo,
                "telefono1" => $txtTelefono1,
                "telefono2" => $txtTelefono2,
                "clave" => md5($txtClave),
                "idEstado" => strtoupper($cbxIdEstado)
            ];

            $respuesta = proveedorModelo::guardar_proveedor_usuario_modelo($datos);

            if ($respuesta->id > 0) {
                echo '<script>swal("", "Datos almacenados correctamente", "success")
                    .then((value) => {
                        $(`#btnBuscar`).click();
                    });</script>';
            } else {
                echo '<script>swal("", "Error al almacenar los datos.", "error");</script>';
            }
            
        } else {
            echo '<script>swal("", "Complete los campos requeridos del formulario.", "error");</script>';
        }
    }

    public function cargaMasivaProveedores() {
        $carpeta = "../Config/";
        opendir($carpeta);
        $destino = $carpeta.$_FILES['archivo']['name'];
        copy($_FILES['archivo']['tmp_name'], $destino);
        $archivoCsv = file_get_contents($destino);
        $fileBase64 = base64_decode($archivoCsv);
        $datos = [
            "archivoBase64" => $fileBase64
        ];
        $respuesta = proveedorModelo::carga_masiva_proveedores($datos);
    }
}
