<?php
class proveedorModelo extends serviciosWebModelo {
    
    public function guardar_proveedor_modelo($datos){
        $respuesta = self::invocarPost('proveedor/guardarProveedor', $datos);
        return $respuesta;
    }
    
    public function guardar_proveedor_usuario_modelo($datos){
        $respuesta = self::invocarPost('proveedor/guardarProveedorUsuario', $datos);
        return $respuesta;
    }
    
    
    public function listar_proveedores() {
        $array = [];
        $listaProveedores = self::invocarGet('proveedor/listarProveedores', $array);
        return $listaProveedores;
    }
}