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
//        $valBusq = $_POST['txtSearchRuc'];

        if (empty($valBusq)) {
            $respuesta = proveedorModelo::listar_proveedores_modelo($start, $length, null);
        } elseif (strlen($valBusq) >= 3) {
            $respuesta = proveedorModelo::listar_proveedores_modelo($start, $length, urlencode($valBusq));
        }

        if (!isset($respuesta) || empty($respuesta)) {
//            $returnLista = array();
            $returnLista = array(
                "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
                "recordsTotal" => 0,
                "recordsFiltered" => 0,
                "data" => []
            );
        } else {
            $listaProveedores = array();
            foreach ($respuesta as $proveedor) {

                $columnas[0] = '<div class="btn-group mr-2" role="group" aria-label="First group">
                                                <button class="btn btn-info fa fa-edit btn-sm" type="button" onclick=\'openModalProveedor(variableProveedor = ' . json_encode($proveedor) . ');\'></button>
                                            </div>';

                $columnas[1] = $proveedor->codigoJD;
                $columnas[2] = $proveedor->ruc;
                $columnas[3] = $proveedor->razonSocial;
                $columnas[4] = $proveedor->nombreComercial;
                $columnas[5] = $proveedor->contacto;
                $columnas[6] = $proveedor->correo;
                $columnas[7] = $proveedor->telefono1;
                $columnas[8] = $proveedor->telefono2;
                $columnas[9] = $proveedor->direccion;
                $columnas[10] = $proveedor->contabilidad;
                $columnas[11] = $proveedor->telefonoContabilidad;
                $columnas[12] = $proveedor->correoContabilidad;
                $columnas[13] = ($proveedor->idEstado == 1) ? "ACTIVO" : "INACTIVO";



                $listaProveedores[] = $columnas;
                
            }
            $returnLista = array(
                "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 0,
                "recordsTotal" => $proveedor->totalRegistros,
                "recordsFiltered" => $proveedor->totalRegistros,
                "data" => $listaProveedores
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
                "nombreComercial" => mb_strtoupper($txtNombreComercial, 'utf-8'),
                "razonSocial" => mb_strtoupper($txtRazonSocial, 'utf-8'),
                "direccion" => mb_strtoupper($txtDireccion, 'utf-8'),
                "telefono1" => $txtTelefono1,
                "telefono2" => $txtTelefono2,
                "correo" => $txtCorreo,
                "ruc" => $txtRuc,
                "codigoJD" => mb_strtoupper($txtCodigoJD, 'utf-8'),
                "idEstado" => mb_strtoupper($cbxIdEstado, 'utf-8'),
                
                "contabilidad" => mb_strtoupper($_POST['txtContabilidad'], 'utf-8'),
                "telefonoContabilidad" => mb_strtoupper($_POST['txtTelefonoContabilidad'], 'utf-8'),
                "contacto" => mb_strtoupper($_POST['txtContacto'], 'utf-8'),
                "correoContabilidad" => mb_strtoupper($_POST['txtCorreoContabilidad'], 'utf-8'),
                
                "carpeta" => mb_strtoupper($_POST['txtCarpeta'], 'utf-8'),
                "servicioProducto" => mb_strtoupper($_POST['txtServicioProducto'], 'utf-8'),
                "credito" => mb_strtoupper($_POST['txtCredito'], 'utf-8'),
            ];

            $respuesta = proveedorModelo::guardar_proveedor_modelo($datos);

            if (isset($respuesta) && $respuesta->id > 0) {
                return '<script>swal("", "Datos almacenados correctamente", "success")
                    .then((value) => {
                        $(`#btnBuscar`).click();
                    });</script>';
            } elseif(isset($respuesta)) {
                return '<script>swal("", "'.$respuesta->respuesta.'", "error");</script>';
            }
            else{
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
                "razonSocial" => mb_strtoupper($txtRazonSocial, 'utf-8'),
                "nombreComercial" => mb_strtoupper($txtNombreComercial, 'utf-8'),
                "direccion" => mb_strtoupper($txtDireccion, 'utf-8'),
                "correo" => $txtCorreo,
                "telefono1" => $txtTelefono1,
                "telefono2" => $txtTelefono2,
                "clave" => md5($txtClave),
                "idEstado" => mb_strtoupper($cbxIdEstado, 'utf-8'),
                "contabilidad" => mb_strtoupper($_POST['txtContabilidad'], 'utf-8'),
                "telefonoContabilidad" => mb_strtoupper($_POST['txtTelefonoContabilidad'], 'utf-8'),
                "contacto" => mb_strtoupper($_POST['txtContacto'], 'utf-8'),
                "correoContabilidad" => mb_strtoupper($_POST['txtCorreoContabilidad'], 'utf-8'),
            ];

            $respuesta = proveedorModelo::guardar_proveedor_usuario_modelo($datos);

            if (isset($respuesta) && $respuesta->id > 0) {
                echo '<script>swal("", "Datos almacenados correctamente", "success")
                    .then((value) => {
                        $(`#btnBuscar`).click();
                    });</script>';
            } elseif(isset($respuesta)) {
                echo '<script>swal("", "'.$respuesta->respuesta.'", "error");</script>';
            }else{
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
        if ($file_extension == "csv") {
            copy($_FILES['archivo']['tmp_name'], $destino);
            $archivoCsv = file_get_contents($destino);
            $fileBase64 = base64_encode($archivoCsv);
            $datos = [
                "archivoBase64" => $fileBase64
            ];

            unlink($destino);
            $respuesta = proveedorModelo::carga_masiva_proveedores($datos);
            if (isset($respuesta) && $respuesta->respuesta == "ok") {
                echo '<script>swal("", "Datos almacenados correctamente", "success")
                    .then((value) => {
                        $(`#btnBuscar`).click();
                    });</script>';
            } elseif(isset($respuesta) && $respuesta->respuesta != "ok") {
                echo '<script>swal("", "'.$respuesta->respuesta.'", "error")
                    .then((value) => {
                        $(`#btnBuscar`).click();
                    });</script>';
            }else{
                echo '<script>swal("", "Error al almacenar los datos.", "error");</script>';
            }
        } else {
            echo '<script>swal("", "Formato de archivo diferente a csv", "warning");</script>';
        }
    }

    public function listarProveedoresActivosNombre() {
        //este es el valor que se ingresa en la busqueda
        $valBusq = isset($_POST['txtNombreProveedor']) ? $_POST['txtNombreProveedor'] : ""; 

        if (empty($valBusq)) {
            $respuesta = proveedorModelo::listar_proveedores_activos_modelo(null);
        } elseif (strlen($valBusq) >= 3) {
            $respuesta = proveedorModelo::listar_proveedores_activos_modelo(urlencode($valBusq));
        }

        if (!isset($respuesta)) {
            $respuesta = array();
        }

        return $respuesta;
    }

}
