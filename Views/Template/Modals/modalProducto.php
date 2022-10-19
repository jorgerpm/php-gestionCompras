<div class="modal fade" id="modalFormProducto" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Gesti&oacute;n de producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formProducto" class="FormularioAjax login-form" action="acciones/guardarProducto.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" id="idProducto" name="idProducto" value="">
                    <p class="text-danger">Todos los campos son obligatorios.*</p>
                    <div class="form-group">
                        <label class="control-label">C&oacute;digo producto:</label>
                        <input class="form-control" id="txtCodigoProducto" name="txtCodigoProducto" type="text" placeholder="C&oacute;digo del producto" required="" style="text-transform: uppercase;">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Nombre:</label>
                            <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Valor unitario:</label>
                            <input class="form-control" id="txtValorUnitario" name="txtValorUnitario" type="number" min="0" value="0" step="0.01" title="Currency" pattern="^\d+(?:\.\d{1,2})?$" placeholder="Valor unitario del producto" required="" style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleSelect1">Estado:</label>
                            <?php require_once './acciones/listarEstados.php'; ?>
                            <select class="form-control" id="listStatus" name="listStatus" required="">
                                <?php
                                foreach ($listaEstados as $estado) {
                                    echo '<option value="' . $estado->id . '">' . $estado->nombre . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">¿Tiene IVA?:</label>
                            <div class="toggle">
                                <label>
                                    <input type="checkbox" name="chkTieneIva" id="chkTieneIva"><span class="button-indecator"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="tile-footer" style="text-align: end;">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg
                                                                                            fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn
                                                                                             btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                    <div class="RespuestaAjax"></div>
                </form>
            </div>
        </div>
    </div>
</div>