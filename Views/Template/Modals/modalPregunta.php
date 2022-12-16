<div class="modal fade" id="modalPregunta" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Gesti&oacute;n de preguntas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formPregunta" class="FormularioAjax login-form" action="acciones/guardarPregunta.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" id="idPregunta" name="idPregunta" value="">
                    <p class="text-danger">Todos los campos son obligatorios.*</p>
                    <div class="form-group">
                        <label class="control-label">Pregunta:</label>
                        <input class="form-control" id="txtPregunta" name="txtPregunta" type="text" required="" style="text-transform: uppercase;">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Rol:</label>
                        
                        <?php $rolContr = new rolControlador(); 
                            $listaRoles = $rolContr->roles_check_list_controlador(); ?>
                            <select class="form-control" id="listRoles" name="listRoles" required="">
                                <option value="">- Seleccione -</option>
                                <?php
                                foreach ($listaRoles as $rol) {
                                    echo '<option value="' . $rol->id . '">' . $rol->nombre . '</option>';
                                }
                                ?>
                            </select>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleSelect1" class="control-label">Estado:</label>
                            <?php require_once './acciones/listarEstados.php'; ?>
                            <select class="form-control" id="listStatus" name="listStatus" required="">
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