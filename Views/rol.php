<?php require_once 'Template/Modals/modalRol.php'; ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> Roles</h1>
            <p>Sección para editar y crear roles</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Tables</li>
            <li class="breadcrumb-item active"><a href="#">Data Table</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <div>
                            <p><button class="btn btn-primary btn-sm fa" type="button" onclick="openModalRole();"><i class="fas fa-plus-circle"></i> Nuevo</button></p>
                        </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once './Controllers/rolControlador.php';
                                foreach ($respuesta as $listaRol) { ?>
                                    <tr>
                                        <td><?php echo $listaRol->id ?></td>
                                        <td><?php echo $listaRol->nombre ?></td>
                                        <td><?php echo $listaRol->idEstado ?></td>
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