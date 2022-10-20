<?php include 'Template/Modals/modalOrdenServicioProducto.php'; ?>
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-pagelines"></i> Orden Servicio-Producto</span>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">Orden servicio-producto</a></li>
        </ul>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-borderless" id="sampleTable">
                            <tbody>
                                <tr>
                                    <td>
                                        <label class="control-label">Num requisici&oacute;n:</label>
                                        <input class="form-control" id="txtNumRequisicion" name="txtNumRequisicion" type="text" placeholder="N&uacute;mero de requisición">
                                    </td>
                                    <td>
                                        <label class="control-label">Suc/planta:</label>
                                        <input class="form-control" id="txtSucPlanta" name="txtSucPlanta" type="text" placeholder="Sucursal de planta">
                                    </td>
                                    <td>
                                        <label class="control-label">Entrega:</label>
                                        <input class="form-control" id="txtEntrega" name="txtEntrega" type="text" placeholder="Entrega">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                        <label class="control-label">Encarg:</label>
                                        <input class="form-control" id="txtEncarg" name="txtEncarg" type="date" placeholder="Fecha de encargo">
                                    </td>
                                    <td>
                                        <label class="control-label">Flete:</label>
                                        <input class="form-control" id="txtFlete" name="txtFlete" type="text" placeholder="Flete">
                                    </td>
                                    <td>
                                        <label class="control-label">Cod. moneda:</label>
                                        <input class="form-control" id="txtCodMoneda" name="txtCodMoneda" type="text" placeholder="C&oacute;digo de moneda">
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                        <label class="control-label">Solicitado:</label>
                                        <input class="form-control" id="txtSolicitado" name="txtSolicitado" type="date" placeholder="Fecha de solicitud">
                                    </td>
                                    <td>
                                        <label class="control-label">Orden tomada por:</label>
                                        <input class="form-control" id="txtOrdenTomadaPor" name="txtOrdenTomadaPor" type="text" placeholder="Nombre del responsable de tomar la orden">
                                    </td>
                                    <td>
                                        <label class="control-label">Mon. base:</label>
                                        <input class="form-control" id="txtMonBase" name="txtMonBase" type="text" placeholder="Mon base">
                                    </td>
                                 </tr>
                            </tbody>
                        </table>
                        <div>
                            <p><button class="btn btn-primary btn-sm fa" type="button" onclick="openModalOrdenServicioProducto();"><i class="fas fa-search"></i> Buscar</button></p>
                        </div>
                        <div>
                            <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
                        </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>L&iacute;nea</th>
                                    <th>Cantidad</th>
                                    <th>C&oacute;digo producto</th>
                                    <th>Descripci&oacute;n</th>
                                    <th>Precio unitario</th>
                                    <th>Precio total</th>
                                    <th>Fecha solicitud</th>
                                    <th>N° orden</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once './acciones/listarProductos.php';
                                foreach ($listaProductos as $producto) { ?>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                        <div>
                            <label class="control-label">Observaciones:</label>
                            <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" placeholder="Observaciones"></textarea>
                        </div>
                        <div>
                            <label class="control-label">Tot ord:</label>
                            <input class="form-control" id="txtTotOrd" type="text" name="txtTotOrd" placeholder="Valor total de orden">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="./Assets/js/functions_ordenServicioProducto.js"></script>