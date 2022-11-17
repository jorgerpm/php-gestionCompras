<?php include 'Template/Modals/modalAutorizaciones.php'; ?>

<?php include 'Template/Modals/modalOrdenCompra.php'; ?>
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Lista de ordenes de compra</span>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de ordenes de compra</a></li>
        </ul>
    </div>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    
                    <?php
                    $regsPagina = 10;
                    if(isset($_POST['txtRegsPagina'])){
                        $regsPagina = $_POST['txtRegsPagina'];
                    }
                    $cotContr = new ordenCompraControlador();
                    if (isset($_POST['btnSearch'])) {
                        $respuesta = $cotContr->listar_ordencompra_controlador($_POST, $regsPagina);
                    } else {
                        $respuesta = $cotContr->listar_ordencompra_controlador(null, $regsPagina);
                    }
                    
                    ?>
                    
                    <form id="formEstado" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width: 100%; padding: 0px"
                          action="" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
                        <div class="row" style="padding-top: 10px">
                            <div class="col-md-2 col-12" style="padding: 0px 5px 0px 5px">
                                <label class="control-label" for="dtFechaIni">Fecha desde:</label>
                                <input id="dtFechaIni" name="dtFechaIni" class="form-control btn-sm" type="date" value="<?php
                                if (isset($_POST['dtFechaIni'])) {
                                    echo $_POST['dtFechaIni'];
                                } else {
                                    echo date("Y-m-d");
                                }
                                ?>">
                            </div>
                            <div class="col-md-2 col-12" style="padding: 0px 5px 0px 0px">
                                <label class="control-label" for="dtFechaFin">Fecha hasta:</label>
                                <input id="dtFechaFin" name="dtFechaFin" class="form-control btn-sm" type="date" value="<?php
                                if (isset($_POST['dtFechaFin'])) {
                                    echo $_POST['dtFechaFin'];
                                } else {
                                    echo date("Y-m-d");
                                }
                                ?>">
                            </div>
                            <div class="col-md-3 col-12" style="padding: 0px 5px 0px 0px">
                                <label class="control-label" for="txtNumeroRC">C&oacute;digo RC:</label>
                                <input type="search" class="form-control btn-sm" id="txtNumeroRC" name="txtNumeroRC" value="<?php echo isset($_POST['txtNumeroRC']) ? $_POST['txtNumeroRC'] : '';?>">
                            </div>
                            <div class="col-md-2 col-12" style="padding: 0px 0px 0px 0px">
                                <label class="control-label" >&nbsp;</label>
                                <button style="width: 100%; " class="btn btn-primary " id="btnSearch" name="btnSearch" type="submit" ><i class="fa fa-search"></i><span id="btnText">Buscar</span></button>
                            </div>
                            <div class="col-md-1 col-12" ></div>
                            <div class="col-md-2 col-12" style="text-align: right">
                                <label class="control-label" >&nbsp;</label>
                                <button style="width: 100%;" class="btn btn-primary btn-sm" type="button" onclick="pruebaUno('facturas-data')"><i class="fa fa-file-excel-o"></i><span id="btnText">Exportar csv</span></button>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>
                        <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablaCotizaciones">
                            <thead>
                                <tr>
                                    <th style="width: 5%">Ver</th>
                                    <th style="width: 5%">Aut.</th>
                                    <th>Código RC</th>
                                    <th>Fecha orden de compra</th>
                                    <th>RUC proveedor</th>
                                    <th>Estado</th>
                                    <th>Subtotal</th>
                                    <th>Subtotal sin iva</th>
                                    <th>IVA</th>
                                    <th>Total</th>
                                    <!-- th>Usuario</th -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(count($respuesta)>0){
                                foreach ($respuesta as $ordenCompra) { ?>
                                    <tr>
                                        <td>
                                            <button class="btn btn-info fa fa-external-link" type="button" style="padding: 5px" title="Ver detalle OC"
                                                    onclick='abrirFormularioOrdenCompra(variableOC = <?php echo json_encode($ordenCompra); ?>)'></button>
                                        </td>
                                        
                                        <td>
                                            <button class="btn btn-info fa fa-id-card-o" type="button" style="padding: 5px" title="Autorizaciones OC"
                                                    onclick='abrirFormularioAut(variableOC = <?php echo json_encode($ordenCompra); ?>)'></button>
                                        </td>
                                        
                                        <td><?php echo $ordenCompra->codigoRC; ?></td>
                                        <td><?php echo date("d/m/Y H:i:s", $ordenCompra->fechaOrdenCompra / 1000); ?></td>
                                        <td><?php echo $ordenCompra->rucProveedor; ?></td>
                                        <td><?php echo $ordenCompra->estado; ?></td>
                                        <td><?php echo $ordenCompra->subtotal; ?></td>
                                        <td><?php echo $ordenCompra->subtotalSinIva; ?></td>
                                        <td><?php echo $ordenCompra->iva; ?></td>
                                        <td><?php echo $ordenCompra->total; ?></td>
                                        <!-- td>?php /*echo $ordenCompra->usuario;*/ ?></td -->
                                    </tr>
                                <?php }
                                } else{
                                    echo '<td colspan="10">No existen registros.</td>';
                                } ?>
                            </tbody>
                        </table>
                    </div>
                        <?php include 'Template/paginador.php'; ?>
                        </form>
                </div>
            </div>
        </div>
    </div>
</main>