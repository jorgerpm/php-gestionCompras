<?php require_once 'Template/Modals/modalRol.php'; ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Gestión de proveedores</h1>
            <p>crear y editar proveedores</p>
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
                                    <th>Código</th>
                                    <th>nombre</th>
                                    <th>ruc</th>
                                    <th>código JD</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once './Controllers/proveedorControlador.php';
                                foreach ($respuesta as $listaProveedor) { ?>
                                    <tr>
                                        <td><?php echo $listaProveedor->id ?></td>
                                        <td><?php echo $listaProveedor->nombre ?></td>
                                        <td><?php echo $listaProveedor->ruc ?></td>
                                        <td><?php echo $listaProveedor->codigoJD ?></td>
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