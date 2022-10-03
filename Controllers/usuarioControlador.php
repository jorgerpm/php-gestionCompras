<?php

class usuarioControlador extends usuarioModelo {

    public function listarUsuarios() {
        $listaUsuarios = usuarioModelo::listar_usuarios();
        return $listaUsuarios;
    }

    //aqui la logica
    public function guardar_usuario_controlador() {
        $idRol = $_POST['idUsuario'];
        $txtNombre = $_POST['txtNombre'];
        $txtUsuario = $_POST['txtUsuario'];
        $txtClave = $_POST['txtClave'];
        $txtCorreo = $_POST['txtCorreo'];
        $cbxListaRol = $_POST['cbxListaRol'];
        $cbxListaEstado = $_POST['cbxListaEstado'];

        if (isset($txtNombre) && isset($txtUsuario) && isset($txtClave) && isset($txtCorreo) && isset($cbxListaRol) && isset($cbxListaEstado)) {
            $datos = [
                "id" => $idRol,
                "nombre" => strtoupper($txtNombre),
                "usuario" => strtoupper($txtUsuario),
                "clave" => strtoupper($txtClave),
                "correo" => strtoupper($txtCorreo),
                "idEstado" => $cbxListaRol,
                "idRol" => $cbxListaEstado
            ];

            $respuesta = usuarioModelo::guardar_usuario_modelo($datos);

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