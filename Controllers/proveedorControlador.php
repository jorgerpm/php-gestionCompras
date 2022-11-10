<?php

class proveedorControlador extends proveedorModelo {

    public function buscarProveedorRuc($rucProveedor) {
        $buscarProveedorRuc = proveedorModelo::buscar_proveedor_ruc($rucProveedor);
        return $buscarProveedorRuc;
    }
    
    public function listarProveedores() {
        $start = $_POST['start']; //desde el numero de registro que empieza
        $length = $_POST['length']; //el numero de registros a buscar
        $valBusq = $_POST['search']['value']; //este es el valor que se ingresa en la busqueda
        
        $valBusq = $_POST['txtSearchRuc'];
        
        if(empty($valBusq)){
            $respuesta = proveedorModelo::listar_proveedores_modelo($start, $length, null);
        }
        elseif(strlen($valBusq) >=3 ){
            $respuesta = proveedorModelo::listar_proveedores_modelo($start, $length, urlencode($valBusq));
        }
        
        if(!isset($respuesta)) {
            $returnLista = array();
        }
        else{
            $listaProveedores = array();
            foreach ($respuesta as $proveedor){
                //$columnas[0] = $proveedor->id;
                $columnas[0] = $proveedor->codigoJD;
                $columnas[1] = $proveedor->ruc;
                $columnas[2] = $proveedor->razonSocial;
                $columnas[3] = $proveedor->nombreComercial;
                $columnas[4] = $proveedor->direccion;
                $columnas[5] = $proveedor->correo;
                $columnas[6] = $proveedor->telefono1;
                $columnas[7] = $proveedor->telefono2;
                $columnas[8] = ($proveedor->idEstado == 1) ? "ACTIVO" : "INACTIVO";
                
                $columnas[9] = '<div class="btn-group mr-2" role="group" aria-label="First group">
                                                <button class="btn btn-info fa fa-edit" type="button" onclick=\'openModalProveedor(variableProveedor = '. json_encode($proveedor).');\'></button>
                                            </div>';

                $listaProveedores[] = $columnas;
            }
            
            $returnLista = array(
			"draw"            => isset ( $_POST['draw'] ) ? intval( $_POST['draw'] ) : 0,
			"recordsTotal"    => $proveedor->totalRegistros,
			"recordsFiltered" => $proveedor->totalRegistros,
			"data"            => $listaProveedores
    //[["1","2","3","4","5","6","7"]]
		);
        }
        return $returnLista;
    }

    //aqui la logica
    public function guardar_proveedor_controlador() {
        $idProveedor = $_POST['idProveedor'];
        $txtNombreComercial = $_POST['txtNombreComercial'];
        $txtRazonSocial = $_POST['txtRazonSocial'];
        $txtDireccion = $_POST['txtDireccion'];
        $txtTelefono1 = $_POST['txtTelefono1'];
        $txtTelefono2 = $_POST['txtTelefono2'];
        $txtCorreo = $_POST['txtCorreo'];
        $txtRuc = $_POST['txtRuc'];
        $txtCodigoJD = $_POST['txtCodigoJD'];
        $cbxIdEstado = $_POST['cbxListaEstado'];

        if (isset($txtRazonSocial) && isset($txtDireccion) && isset($txtTelefono1) && isset($txtCorreo) && isset($txtRuc) && isset($cbxIdEstado)) {
            $datos = [
                "id" => $idProveedor,
                "nombreComercial" => strtoupper($txtNombreComercial),
                "razonSocial" => strtoupper($txtRazonSocial),
                "direccion" => strtoupper($txtDireccion),
                "telefono1" => $txtTelefono1,
                "telefono2" => $txtTelefono2,
                "correo" => $txtCorreo,
                "ruc" => $txtRuc,
                "codigoJD" => strtoupper($txtCodigoJD),
                "idEstado" => strtoupper($cbxIdEstado)
            ];

            $respuesta = proveedorModelo::guardar_proveedor_modelo($datos);

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

    public function guardar_proveedor_usuario_controlador() {
        $idProveedor = $_POST['idProveedor'];
        $txtRucProveedor = $_POST['txtRucProveedor'];
        $txtRazonSocial = $_POST['txtRazonSocial'];
        $txtNombreComercial = $_POST['txtNombreComercial'];
        $txtDireccion = $_POST['txtDireccion'];
        $txtCorreo = $_POST['txtCorreo'];
        $txtTelefono1 = $_POST['txtTelefono1'];
        $txtTelefono2 = $_POST['txtTelefono2'];
        $txtClave = $_POST['txtClave'];
        $cbxIdEstado = 1;

        if (isset($txtRazonSocial) && isset($txtDireccion) && isset($txtTelefono1) && isset($txtCorreo) && isset($txtRucProveedor) && isset($txtClave) && isset($cbxIdEstado)) {
            $datos = [
                "id" => $idProveedor,
                "ruc" => $txtRucProveedor,
                "razonSocial" => strtoupper($txtRazonSocial),
                "nombreComercial" => strtoupper($txtNombreComercial),
                "direccion" => strtoupper($txtDireccion),
                "correo" => $txtCorreo,
                "telefono1" => $txtTelefono1,
                "telefono2" => $txtTelefono2,
                "clave" => md5($txtClave),
                "idEstado" => strtoupper($cbxIdEstado)
            ];

            $respuesta = proveedorModelo::guardar_proveedor_usuario_modelo($datos);

            if ($respuesta->id > 0) {
                echo '<script>swal("", "Datos almacenados correctamente", "success")
                    .then((value) => {
                        $(`#btnBuscar`).click();
                    });</script>';
            } else {
                echo '<script>swal("", "Error al almacenar los datos.", "error");</script>';
            }
            
        } else {
            echo '<script>swal("", "Complete los campos requeridos del formulario.", "error");</script>';
        }
    }

    public function cargaMasivaProveedores() {
        $carpeta = "../Config/";
        opendir($carpeta);
        $destino = $carpeta . $_FILES['archivo']['name'];
        $file_extension = pathinfo($destino, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension); //String cambia las letras a minúsculas; strtoupper pone en mayúsculas
        if($file_extension == "csv") {
            copy($_FILES['archivo']['tmp_name'], $destino);
            $archivoCsv = file_get_contents($destino);
            $fileBase64 = base64_encode($archivoCsv);
            $datos = [
                "archivoBase64" => $fileBase64
            ];

            $respuesta = proveedorModelo::carga_masiva_proveedores($datos);
            
            if(isset($respuesta) && $respuesta->respuesta == "ok") {
                echo '<script>swal("", "Datos almacenados correctamente", "success")
                    .then((value) => {
                        $(`#btnBuscar`).click();
                    });</script>';
            } else {
                echo '<script>swal("", "Error al almacenar los datos.", "error");</script>';
            }
        } else {
            echo '<script>swal("", "Formato de archivo diferente a csv", "warning");</script>';
        }
    }
}
