<?php include 'Template/Modals/solicitudModal.php'; ?>
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Lista de solicitudes</span>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Lista de solicitudes</a></li>
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
                    $solContr = new solicitudControlador();
                    if (isset($_POST['btnSearch'])) {
                        $respuesta = $solContr->listar_solicitud_controlador($_POST, $regsPagina);
                    } else {
                        $respuesta = $solContr->listar_solicitud_controlador(null, $regsPagina);
                    }
                    
                    ?>
                    
                    <form id="formEstado" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width: 100%; padding: 0px"
                          action="" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
                        <div class="row" style="padding-top: 10px">
                            <div class="col-md-2 col-12" style="padding: 0px 5px 0px 5px">
                                <label class="btn-sm" for="dtFechaIni">Fecha desde:</label>
                                <input id="dtFechaIni" name="dtFechaIni" class="form-control btn-sm" type="date" value="<?php
                                if (isset($_POST['dtFechaIni'])) {
                                    echo $_POST['dtFechaIni'];
                                } else {
                                    echo date("Y-m-d");
                                }
                                ?>">
                            </div>
                            <div class="col-md-2 col-12" style="padding: 0px 5px 0px 0px">
                                <label class="btn-sm" for="dtFechaFin">Fecha hasta:</label>
                                <input id="dtFechaFin" name="dtFechaFin" class="form-control btn-sm" type="date" value="<?php
                                if (isset($_POST['dtFechaFin'])) {
                                    echo $_POST['dtFechaFin'];
                                } else {
                                    echo date("Y-m-d");
                                }
                                ?>">
                            </div>
                            <div class="col-md-3 col-12" style="padding: 0px 5px 0px 0px">
                                <label class="btn-sm" for="txtNumeroRC">C&oacute;digo RC:</label>
                                <input class="form-control btn-sm" id="txtNumeroRC" name="txtNumeroRC" value="<?php echo isset($_POST['txtNumeroRC']) ? $_POST['txtNumeroRC'] : ''; ?>">
                            </div>
                            <div class="col-md-2 col-12" style="padding: 0px 0px 0px 0px">
                                <button style="width: 100%; position:absolute; right:0;bottom:0;" class="btn btn-primary btn-sm fa" id="btnSearch" name="btnSearch" type="submit" ><i class="fa fa-search"></i><span id="btnText">Buscar</span></button>
                            </div>
                            <div class="col-md-1 col-12" ></div>
                            <div class="col-md-2 col-12" style="text-align: right">
                                <button style="width: 100%;position:absolute; right:0;bottom:0;" class="btn btn-primary btn-sm fa" type="button" onclick="pruebaUno('facturas-data')"><i class="fa fa-file-excel-o"></i><span id="btnText">Exportar csv</span></button>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>
                        <br>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="tablaSolicitudes">
                            <thead>
                                <tr>
                                    <th style="width: 5%"></th>
                                    <th>Código de RC</th>
                                    <th>Fecha solicitud</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                if(count($respuesta)>0){
                                foreach ($respuesta as $solicitud) { ?>
                                    <tr>
                                        <td>
                                            <button class="btn btn-info fa fa-external-link" type="button" style="padding: 5px" 
                                                    onclick='abrirFormulario(variableSolicitud = <?php echo json_encode($solicitud); ?>)'></button>
                                        </td>
                                        <td><?php echo $solicitud->codigoRC; ?></td>
                                        <td><?php echo date("d/m/Y H:i:s", $solicitud->fechaSolicitud / 1000); ?></td>
                                        <td><?php echo $solicitud->estado; ?></td>
                                        <td><?php echo $solicitud->usuario; ?></td>
                                    </tr>
                                <?php }
                                } else{
                                    echo '<td colspan="5">No existen registros.</td>';
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
