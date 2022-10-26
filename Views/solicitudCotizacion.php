
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Solicitud de cotizaci&oacute;n</span>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">Solicitud de cotizaci&oacute;n</a></li>
        </ul>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form id="formSolicitud">
                        <div class="row" style="padding-bottom: 5px">
                            <div class="col-md-2 col-sm-2 col-12">
                                <label>C&oacute;digo de RC</label>
                            </div>
                            <div class="col-md-2 col-sm-2 col-12">
                                <input id="txtCodRC" name="txtCodRC" class="form-control btn-sm">
                            </div>
                            <div class="col-md-2 col-sm-2 col-12">
                                <label>Fecha</label>
                            </div>
                            <div class="col-md-2 col-sm-2 col-12">
                                <input id="dtFechaSol" name="dtFechaSol" class="form-control btn-sm" type="date" value="<?php echo date("Y-m-d"); ?>">
                            </div>

                            <div class="col-md-4 col-sm-4 col-12"></div>
                        </div>

                        <div class="row" style="padding-bottom: 5px">
                            <div class="col-md-2 col-sm-2 col-12">
                                <label>Proveedor</label>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">

                                <?php
                                require_once './Controllers/proveedorControlador.php';
                                $provCont = new proveedorControlador();
                                $listaProvs = $provCont->listarProveedores();
                                ?>
                                <select class="form-control" id="cmbProveed">
                                    <option class="menuRol" value="" >-Proveedores-</option>
                                    <?php foreach ($listaProvs as $proveedor) { ?>
                                        <option class="menuRol" value="<?php echo $proveedor->correo; ?>" ><?php echo $proveedor->razonSocial; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-sm-2 col-12">
                                <button class="btn btn-primary btn-sm fa" type="button" onclick="agregarCorreo();">
                                    <i class="fa fa-plus"></i></button>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">

                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 col-sm-2 col-12">
                                <label>Lista de correos</label>
                            </div>
                            <div class="col-md-10 col-sm-10 col-12">
                                <input id="txtCorreos" name="txtCorreos" class="form-control btn-sm">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-12">
                                <button class="btn btn-primary btn-sm fa" type="button" onclick="agregarFila();">
                                    <i class="fa fa-plus"></i> A&ntilde;adir producto</button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-12"></div>

                        </div>


                        <br>
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered" id="tblDetSolicitud" name="tblDetSolicitud">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">Cantidad</th>
                                        <!-- th>C&oacute;digo producto</th -->
                                        <th>Descripci&oacute;n</th>
                                        <!-- th>Precio unitario</th>
                                        <th>Precio total</th -->
                                        <th style="width: 5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>

                        <!-- div class="row">
                            <div class="col-md-8 col-sm-8 col-12" style="text-align: end">
                                <label class="control-label">Tot ord:</label>
                            </div>
                            <div class="col-md-4 col-sm-4 col-12">
                                <input class="form-control" id="txtTotOrd" type="text" name="txtTotOrd" placeholder="Total de la orden">
                            </div>
                        </div -->
                        <div>
                            <label class="control-label">Observaciones:</label>
                            <textarea id="txtObserv" name="txtObserv" class="form-control" placeholder="Observaciones"></textarea>
                        </div>

                        <br>
                        <div style="text-align: center">
                            <button class="btn btn-primary btn-sm fa" type="submit" >
                                <i class="fa fa-floppy-o"></i> Guardar y enviar</button>
                        </div>
                        <div class="RespuestaAjax" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function agregarFila() {
        //generar el id dinamico para el input del td nuevo que se crea
        let tabla = document.getElementById('tblDetSolicitud');
        let index = tabla.rows.length;
        tabla.insertRow(-1).innerHTML = '<td><input id="txtCantidad' + index + '" style="width: 100%"></td><td><input id="txtDetalle' + index + '" style="width: 100%"></td><td><input type="button" value="x"></td>';
    }

    function agregarCorreo() {
        var correoProv = document.getElementById('cmbProveed').value;
        if (correoProv !== null && correoProv !== '') {
            let correos = document.getElementById('txtCorreos');
            correos.value = correos.value + correoProv + ';';
            document.getElementById('cmbProveed').value = '';
        } else {
            alert('Seleccione un proveedor');
        }
    }
    
    
    $('#formSolicitud').submit(function (e) {
        console.log('inicia la cargaaaa');
        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';

        e.preventDefault(); //no se envíe el submit todavía

        var form = $(this);
        var respuesta = form.children('.RespuestaAjax');

        var formdata = new FormData(this);
        
        //adjuntar los campos de la tabla a enviar
        let tabla = document.getElementById('tblDetSolicitud');
        
        formdata.append('registrosTabla', tabla.rows.length);
        
        for(i=1;i<tabla.rows.length;i++){
            //alert(tabla.rows[i].cells[0].innerHTML);
            let txtIdCantidad = 'txtCantidad'+i;
            let txtIdDetalle = 'txtDetalle'+i;
            let cant = document.getElementById(txtIdCantidad).value;
            let det = document.getElementById(txtIdDetalle).value;
            //
            
            formdata.append(txtIdCantidad, cant);
            formdata.append(txtIdDetalle, det);
        }
        

        $.ajax({
            type: 'POST',
            url: './acciones/guardarSolicitud.php',
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                LOADING.style = 'display: none;';
                console.log('fiiiinnn   successss');
                respuesta.html(data);
            },
            error: function (error) {
                LOADING.style = 'display: none;';
                console.log('fiiiinnn   errrroooorr');
                respuesta.html(error);
            }
        });
    });
    
    
</script>