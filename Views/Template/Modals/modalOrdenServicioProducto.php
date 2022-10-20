<div class="modal fade" id="modalFormOrdenServicioProducto" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">lista de productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formOrdenServicioProducto" class="FormularioAjax login-form" action="acciones/guardarProducto.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    <div class="table-responsive mb-4">
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>C&oacute;digo</th>
                                    <th>C&oacute;digo producto</th>
                                    <th>Nombre</th>
                                    <th>Valor unitario</th>
                                    <th>¿Tiene IVA?</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once './acciones/listarProductos.php';
                                foreach ($listaProductos as $producto) { ?>
                                    <tr>
                                        <td><input type="checkbox"></td>
                                        <td><?php echo $producto->id; ?></td>
                                        <td><?php echo $producto->codigoProducto; ?></td>
                                        <td><?php echo $producto->nombre; ?></td>
                                        <td><?php echo $producto->valorUnitario; ?></td>
                                        <td><?php echo ($producto->tieneIva == 1) ? "SÍ" : "NO" ?></td>
                                        <td><?php echo ($producto->idEstado == 1) ? "ACTIVO" : "INACTIVO"; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="tile-footer" style="text-align: end;">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg
                                                                                            fa-plus-circle"></i><span id="btnText">Agregar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn
                                                                                             btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                    <!--<div class="RespuestaAjax"></div>-->
                </form>
            </div>
        </div>
    </div>
</div>