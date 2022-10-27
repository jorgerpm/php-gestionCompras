<?php
class proveedorModelo extends serviciosWebModelo {
    
    public function buscar_proveedor_ruc($rucProveedor) {
        $array = [];
        $listaProveedores = self::invocarGet('proveedor/buscarProveedorRuc?ruc='.$rucProveedor, $array);
        return $listaProveedores;
    }
    
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