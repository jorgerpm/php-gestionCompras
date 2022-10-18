<?php
class productoModelo extends serviciosWebModelo {
    
    public function guardar_producto_modelo($datos){
        $respuesta = self::invocarPost('producto/guardarProducto', $datos);
        return $respuesta;
    }
    
    public function listar_productos() {
        $array = [];
        $listaProductos = self::invocarGet('producto/listarProductos', $array);
        return $listaProductos;
    }
}