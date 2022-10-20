
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
                    <div class="row" style="padding-bottom: 5px">
                        <div class="col-md-2 col-sm-2 col-12">
                            <label>N&uacute;mero de RC</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-12">
                            <input class="form-control btn-sm">
                        </div>
                        <div class="col-md-2 col-sm-2 col-12">
                            <label>N&uacute;mero de Cotizaci&oacute;n</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-12">
                            <input class="form-control btn-sm">
                        </div>
                        <div class="col-md-2 col-sm-2 col-12">
                            <label>Fecha</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-12">
                            <input class="form-control btn-sm" type="date" value="<?php echo date("Y-m-d"); ?>">
                        </div>
                    </div>
                    
                    <div class="row" style="padding-bottom: 5px">
                        <div class="col-md-2 col-sm-2 col-12">
                            <label>Proveedor</label>
                        </div>
                        <div class="col-md-2 col-sm-2 col-12">
                            <select class="form-control" contenteditable="true">
                                <option class="menuRol" value="" >-Proveedores-</option>
                                <option class="menuRol" value="" >PROVEEDOR UNO</option>
                                <option class="menuRol" value="" >PROVEEDOR DOS</option>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-2 col-12">
                            <button class="btn btn-primary btn-sm fa" type="button" >
                                <i class="fa fa-plus"></i></button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-2 col-sm-2 col-12">
                            <label>Lista de correos</label>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <input class="form-control btn-sm">
                        </div>
                        <div class="col-md-4 col-sm-4 col-12"></div>
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
                        <table class="table table-hover table-bordered" id="tblDetSolicitud">
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
                                <tr>
                                    <td>
                                        <input style="width: 100%">
                                    </td>
                                    <td>
                                        <input style="width: 100%">
                                    </td>
                                    <td>
                                        <input type="button" value="x">
                                    </td>
                                </tr>
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
                        <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" placeholder="Observaciones"></textarea>
                    </div>

                    <br>
                    <div style="text-align: center">
                        <button class="btn btn-primary btn-sm fa" type="button" >
                            <i class="fa fa-floppy-o"></i> Guardar y enviar</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<script src="./Assets/js/functions_ordenServicioProducto.js"></script>

<script>
    function agregarFila(){
        let tabla = document.getElementById('tblDetSolicitud');
        tabla.insertRow(-1).innerHTML = '<td><input></td><td><input style="width: 100%"></td><td><input type="button" value="x"></td>';
    }
</script>