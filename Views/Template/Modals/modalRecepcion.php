<div class="modal fade" id="modalRecepcion" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 70%; ">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Generar check-list de recepci&oacute;n</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formRecepciones" class="FormularioRecepciones login-form" action="acciones/generarCheckListRecepcion.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">

                    <input type="hidden" value="" id="txtIdOrdenCompraRecep" name="txtIdOrdenCompraRecep">

                    <div class="row" >
                        <div class="col-md-2">
                            <label class="control-label btn-sm">N&uacute;mero RC</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px">
                            <input class="form-control btn-sm" readonly="" id="txtNumRCRecep" name="txtNumRCRecep">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label btn-sm">Fecha orden de compra</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px">
                            <input class="form-control btn-sm" readonly="" id="txtFechaOCRecep" name="txtFechaOCRecep">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label btn-sm">Valor total</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px 10px 0px 0px">
                            <input class="form-control btn-sm" readonly="" id="txtValTotalRecep" name="txtValTotalRecep">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label btn-sm">Usuarios</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px">
                            <?php $rolContr = new rolControlador();
                            $listaRoles = $rolContr->roles_check_list_controlador();
                            ?>
                            <select class="form-control btn-sm" id="cmbRolListRecep" name="cmbRolListRecep" onchange="buscarUserRol(this);">
                                <option value="">- Roles -</option>
                                <?php foreach ($listaRoles as $rolModal) { ?>
                                    <option value="<?php echo $rolModal->id; ?>"><?php echo $rolModal->nombre; ?></option>
<?php } ?>
                            </select>
                        </div>

                        <div id="divCmbUsers" class="col-md-2" style="padding: 0px;">
                            <select class="form-control btn-sm"><option value="">- Usuarios -</option></select>
                        </div>
                        
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label btn-sm">Estado</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px 10px 0px 0px">
                            <input class="form-control btn-sm" readonly="" id="txtEstadoRecep" name="txtEstadoRecep">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-2" style="padding: 0px;">
                            <div class="row" style="">
                                <div class="col-md-9" style="text-align: right">
                                    <label class="control-label" style="margin-top: 5px">Campos bodega?:</label>
                                </div>
                                <div class="col-md-3" style="padding: 0px">
                                    <input id="chkCampoBodega" name="chkCampoBodega" class="form-control-sm" type="checkbox" >
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" >
                            <div class="row" style="">
                                <div class="col-md-10" style="padding-right: 0px;">
                                    <label style=" margin-top: 5px">Fecha aprobaci&oacute;n:</label>
                                </div>
                                <div class="col-md-2" style="padding: 0px">
                                    <input id="chkFechaAprob" name="chkFechaAprob" class="form-control-sm" type="checkbox" style="padding: 0px">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm fa" type="button" onclick="agregarUserCheckList();">
                                &nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;
                            </button>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="col-md-2">
                        </div>
                    </div>

                    <div style="text-align: center">
                        <hr>
                        <label class="control-label"><strong>Lista de usuarios</strong></label>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>Rol</th>
                                    <th>Usuario</th>
                                    <th>Correo</th>
                                    <th style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyRecep">

                            </tbody>
                        </table>
                    </div>
                    <div class="tile-footer" style="text-align: end;">
                        <button id="btnActionForm" class="btn btn-primary" type="submit">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                            <span id="btnText">Guardar</span>
                        </button>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="#" data-dismiss="modal">
                            <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                    <div class="RespuestaAjaxRecep"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="./Assets/js/functions_checkListRecepcion.js"></script>
