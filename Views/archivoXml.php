<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Consultar facturas</span>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Consultar facturas</a></li>
        </ul>
    </div>
</div>
<div class="row espacio">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div >
                    <?php
                    //require_once './acciones/listarArchivos.php';
                    $regsPagina = 3;
                    $archiCont = new archivoXmlControlador();
                    if (isset($_POST['btnSearch'])) {
                        $respuesta = $archiCont->listar_archivos_controlador($_POST, $regsPagina);
                    } else {
                        $respuesta = $archiCont->listar_archivos_controlador(null, $regsPagina);
                    }
                    $columns = $archiCont->crear_columnas($respuesta);
                    ?>
                    <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Columnas a mostrar:
                    </a>
                    <div class="collapse" style="overflow: scroll;" id="collapseExample">
                        <div class="btn-group" data-toggle="buttons">
                            <?php
                            foreach ($columns as $index => $col) {
                                echo '<label class="toggle-vis btn btn-primary active" data-column="' . $index . '">';
                                echo '<input type="checkbox" checked>';
                                echo '<a >' . $col['col'] . '</a>';
                                echo '</label>';
                            }
                            ?>
                        </div>
                    </div>


                    <form id="formEstado" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer" style="width: 100%; padding: 0px"
                          action="" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                        
                        <div class="row" style="padding-top: 10px">
                            <div class="col-md-3 col-12" style="padding: 0px 5px 0px 8px">
                                <label class="btn-sm" for="listUsers">Usuario:</label>
                                <?php require_once './acciones/listarUsuarios.php'; ?>
                                <select style="position:absolute; right:0;bottom:0;" class="form-control disable-selection btn-sm" id="listUsers" name="listUsers" <?php echo ($_SESSION['Rol']->principal == 0) ? "" : "" ?>>
                                    <?php if ($_SESSION['Rol']->principal == 1) { ?>
                                        <option value="">Seleccione</option>;
                                    <?php } ?>
                                    <?php
                                    foreach ($listaUsuarios as $user) {
                                        if ($_SESSION['Rol']->principal == 1) {
                                            echo '<option value="' . $user->id . '" ' . ((isset($_POST['listUsers']) && $_POST['listUsers'] == $user->id) ? 'selected' : '') . '>' . $user->nombre . '</option>';
                                        } else {
                                            if ($_SESSION['Usuario']->id == $user->id) {
                                                echo '<option value="' . $user->id . '" ' . ((isset($_POST['listUsers']) && $_POST['listUsers'] == $user->id) ? 'selected' : '') . '>' . $user->nombre . '</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-2 col-12" style="padding: 0px 5px 0px 5px">
                                <label class="btn-sm" for="dtFechaIni">Fecha emisi&oacute;n desde:</label>
                                <input id="dtFechaIni" name="dtFechaIni" class="form-control btn-sm" type="date" value="<?php
                                if (isset($_POST['dtFechaIni'])) {
                                    echo $_POST['dtFechaIni'];
                                } else {
                                    echo date("Y-m-d");
                                }
                                ?>">
                            </div>
                            <div class="col-md-2 col-12" style="padding: 0px 5px 0px 0px">
                                <label class="btn-sm" for="dtFechaFin">Fecha emisi&oacute;n hasta:</label>
                                <input id="dtFechaFin" name="dtFechaFin" class="form-control btn-sm" type="date" value="<?php
                                if (isset($_POST['dtFechaFin'])) {
                                    echo $_POST['dtFechaFin'];
                                } else {
                                    echo date("Y-m-d");
                                }
                                ?>">
                            </div>
                            <div class="col-md-2 col-12" style="padding: 0px 0px 0px 0px">
                                <button style="width: 100%; position:absolute; right:0;bottom:0;" class="btn btn-primary btn-sm fa" id="btnSearch" name="btnSearch" type="submit" ><i class="fa fa-search"></i><span id="btnText">Buscar</span></button>
                            </div>
                            <div class="col-md-1 col-12" ></div>
                            <div class="col-md-2 col-12" style="text-align: right">
                                <button style="width: 100%;position:absolute; right:0;bottom:0;" class="btn btn-primary btn-sm fa" type="button" onclick="exportTableToCSV('facturas-data')"><i class="fa fa-file-excel-o"></i><span id="btnText">Exportar csv</span></button>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>


                        <br>
                        <!-- aqui poner las filas a mostrar -->
                        <div class="row">
                            <div class="col-3 col-sm-1 col-md-1" style="padding-left: 8px">
                                <label>Mostrar </label>
                            </div>
                            <div class="col-3 col-sm-1 col-md-1" style="padding: 0px 0px 5px 0px">
                                <select name="cmbRegsPagina" id="cmbRegsPagina" aria-controls="sampleTable" class="form-control form-control-sm" onchange="cambiarRegsPagina(this)">
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                </select>
                            </div>
                            <div class="col-6 col-sm-3 col-md-3" style="padding: 0px">
                                <label>registros por página</label>
                            </div>
                        </div>


                        <div class="table-responsive">
                            <table id="sampleTableXml" class="table table-hover table-bordered" style="width:100%">
                                <thead>
                                    <tr>
<?php foreach ($columns as $col) { ?>
                                            <th style="width: <?php echo $col['wid']; ?>;"><?php echo $col['col']; ?></th>
                                    <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
<?php
if (count($respuesta) > 0) {
    foreach ($respuesta as $listaArchivoXml) {
        ?>
                                    <tr>
                                        <td style="white-space: nowrap;"><?php echo $listaArchivoXml->nombreUsuario ?></td>
                                        <td style="white-space: nowrap;"><?php echo date("d/m/Y", $listaArchivoXml->fechaEmision / 1000) ?></td>
                                        <td style="white-space: nowrap;"><?php echo date("d/m/Y", $listaArchivoXml->fechaAutorizacion / 1000) ?></td>
                                        <td style="white-space: nowrap;"><?php echo $listaArchivoXml->estado ?></td>
                                        <td style="white-space: nowrap;"><?php echo $listaArchivoXml->numeroAutorizacion ?></td>
                                        <td style="white-space: nowrap;"><?php echo $listaArchivoXml->ambiente ?></td>

                                        <?php
                                        $listvarj = json_decode($listaArchivoXml->comprobante);
// print_r($listvarj);
                                        $docum = null;
                                        if (isset($listvarj->factura)) {
                                            $docum = $listvarj->factura;
                                        }
                                        if ($docum != null) {
                                            $valores = [];

                                            for ($ind = 6; $ind < (count($columns) - 4); $ind++) {
                                                $coincide = false;
                                                foreach ($docum->infoTributaria as $key => $val) {
                                                    if ($columns[$ind]['col'] == $key) {
                                                        array_push($valores, $val);
                                                        $coincide = true;
                                                        break;
                                                    }
                                                }
                                                if ($coincide) {

                                                } else {
                                                    foreach ($docum->infoFactura as $key => $val) {
                                                        if (!isset($val->pago) && !isset($val->totalImpuesto)) {
                                                            if ($columns[$ind]['col'] == $key) {
                                                                array_push($valores, $val);
                                                                $coincide = true;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    if ($coincide) {

                                                    } else {
                                                        array_push($valores, ' - ');
                                                    }
                                                }
                                            }

                                            foreach ($valores as $vals) {
                                                echo '<td style="white-space: nowrap;">';
                                                print_r($vals);
                                                echo "</td>";
                                            }
                                        }
                                        ?>


                    <!--td><?php /* echo $listaArchivoXml->comprobante */ ?></td-->

                                                <!--td><php echo $listaArchivoXml->xmlBase64 ?></td>
                                                <td><php echo $listaArchivoXml->pdfBase64 ?></td-->                                    
                                            <!--td><php echo $listaArchivoXml->ubicacionArchivo ?></td-->
                                        <td style="white-space: nowrap;"><?php echo $listaArchivoXml->tipoDocumento ?></td>
                                        <td style="white-space: nowrap;"><?php echo $listaArchivoXml->idProveedor ?></td>
                                        <td style="white-space: nowrap;"><a target="_blank" href="<?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoXml ?>"><?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoXml ?></a></td>
                                        <td style="white-space: nowrap;">
<?php if ($listaArchivoXml->nombreArchivoPdf != null) { ?>
                                                <a target="_blank" href="<?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoPdf ?>"><?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoPdf ?></a>
                                    <?php } ?>
                                        </td>


                                    </tr>
                                        <?php
                                    }
                                } else {
                                    echo '<tr><td colspan="10">No existen registros.</td><tr>';
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
<?php include 'Template/paginador.php'; ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="./Assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./Assets/js/plugins/dataTables.bootstrap.min.js"></script>

<script type="text/javascript">
    var table = $('#sampleTableXml1').DataTable({
//        scrollY: '34vh',
//        scrollCollapse: true,
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por p&aacute;gina',
            zeroRecords: 'No existen registros',
            info: 'Mostrando p&aacute;gina _PAGE_ de _PAGES_',
            infoEmpty: 'No existen registros',
            infoFiltered: '(filtrados de los _MAX_ registros totales)',
            search: 'Filtrar',
        },
        lengthMenu: [
            [10, 25, 50, 100],
            [10, 25, 50, 100],
        ],
    });
    $('.toggle-vis').on('click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column($(this).attr('data-column'));

        // Toggle the visibility
        column.visible(!column.visible());
    });


</script>

