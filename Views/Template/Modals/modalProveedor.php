<div class="modal fade" id="modalFormProveedor" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Gesti&oacute;n de proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formProveedor" class="FormularioAjax login-form" action="acciones/guardarProveedor.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" id="idProveedor" name="idProveedor" value="">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">C&oacute;digo JD:</label>
                            <input class="form-control" id="txtCodigoJD" name="txtCodigoJD" type="text" placeholder="C&oacute;digo JD del proveedor" style="text-transform: uppercase;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label" for="txtRuc">RUC:</label>
                            <input class="form-control" id="txtRuc" name="txtRuc" type="number" placeholder="Ruc del proveedor" required="" style="text-transform: uppercase;">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Raz&oacute;n social:</label>
                            <input class="form-control" id="txtRazonSocial" name="txtRazonSocial" type="text" placeholder="Raz&oacute;n social del proveedor" required="" style="text-transform: uppercase;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Nombre comercial:</label>
                            <input class="form-control" id="txtNombreComercial" name="txtNombreComercial" type="text" placeholder="Nomber comercial del proveedor" style="text-transform: uppercase;">
                        </div>
                    </div>
                    
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Contacto:</label>
                            <input class="form-control" id="txtContacto" name="txtContacto" type="text" required="" style="text-transform: uppercase;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Correo:</label>
                            <input class="form-control" id="txtCorreo" name="txtCorreo" type="email" placeholder="CORREO DEL PROVEEDOR" required="">
                        </div>
                    </div>
                    
                    
                    <div class="form-group">
                        <label class="control-label">Direcci&oacute;n:</label>
                        <input class="form-control" id="txtDireccion" name="txtDireccion" type="text" placeholder="Direcci&oacute;n del proveedor" required="" style="text-transform: uppercase;">
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Tel&eacute;fono 1:</label>
                            <input class="form-control" id="txtTelefono1" name="txtTelefono1" type="number" placeholder="Tel&eacute;fono 1 del proveedor" required="" style="text-transform: uppercase;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Tel&eacute;fono 2:</label>
                            <input class="form-control" id="txtTelefono2" name="txtTelefono2" type="number" placeholder="Tel&eacute;fono 2 del proveedor" style="text-transform: uppercase;">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Contacto contabilidad:</label>
                            <input class="form-control" id="txtContabilidad" name="txtContabilidad" type="text" required="" style="text-transform: uppercase;">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Tel&eacute;fono contabilidad:</label>
                            <input class="form-control" id="txtTelefonoContabilidad" name="txtTelefonoContabilidad" type="text" style="text-transform: uppercase;">
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Correo contabilidad:</label>
                            <input class="form-control" id="txtCorreoContabilidad" name="txtCorreoContabilidad" type="email" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="listaEstado">Estado:</label>
                            <?php require_once './acciones/listarEstados.php'; ?>
                            <select class="form-control" id="cbxListaEstado" name="cbxListaEstado" required="">
                                <?php
                                foreach ($listaEstados as $estado) {
                                    echo '<option value="' . $estado->id . '">' . $estado->nombre . '</option>';
                                }
                                ?>
                            </select>
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