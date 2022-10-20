<?php

class formaPagoControlador extends formaPagoModelo {

    public function listarFormasPago() {
        $listaFormasPago = formaPagoModelo::listar_formas_pago();
        if(!isset($listaFormasPago)) {
            $listaFormasPago = [];
        }
        return $listaFormasPago;
    }

    //aqui la logica
    public function guardar_forma_pago_controlador() {
        $idFormaPago = $_POST['idFormaPago'];
        $txtNombre = $_POST['txtNombre'];
        $listStatus = $_POST['listStatus'];

        if (isset($txtNombre) && isset($listStatus)) {
            $datos = [
                "id" => $idFormaPago,
                "nombre" => strtoupper($txtNombre),
                "idEstado" => $listStatus
            ];

            $respuesta = formaPagoModelo::guardar_forma_pago_modelo($datos);

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
