<?php include 'Template/Modals/modalProducto.php'; ?>
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-cube"></i> Gestión de productos</span>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Administraci&oacute;n</li>
            <li class="breadcrumb-item active"><a href="#">Gesti&oacute;n productos</a></li>
        </ul>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div>
                        <p><button class="btn btn-primary btn-sm fa" type="button" onclick="openModalProducto(null);"><i class="fas fa-plus-circle"></i> Nuevo</button></p>
                    </div>
                    <div>
                        <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>C&oacute;digo</th>
                                    <th>C&oacute;digo producto</th>
                                    <th>Nombre</th>
                                    <th>Valor unitario</th>
                                    <th>¿Tiene IVA?</th>
                                    <th>Estado</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once './acciones/listarProductos.php';
                                foreach ($listaProductos as $producto) { ?>
                                    <tr>
                                        <td><?php echo $producto->id; ?></td>
                                        <td><?php echo $producto->codigoProducto; ?></td>
                                        <td><?php echo $producto->nombre; ?></td>
                                        <td><?php echo $producto->valorUnitario; ?></td>
                                        <td><?php echo ($producto->tieneIva == 1) ? "SÍ" : "NO" ?></td>
                                        <td><?php echo ($producto->idEstado == 1) ? "ACTIVO" : "INACTIVO"; ?></td>
                                        <td>
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <button class="btn btn-info fa fa-edit" type="button" onclick='openModalProducto(variableProducto = <?php echo json_encode($producto); ?>);'></button>
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
<script src="./Assets/js/functions_productos.js"></script>