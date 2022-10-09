<main class="app-content">
    <div class="app-title">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-dashboard"></i> Búsquedas de los archivos xml</span>
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
                <div class="table-responsive">
                    <?php
                    //require_once './acciones/listarArchivos.php';
                    $archiCont = new archivoXmlControlador();
                    if(isset($_POST['btnSearch'])){
                        $respuesta = $archiCont->listar_archivos_controlador($_POST);
                    } else{
                        $respuesta = $archiCont->listar_archivos_controlador(null);
                    }
                        $columns = $archiCont->crear_columnas($respuesta);
                    ?>
                    <a  data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                        Columnas a mostrar:
                    </a>
                    <div class="collapse" style="overflow: scroll;" id="collapseExample">
                        <div class="btn-group" data-toggle="buttons">
                            <?php foreach ($columns as $index => $col) {
                                echo '<label class="toggle-vis btn btn-primary active" data-column="' . $index . '">';
                                echo '<input type="checkbox" checked>';
                                echo '<a >' . $col . '</a>';
                                echo '</label>';
                            } ?>
                        </div>
                    </div>
                    
                    
                    <form id="formEstado" class="login-form" action="" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                        <div class="row" style="padding-top: 20px">
                            <div class="col-md-3 col-12">
                                <label>USUARIOS:</label>
                                <?php require_once './acciones/listarUsuarios.php'; ?>
                                <select class="form-control" id="listUsers" name="listUsers" required="">
                                    <?php
                                    foreach ($listaUsuarios as $user) {
                                        echo '<option value="' . $user->id . '">' . $user->nombre . '</option>';
                                    }?>
                                </select>
                            </div>
                            <div class="col-md-3 col-12">
                                <label>DESDE:</label>
                                <input id="dtFechaIni" name="dtFechaIni" class="form-control" type="date" >
                            </div>
                            <div class="col-md-3 col-12">
                                <label>HASTA:</label>
                                <input id="dtFechaFin" name="dtFechaFin" class="form-control" type="date" >
                            </div>
                            <div class="col-md-3 col-12" style="padding-top: 30px">
                                <button class="btn btn-primary" id="btnSearch" name="btnSearch" type="submit" ><i class="fa fa-search"></i><span id="btnText">Buscar</span></button>
                            </div>
                        </div>
                        <div class="RespuestaAjax"></div>
                    </form>
                    
                    <br>
                    
                    <table id="sampleTableXml" class="display table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <?php foreach ($columns as $col) { ?>
                                    <th><?php echo $col; ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($respuesta as $listaArchivoXml) { ?>
                                <tr>
                                    <td><?php echo $listaArchivoXml->estado ?></td>
                                    <td><?php echo $listaArchivoXml->numeroAutorizacion ?></td>
                                    <td><?php echo date("d-m-Y", $listaArchivoXml->fechaAutorizacion/1000) ?></td>
                                    <td><?php echo $listaArchivoXml->ambiente ?></td>

                                    <?php
                                    $listvarj = json_decode($listaArchivoXml->comprobante);
// print_r($listvarj);
                                    $docum = null;
                                    if (isset($listvarj->factura)) {
                                        $docum = $listvarj->factura;
                                    }
                                    if ($docum != null) {
                                        foreach ($docum->infoTributaria as $key => $val) {
                                            echo "<td>";
                                            print_r($val);
                                            echo "</td>";
                                        }
                                        foreach ($docum->infoFactura as $key => $val) {
                                            if (!isset($val->pago) && !isset($val->totalImpuesto)) {
                                                echo "<td>";
                                                print_r($val);
                                                echo "</td>";
                                            }
                                        }
                                    }
                                    ?>


            <!--td><?php /* echo $listaArchivoXml->comprobante */ ?></td-->

                                        <!--td><php echo $listaArchivoXml->xmlBase64 ?></td>
                                        <td><php echo $listaArchivoXml->pdfBase64 ?></td-->
                                    <td><?php echo $listaArchivoXml->idUsuarioCarga ?></td>
                                    <!--td><php echo $listaArchivoXml->ubicacionArchivo ?></td-->
                                    <td><?php echo $listaArchivoXml->tipoDocumento ?></td>
                                    <td><?php echo $listaArchivoXml->idProveedor ?></td>
                                    <td><a href="<?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoXml ?>"><?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoXml ?></a></td>
                                    <td>
                                        <?php if($listaArchivoXml->nombreArchivoPdf != null){?>
                                            <a href="<?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoPdf ?>"><?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoPdf ?></a>
                                        <?php }?>
                                    </td>


                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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
    var table = $('#sampleTableXml').DataTable({
//        scrollY: '34vh',
//        scrollCollapse: true,
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por pagina',
            zeroRecords: 'No existen registros',
            info: 'Mostrando pagina _PAGE_ de _PAGES_',
            infoEmpty: 'No existen registros',
            infoFiltered: '(filtrados de los _MAX_ registros totales)',
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

<!-- <script type="text/javascript">
      //este es el metodo que lo mantendra actualizado 
        $(document).ready(function() {
          var refreshId =  setInterval( function(){
         $('#tablaControl').load('archivoXml');//actualizas el div
      }, 40000 );
    });
</script>
tablas dinámicas: https://www.youtube.com/watch?v=52niJ-2TrQ0 -->