<div class="modal fade" id="modalAutorizaciones" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60%; ">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Autorizaciones orden de compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAutorizaciones" class="FormularioAutorizadores login-form" action="acciones/guardarAutorizadores.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
                    <input type="hidden" value="" id="txtIdOrdenCompra" name="txtIdOrdenCompra">
                    
                    <div class="row" >
                        <div class="col-md-2">
                            <label class="control-label btn-sm">N&uacute;mero RC</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px">
                            <input class="form-control btn-sm" readonly="" id="txtNumRCModal" name="txtNumRCModal">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label btn-sm">Fecha orden de compra</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px">
                            <input class="form-control btn-sm" readonly="" id="txtFechaOCModal" name="txtFechaOCModal">
                        </div>
                        <div class="col-md-2">
                            <label class="control-label btn-sm">Valor total</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px 10px 0px 0px">
                            <input class="form-control btn-sm" readonly="" id="txtValTotalModal" name="txtValTotalModal">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <label class="control-label btn-sm">Usuarios</label>
                        </div>
                        <div class="col-md-4" style="padding: 0px">
                            <?php $userContr = new usuarioControlador(); 
                            $listaUser = $userContr->listar_usuarios_rol_autorizador(); ?>
                            <select class="form-control btn-sm" id="cmbUserList" name="cmbUserList">
                                <option value="">- Usuarios -</option>
                                <?php foreach ($listaUser as $userModal){ 
                                    if($userModal->idRol != 2) {?>
                                <option value="<?php echo $userModal->nombre.'#'.$userModal->id; ?>"><?php echo $userModal->nombre; ?></option>
                                    <?php }
                                    } ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-primary btn-sm fa" type="button" onclick="agregarUserModal();">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                        <div class="col-md-2">
                            <label class="control-label btn-sm">Estado</label>
                        </div>
                        <div class="col-md-2" style="padding: 0px 10px 0px 0px">
                            <input class="form-control btn-sm" readonly="" id="txtEstadoModal" name="txtEstadoModal">
                        </div>
                    </div>
                    <div style="text-align: center">
                        <hr>
                        <label class="control-label"><strong>Autorizadores</strong></label>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr>
                                    <th>N&uacute;mero RC</th>
                                    <th>Usuario</th>
                                    <th>Estado</th>
                                    <th style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyAutor">
                                
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
                    <div class="RespuestaAjax"></div>
                    
                    <input type="hidden" id="txtEliminaUser" name="txtEliminaUser">
                    
                </form>
            </div>
        </div>
    </div>
</div>



<script src="./Assets/js/functions_autorizaciones.js"></script>
