<?php

class productoControlador extends productoModelo {

    public function listarProductos($request) {
        $start = $request['start']; //desde el numero de registro que empieza
        $length = $request['length']; //el numero de registros a buscar
        $valBusq = $request['search']['value']; //este es el valor que se ingresa en la busqueda
        
        if(empty($valBusq)){
            $respuesta = productoModelo::listar_Productos($start, $length, null);
        }
        elseif(strlen($valBusq) >=3 ){
            $respuesta = productoModelo::listar_Productos($start, $length, $valBusq);
        }
        
        if(!isset($respuesta)) {
            $returnLista = array();
        }
        else{
            $listaProductos = array();
            foreach ($respuesta as $producto){
                //$columnas[0] = $producto->id;
                $columnas[0] = $producto->codigoProducto;
                $columnas[1] = $producto->nombre;
                $columnas[2] = $producto->valorUnitario;
                $columnas[3] = ($producto->tieneIva == 1) ? "SÍ" : "NO";
                $columnas[4] = ($producto->idEstado == 1) ? "ACTIVO" : "INACTIVO";
                $columnas[5] = '<div class="btn-group mr-2" role="group" aria-label="First group">
                            <button class="btn btn-info fa fa-edit" type="button" 
                            onclick=\'openModalProducto(variableProducto = '.json_encode($producto).');\'></button>
                           </div>';

                $listaProductos[] = $columnas;
            }
            
            $returnLista = array(
			"draw"            => isset ( $request['draw'] ) ? intval( $request['draw'] ) : 0,
			"recordsTotal"    => $producto->totalRegistros,
			"recordsFiltered" => $producto->totalRegistros,
			"data"            => $listaProductos
    //[["1","2","3","4","5","6","7"]]
		);
        }
        return $returnLista;
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
                "nombre" => mb_strtoupper($txtNombre, 'utf-8'),
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
