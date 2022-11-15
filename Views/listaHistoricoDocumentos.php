
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Hist&oacute;rico de documentos</span>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Hist&oacute;rico de documentos</a></li>
        </ul>
    </div>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    
                    <?php
                    $regsPagina = 100;
                    if(isset($_POST['txtRegsPagina'])){
                        $regsPagina = $_POST['txtRegsPagina'];
                    }
                    $histContr = new historicoDocumentoControlador();
                    if (isset($_POST['btnSearch'])) {
                        $respuesta = $histContr->listar_historico_controlador($_POST, $regsPagina);
                    } 
                    ?>
                    
                    <form id="formHistorial" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width: 100%; padding: 0px"
                          action="" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
                        <div class="row" style="padding-top: 10px">
                            <div class="col-md-3 col-12" style="padding: 0px 5px 0px 10px">
                                <label class="btn-sm" for="txtNumeroRC">C&oacute;digo RC:</label>
                                <input class="form-control btn-sm" id="txtNumeroRC" name="txtNumeroRC" value="<?php echo isset($_POST['txtNumeroRC']) ? $_POST['txtNumeroRC'] : '';?>">
                            </div>
                            
                            <div class="col-md-3 col-12" style="padding: 0px 5px 0px 0px">
                                <label class="btn-sm" for="txtTipoDocumento">Documento:</label>
                                
                                <select class="form-control btn-sm" id="txtTipoDocumento" name="txtTipoDocumento">
                                    <option value="">- Seleccione un documento -</option>
                                    <option value="COTIZACION" <?php echo (isset($_POST['txtTipoDocumento']) && $_POST['txtTipoDocumento'] == "COTIZACION") ? "selected" : '';?> >COTIZACI&Oacute;N</option>
                                    <option value="ORDEN_COMPRA" <?php echo (isset($_POST['txtTipoDocumento']) && $_POST['txtTipoDocumento'] == "ORDEN_COMPRA") ? "selected" : '';?> >ORDEN DE COMPRA</option>
                                    <option value="SOLICITUD" <?php echo (isset($_POST['txtTipoDocumento']) && $_POST['txtTipoDocumento'] == "SOLICITUD") ? "selected" : '';?> >SOLICITUD</option>
                                </select>
                            </div>
                            
                            <div class="col-md-2 col-12" style="padding: 0px 0px 0px 0px">
                                <button style="width: 100%; position:absolute; right:0;bottom:0;" class="btn btn-primary btn-sm fa" id="btnSearch" name="btnSearch" type="submit" ><i class="fa fa-search"></i><span id="btnText">Buscar</span></button>
                            </div>
                            <div class="col-md-4 col-12" ></div>
                        </div>
                        <div class="RespuestaAjax"></div>
                        <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablaHistoricos">
                            <thead>
                                <tr>
                                    <th>Código RC</th>
                                    <th>Fecha</th>
                                    <th>Documento</th>
                                    <th>Estado</th>
                                    <th>Total</th>
                                    <th>Usuario</th>
                                    <th>Observaci&oacute;n</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(isset($respuesta) && count($respuesta)>0){
                                foreach ($respuesta as $historial) { ?>
                                    <tr>
                                        <td><?php echo $historial->codigoRC; ?></td>
                                        <td><?php echo date("d/m/Y H:i:s", $historial->fechaCambio / 1000); ?></td>
                                        <td><?php echo $historial->documento == "ORDEN_COMPRA" ? "ORDEN DE COMPRA" : $historial->documento ?></td>
                                        <td><?php echo $historial->estado; ?></td>
                                        <td><?php echo $historial->valorTotal; ?></td>
                                        <td><?php echo $historial->usuarioCambio; ?></td>
                                        <td><?php echo $historial->observacion; ?></td>
                                        
                                    </tr>
                                <?php }
                                } else{
                                    echo '<td colspan="7">No existen registros.</td>';
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