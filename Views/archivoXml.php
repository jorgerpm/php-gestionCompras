<?php require_once 'Template/Modals/modalRol.php'; ?>
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
                            <p><button class="btn btn-primary btn-sm fa" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button></p>
                        </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Estado</th>
                                    <th>Número de autorización</th>
                                    <th>Fecha de autorización</th>
                                    <th>Ambiente</th>
                                    <th>Comprobante</th>
                                    <th>Xml base 64</th>
                                    <th>Pdf base 64</th>
                                    <th>Usuario</th>
                                    <th>Ubicación archivo</th>
                                    <th>Url del archivo</th>
                                    <th>Proveedor</th>
                                    <th>Nombre del archivo xml</th>
                                    <th>Nombre del archivo pdf</th>
                                    <th>Tipo de documento</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once './Controllers/archivoXmlControlador.php';
                                foreach ($respuesta as $listaArchivoXml) { ?>
                                    <tr>
                                        <td><?php echo $listaArchivoXml->estado ?></td>
                                        <td><?php echo $listaArchivoXml->numeroAutorizacion ?></td>
                                        <td><?php echo $listaArchivoXml->fechaAutorizacion ?></td>
                                        <td><?php echo $listaArchivoXml->ambiente ?></td>
                                        <td><?php echo $listaArchivoXml->comprobante ?></td>
                                        <td><?php echo $listaArchivoXml->xmlBase64 ?></td>
                                        <td><?php echo $listaArchivoXml->pdfBase64 ?></td>
                                        <td><?php echo $listaArchivoXml->idUsuarioCarga ?></td>
                                        <td><?php echo $listaArchivoXml->ubicacionArchivo ?></td>
                                        <td><a href="<?php echo $listaArchivoXml->urlArchivo ?>"><?php echo $listaArchivoXml->urlArchivo ?></a></td>
                                        <td><?php echo $listaArchivoXml->idProveedor ?></td>
                                        <td><?php echo $listaArchivoXml->nombreArchivoXml ?></td>
                                        <td><?php echo $listaArchivoXml->nombreArchivoPdf ?></td>
                                        <td><?php echo $listaArchivoXml->tipoDocumento ?></td>
                                        <td>
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <button class="btn btn-info fa fa-edit" type="button"></button>
                                            </div>
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