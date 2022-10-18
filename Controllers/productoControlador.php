<?php

class productoControlador extends productoModelo {

    public function listarProductos() {
        $listaProductos = productoModelo::listar_Productos();
        if(!isset($listaProductos)) {
            $listaProductos = [];
        }
        return $listaProductos;
    }

    //aqui la logica
    public function guardar_producto_controlador() {
        $idProducto = $_POST['idProducto'];
        $txtCodigoProducto = $_POST['txtCodigoProducto'];
        $txtNombre = $_POST['txtNombre'];
        $txtValorUnitario = $_POST['txtValorUnitario'];
        $chkTieneIva = $_POST['chkTieneIva'];
        $chkTieneIva = ($chkTieneIva == null) ? false : true;
        $listStatus = $_POST['listStatus'];

        if (isset($txtCodigoProducto) && isset($txtNombre) && isset($txtValorUnitario) && isset($listStatus)) {
            $datos = [
                "id" => $idProducto,
                "codigoProducto" => $txtCodigoProducto,
                "nombre" => strtoupper($txtNombre),
                "valorUnitario" => $txtValorUnitario,
                "tieneIva" => $chkTieneIva,
                "idEstado" => $listStatus
            ];

            $respuesta = productoModelo::guardar_producto_modelo($datos);

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
