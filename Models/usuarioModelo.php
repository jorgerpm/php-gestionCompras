<?php
class usuarioModelo extends serviciosWebModelo {
    
    public function guardar_usuario_modelo($datos){
        $respuesta = self::invocarPost('usuario/guardarUsuario', $datos);
        return $respuesta;
    }
    
    
    public function listar_usuarios() {
        $array = [];
        $listaUsuarios = self::invocarGet('usuario/listarUsuarios', $array);
        return $listaUsuarios;
    }
}