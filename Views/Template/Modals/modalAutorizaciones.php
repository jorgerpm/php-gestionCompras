<div class="modal fade" id="modalAutorizaciones" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 60%; ">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Autorizaciones orden de compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAutorizaciones" class="FormularioAjax login-form" action="" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
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
                            $listaUser = $userContr->listar_usuarios_activos(); ?>
                            <select class="form-control btn-sm" id="cmbUserList" name="cmbUserList">
                                <option value="">- Usuarios -</option>
                                <?php foreach ($listaUser as $userModal){ ?>
                                <option value="<?php echo $userModal->nombre.'#'.$userModal->id; ?>"><?php echo $userModal->nombre; ?></option>
                                <?php } ?>
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
                                    <th style="width: 5%"></th>
                                </tr>
                            </thead>
                            <tbody id="tbodyAutor">
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="tile-footer" style="text-align: end;">
                        <button id="btnActionForm" class="btn btn-primary" type="button">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                            <span id="btnText">Guardar</span>
                        </button>&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-secondary" href="#" data-dismiss="modal">
                            <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                    </div>
                    <div class="RespuestaAjax"></div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function abrirFormularioAut(val_datos) {
        document.getElementById('txtNumRCModal').value = val_datos.codigoRC;
        
        document.getElementById('txtEstadoModal').value = val_datos.estado;
        document.getElementById('txtValTotalModal').value = val_datos.total;
        document.getElementById('txtFechaOCModal').value = val_datos.fechaOrdenCompra;
        
        $('#modalAutorizaciones').modal('show');
    }
    
    function agregarUserModal(){
        var usuario = document.getElementById('cmbUserList').value;
        if (usuario !== null && usuario !== '') {
            
            
            var datuser = usuario.split("#"); //pos=0 es el nombre, en el 1 es el id del user
                    console.log(datuser);
            
            var tbody = document.getElementById('tbodyAutor');
            var index = tbody.rows.length; //este solo debe tener 4 maximo
            var fila = tbody.insertRow();
            
            var numRC = document.getElementById('txtNumRCModal').value;
            
            fila.insertCell().innerHTML = numRC;
            fila.insertCell().innerHTML = datuser[0] + '<input type="hidden" id="txtIdUserModal'+index+'" value="'+datuser[1]+'">';
            fila.insertCell().innerHTML = '<input id="' + index + '" type="button" value="x" onclick="eliminarFilaModal(this);" class="btn btn-secondary btn-sm fa">';
            
            document.getElementById('cmbUserList').value = '';
        } else {
            swal('','Seleccione un usuario de la lista.','warning');
        }
    }
    

    function eliminarFilaModal(input) {
        var tbody = document.getElementById('tbodyAutor');
        let index = input.id;
        tbody.deleteRow(index);
        for (i = 0; i < tbody.rows.length; i++) {
            tbody.rows[i].cells[1].children[0].id = "txtIdUserModal"+i;
            tbody.rows[i].cells[2].children[0].id = i;
        }

    }
</script>