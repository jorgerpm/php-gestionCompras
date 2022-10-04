<?php

class menuControlador extends menuModelo {

    public function listarMenus() {
        $listaMenus = menuModelo::listar_menus();
        return $listaMenus;
    }

    //aqui la logica
    public function guardar_menu_controlador() {
        $idMenu = $_POST['idMenu'];
        $txtTitulo = $_POST['txtTitulo'];
        $txtLink = $_POST['txtLink'];
        $txtImagen = $_POST['txtImagen'];
        $cbxListaMenu = $_POST['cbxListaMenu'];
        $cbxListaEstado = $_POST['cbxListaEstado'];

        if (isset($txtTitulo) && isset($txtLink) && isset($txtImagen) && isset($cbxListaMenu) && isset($cbxListaEstado)) {
            $datos = [
                "id" => $idMenu,
                "titulo" => strtoupper($txtTitulo),
                "link" => strtoupper($txtLink),
                "imagen" => strtoupper($txtImagen),
                "idMenu" => $cbxListaMenu,
                "idEstado" => $cbxListaEstado
            ];

            $respuesta = menuModelo::guardar_menu_modelo($datos);

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