<?php
class proveedorModelo extends serviciosWebModelo {
    
    protected function buscar_proveedor_ruc($rucProveedor) {
        $array = [];
        $listaProveedores = self::invocarGet('proveedor/buscarProveedorRuc?ruc='.$rucProveedor, $array);
        return $listaProveedores;
    }
    
    protected function guardar_proveedor_modelo($datos){
        $respuesta = self::invocarPost('proveedor/guardarProveedor', $datos);
        return $respuesta;
    }
    
    protected function guardar_proveedor_usuario_modelo($datos){
        $respuesta = self::invocarPost('proveedor/guardarProveedorUsuario', $datos);
        return $respuesta;
    }
    
    protected function listar_proveedores_modelo($start, $length, $valBusq) {
        $array = [];
        $listaProveedores = self::invocarGet('proveedor/listarProveedores?desde='.$start.'&hasta='.$length.'&valBusq='.$valBusq, $array);
        return $listaProveedores;
    }
    
    protected function carga_masiva_proveedores($datos){
        $respuesta = self::invocarPost('proveedor/cargaMasivaProveedores', $datos);
        return $respuesta;
    }
}