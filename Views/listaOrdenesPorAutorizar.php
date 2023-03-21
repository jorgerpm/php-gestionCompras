<?php include 'Template/Modals/modalOrdenCompra.php'; ?>
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Ordenes de compra pendientes de autorizaci&oacute;n</span>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Ordenes pendientes de autorizaci&oacute;n</a></li>
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
                        $respuesta = $cotContr->listar_ordenes_autorizar_controlador($_POST, $regsPagina);
                    } else {
                        $respuesta = $cotContr->listar_ordenes_autorizar_controlador(null, $regsPagina);
                    }
                    
                    ?>
                    
                    <form id="formEstado" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width: 100%; padding: 0px"
                          action="" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
                        <div class="row" style="padding-top: 10px">
                            <div class="col-md-1 col-12" style="padding: 0px 0px 0px 10px">
                                <label class="control-label" for="txtNumeroRC">C&oacute;digo RC:</label>
                            </div>
                            <div class="col-md-2 col-12" >
                                <input class="form-control" type="search" id="txtNumeroRC" name="txtNumeroRC" value="<?php echo isset($_POST['txtNumeroRC']) ? $_POST['txtNumeroRC'] : '';?>" style="text-transform: uppercase;">
                            </div>
                            
                            <div class="col-md-1 col-12" style="padding: 0px 0px 0px 10px">
                                <label class="control-label" for="txtNumeroSolB">C&oacute;digo solicitud:</label>
                            </div>
                            <div class="col-md-2 col-12" >
                                <input class="form-control" type="search" id="txtNumeroSolB" name="txtNumeroSolB" value="<?php echo isset($_POST['txtNumeroSolB']) ? $_POST['txtNumeroSolB'] : '';?>" style="text-transform: uppercase;">
                            </div>
                            
                            <div class="col-md-2 col-12" style="padding: 0px 0px 0px 0px; text-align: left">
                                <button class="btn btn-primary " id="btnSearch" name="btnSearch" type="submit" ><i class="fa fa-search"></i><span id="btnText">Buscar</span></button>
                            </div>
                            <div class="col-md-4 col-12" ></div>
                        </div>
                        <div class="RespuestaAjax"></div>
                        <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablaCotizaciones" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 5%">Ver</th>
                                    <th>Fecha orden de compra</th>
                                    <th>Código solicitud</th>
                                    <th>Código RC</th>
                                    <th>Estado</th>
                                    <th>Usuario autoriza</th>
                                    <th>Unidad de negocio</th>
                                    <th>RUC proveedor</th>
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
                                                    onclick='abrirFormularioOrdenCompra(variableOC = <?php echo json_encode($ordenCompra); ?>, varRolAuto = <?php echo ($_SESSION['Rol']->id == 1) ? 1 : ( ($_SESSION['Rol']->autorizador == "") ? 0 : 1); ?>)'></button>
                                        </td>
                                        <td><?php echo date("d/m/Y H:i:s", $ordenCompra->fechaOrdenCompra / 1000); ?></td>
                                        <td><?php echo $ordenCompra->codigoSolicitud; ?></td>
                                        <td><?php echo $ordenCompra->codigoRC; ?></td>
                                        <td><?php echo $ordenCompra->estado; ?></td>
                                        <td><?php echo $ordenCompra->autorizador; ?></td>
                                        <td><?php echo $ordenCompra->unidadNegocioRC; ?></td>
                                        <td><?php echo $ordenCompra->rucProveedor; ?></td>
                                        <td style="text-align: end;"><?php echo number_format($ordenCompra->subtotal, 4); ?></td>
                                        <td style="text-align: end;"><?php echo number_format($ordenCompra->subtotalSinIva, 4); ?></td>
                                        <td style="text-align: end;"><?php echo number_format($ordenCompra->iva, 4); ?></td>
                                        <td style="text-align: end;"><?php echo number_format($ordenCompra->total, 4); ?></td>
                                        <!-- td><?php /*echo $ordenCompra->usuario;*/ ?></td -->
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