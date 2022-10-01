<div class="modal fade" id="modalFormUsuario" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Nuevo Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formUsuario" action="" name="formUsuario" class="form-horizontal">
                    <input type="hidden" id="idUsuario" name="idUsuario" value="">
                    <p class="text-danger">Todos los campos son obligatorios.*</p>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Nombre</label>
                            <input class="form-control" id="txtNombre" name="txtNombre" type="text" placeholder="Nombre y apellido" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Usuario</label>
                            <input class="form-control" id="txtUsuario" name="txtUsuario" type="text" placeholder="Nombre de usuario" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label class="control-label">Clave</label>
                            <input class="form-control" id="txtClave" name="txtClave" type="password" placeholder="Clave" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="control-label">Correo</label>
                            <input class="form-control" id="txtCorreo" name="txtCorreo" type="text" placeholder="Correo electrónico" required="">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="listaRol">Rol</label>
                            <select class="form-control" id="listaRol" name="listaRol" required="">
                                <option value="1">Administrador</option>
                                <option value="2">Cliente</option>
                                <option value="3">Proveedor</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="listaEstado">Estado</label>
                            <select class="form-control" id="listaEstado" name="listaEstado" required="">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="tile-footer">
                        <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg
                        fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn
                        btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>