<?php
session_start();
class usuarioControlador extends usuarioModelo {

    public function listarUsuarios() {
        $listaUsuarios = usuarioModelo::listar_usuarios();
        return $listaUsuarios;
    }

    public function cambiar_clave() {
        $id = $_SESSION['Usuario']->id;
        $txtNombre = $_SESSION['Usuario']->nombre;
        $txtUsuario = $_SESSION['Usuario']->usuario;
        $claveActual = $_SESSION['Usuario']->clave;
        $txtCorreo = $_SESSION['Usuario']->correo;
        $cbxListaRol = $_SESSION['Usuario']->idEstado;
        $cbxListaEstado = $_SESSION['Usuario']->idRol;
        
        $txtClaveActual = $_POST['txtClaveActual'];
        $txtClaveNueva = $_POST['txtClaveNueva'];
        $txtRepetirClave = $_POST['txtRepetirClave'];
        
        if($txtClaveActual == $claveActual) {
            if($txtClaveActual == $txtRepetirClave){
                $datos = [
                    "id" => $id,
                    "nombre" => $txtNombre,
                    "usuario" => $txtUsuario,
                    "clave" => $txtClaveNueva,
                    "correo" => $txtCorreo,
                    "idEstado" => $cbxListaEstado,
                    "idRol" => $cbxListaRol
                ];

                $respuesta = usuarioModelo::guardar_usuario_modelo($datos);

                echo '<script>swal("", "Contraseña actualizada correctamente", "success");</script>';
            } else {
                echo '<script>swal("", "Repita bien la contraseña", "error");</script>';
            }
        } else {
            echo '<script>swal("", "Las contraseña ingresada no coincide con la registrada", "error");</script>';
        }
    }
    
    //aqui la logica
    public function guardar_usuario_controlador() {
        $id = $_POST['idUsuario'];
        $txtNombre = $_POST['txtNombre'];
        $txtUsuario = $_POST['txtUsuario'];
        $txtClave = $_POST['txtClave'];
        $txtCorreo = $_POST['txtCorreo'];
        $cbxListaRol = $_POST['cbxListaRol'];
        $cbxListaEstado = $_POST['cbxListaEstado'];

        if (isset($txtNombre) && isset($txtUsuario) && isset($txtClave) && isset($txtCorreo) && isset($cbxListaRol) && isset($cbxListaEstado)) {
            $datos = [
                "id" => $id,
                "nombre" => strtoupper($txtNombre),
                "usuario" => $txtUsuario,
                "clave" => $txtClave,
                "correo" => $txtCorreo,
                "idEstado" => $cbxListaEstado,
                "idRol" => $cbxListaRol
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