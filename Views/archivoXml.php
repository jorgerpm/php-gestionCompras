<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Gestión de archivos Xml</h1>
            <p>crear y editar archivos Xml</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Cargar Xml</a></li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tile">
            <div class="tile-body">
                <div class="table-responsive">
                    <div>
        Columnas a filtrar:<br> <a class="toggle-vis" data-column="0">Estado</a> - <a class="toggle-vis" data-column="1">Número de autorización</a> 
    </div>
                    <?php
                    require_once './Controllers/archivoXmlControlador.php';
//                        print_r($respuesta[0]);
                    ?>
                    <table id="sampleTableXml" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Estado</th>
                                <th>Número de autorización</th>
                                <th>Fecha de autorización</th>
                                <th>Ambiente</th>

                                <?php
                                $listvarj = json_decode($respuesta[0]->comprobante);
                                $docum = null;
                                if(isset($listvarj->factura)){
                                    $docum = $listvarj->factura;
                                }
// print_r($listvarj);
                                foreach ($docum->infoTributaria as $key => $val) {
                                    echo "<th>";
                                    print_r($key);
                                    echo "</th>";
                                }
                                foreach ($docum->infoFactura as $key => $val) {
                                    if (!isset($val->pago) && !isset($val->totalImpuesto)) {
                                        echo "<th>";
                                        print_r($key);
                                        echo "</th>";
                                    }
                                }
                                ?>
                                <!-- th>Comprobante</th -->

                                <!--th>Xml base 64</th>
                                <th>Pdf base 64</th -->
                                <th>Usuario</th>
                                <!-- th>Ubicación archivo</th -->
                                <th>Tipo de documento</th>
                                <th>Proveedor</th>
                                <th>Url del archivo xml</th>
                                <th>Url del archivo RIDE</th>
                                <!-- th>Nombre del archivo xml</th>
                                <th>Nombre del archivo pdf</th -->
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($respuesta as $listaArchivoXml) { ?>
                                <tr>
                                    <td><?php echo $listaArchivoXml->estado ?></td>
                                    <td><?php echo $listaArchivoXml->numeroAutorizacion ?></td>
                                    <td><?php echo $listaArchivoXml->fechaAutorizacion ?></td>
                                    <td><?php echo $listaArchivoXml->ambiente ?></td>

                                    <?php
                                    $listvarj = json_decode($listaArchivoXml->comprobante);
// print_r($listvarj);
                                    $docum = null;
                                    if(isset($listvarj->factura)){
                                        $docum = $listvarj->factura;
                                    }
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
                                    ?>


        <!--td><?php /* echo $listaArchivoXml->comprobante */ ?></td-->

                                    <!--td><php echo $listaArchivoXml->xmlBase64 ?></td>
                                    <td><php echo $listaArchivoXml->pdfBase64 ?></td-->
                                    <td><?php echo $listaArchivoXml->idUsuarioCarga ?></td>
                                    <!--td><php echo $listaArchivoXml->ubicacionArchivo ?></td-->
                                    <td><?php echo $listaArchivoXml->tipoDocumento ?></td>
                                    <td><?php echo $listaArchivoXml->idProveedor ?></td>
                                    <td><a href="<?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoXml ?>"><?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoXml ?></a></td>
                                    <td><a href="<?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoPdf ?>"><?php echo $listaArchivoXml->urlArchivo . "/" . $listaArchivoXml->nombreArchivoPdf ?></a></td>
                                    
                                   
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
    $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();
 
        // Get the column API object
        var column = table.column($(this).attr('data-column'));
 
        // Toggle the visibility
        column.visible(!column.visible());
    });
    </script>
