<?php include 'Template/Modals/modalComparativo.php'; ?>

<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Lista de comparativos</span>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de comparativos</a></li>
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
                    $cotContr = new comparativoControlador();
                    if (isset($_POST['btnSearch'])) {
                        $respuesta = $cotContr->listar_comparativos_controlador($_POST, $regsPagina);
                    } else {
                        $respuesta = $cotContr->listar_comparativos_controlador(null, $regsPagina);
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
                            <div class="col-md-2 col-12" style="padding: 0px 5px 0px 0px">
                                <label class="control-label" for="txtNumeroRC">C&oacute;digo RC:</label>
                                <input type="search" class="form-control btn-sm" id="txtNumeroRC" name="txtNumeroRC" value="<?php echo isset($_POST['txtNumeroRC']) ? $_POST['txtNumeroRC'] : '';?>" style="text-transform: uppercase;">
                            </div>
                            
                            <div class="col-md-2 col-12" style="padding: 0px 5px 0px 0px">
                                <label class="control-label" for="txtNumeroSol">C&oacute;digo solicitud:</label>
                                <input type="search" class="form-control btn-sm" id="txtNumeroSol" name="txtNumeroSol" value="<?php echo isset($_POST['txtNumeroSol']) ? $_POST['txtNumeroSol'] : '';?>" style="text-transform: uppercase;">
                            </div>
                            
                            <div class="col-md-1 col-12" style="padding: 0px 0px 0px 0px">
                                <label class="control-label" >&nbsp;</label>
                                <button style="width: 100%; " class="btn btn-primary btn-sm" id="btnSearch" name="btnSearch" type="submit" ><i class="fa fa-search"></i><span id="btnText">Buscar</span></button>
                            </div>
                            <div class="col-md-1 col-12"></div>
                            <div class="col-md-2 col-12" style="text-align: right">
                                <label class="control-label" >&nbsp;</label>
                                <button style="width: 100%;" class="btn btn-primary btn-sm" type="button" onclick="pruebaUno('facturas-data')"><i class="fa fa-file-excel-o"></i><span id="btnText">Exportar csv</span></button>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>
                        <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablaCotizaciones" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 5%">Ver</th>
                                    <th>Fecha comparativo</th>
                                    <th>Código solicitud</th>
                                    <th>Código RC</th>
                                    <th>Estado</th>
                                    <th>Proveedor seleccionado</th>
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
                                foreach ($respuesta as $comparativo) { ?>
                                    <tr>
                                        <td>
                                            <button class="btn btn-info fa fa-external-link" type="button" style="padding: 5px" title="Ver detalle comparativo"
                                                    onclick='abrirModalComparativo(variableComp = <?php echo json_encode($comparativo); ?>)'></button>
                                        </td>
                                        
                                        <td><?php echo date("d/m/Y H:i:s", $comparativo->fechaComparativo / 1000); ?></td>
                                        <td><?php echo $comparativo->codigoSolicitud; ?></td>
                                        <td><?php echo $comparativo->listaDetalles[0]->cotizacion->codigoRC; ?></td>
                                        <td><?php echo $comparativo->estado; ?></td>
                                        
                                        <?php 
                                            foreach($comparativo->listaDetalles as $detalle){
                                                if($detalle->seleccionada){
                                                    echo '<td>'.$detalle->proveedorDto->razonSocial.'</td>';
                                                    
                                                    echo '<td style="text-align: end;">'.number_format($detalle->cotizacion->subtotal, 2).'</td>';
                                                    echo '<td style="text-align: end;">'.number_format($detalle->cotizacion->subtotalSinIva, 2).'</td>';
                                                    echo '<td style="text-align: end;">'.number_format($detalle->cotizacion->iva, 2).'</td>';
                                                    echo '<td style="text-align: end;">'.number_format($detalle->cotizacion->total, 2).'</td>';
                                                }
                                            }
                                            ?>
                                        
                                        
                                        <!-- td>?php /*echo $comparativo->usuario;*/ ?></td -->
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

<script src="./Assets/js/functions_comparativo.js"></script>