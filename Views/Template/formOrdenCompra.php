<form id="frmOrdenCompra" action="acciones/guardarOrdenCompra.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
    <div>
        <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
    </div>
    <div class="mb-4">
        <div class="mb-2" style="font-size: 16px; text-align: center">
            <span class="control-label">CABECERA</span>
        </div>

        <div class="form-row">
            <div id="divUno" class="form-group col-md-<?php echo isset($token) ? '4' : '3' ?>">
                <label class="control-label btn-sm">C&Oacute;DIGO RC:</label>
                <input class="form-control btn-sm" value="<?php echo $solicitud->codigoRC; ?>"  id="txtCodigoRc" name="txtCodigoRc" type="text" placeholder="C&oacute;digo RC" required="" style="text-transform: uppercase;" 
                       <?php echo isset($token) ? 'readonly' : '' ?> >
            </div>
            <?php if (!isset($token)) { ?>
                <div id="btnBusqCot" class="form-group col-md-1" style="text-align: center; align-self: end;">
                    <button class="btn btn-primary btn-sm" style="width: 100%" type="button" onclick="buscarCotizacion()"><i class="fa fa-search"></i></button>
                </div>
            <?php } ?>
            <div class="form-group col-md-4">
                <label class="control-label btn-sm">FECHA:</label>
                <input class="form-control btn-sm" value="<?php echo date('d/m/Y'); ?>" readonly id="txtFecha" name="txtFecha" type="text" placeholder="Fecha actual" required="">
            </div>
            <div class="form-group col-md-4">
                <label class="control-label btn-sm">USUARIO:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->usuario; ?>" readonly id="txtUsuario" name="txtUsuario" type="text" placeholder="Nombre de usuario del proveedor" required="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="control-label btn-sm">RUC:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->ruc ?>" readonly id="txtRuc" name="txtRuc" type="text" placeholder="RUC del proveedor" required="" style="text-transform: uppercase;">
            </div>
            <div class="form-group col-md-8">
                <label class="control-label btn-sm">RAZ&Oacute;N SOCIAL:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->razonSocial ?>" readonly id="txtRazonSocial" name="txtRazonSocial" type="text" placeholder="Razón social del proveedor" required="" style="text-transform: uppercase;">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="control-label btn-sm">TEL&Eacute;FONO:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->telefono1 ?>" readonly id="txtTelefono" name="txtTelefono" type="text" placeholder="Tel&eacute;fono del proveedor" required="" style="text-transform: uppercase;">
            </div>
            <div class="form-group col-md-8">
                <label class="control-label btn-sm">DIRECCI&Oacute;N:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->direccion ?>" readonly id="txtDireccion" name="txtDireccion" type="text" placeholder="Direcci&oacute;n del proveedor" required="" style="text-transform: uppercase;">
            </div>
        </div>
        <input class="form-control btn-sm" hidden="" value="" readonly id="txtId" name="txtId" type="text" required="" >
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="btn-sm" >FORMA DE PAGO:</label>
                <?php require_once './acciones/listarFormasPago.php'; ?>
                <select class="form-control btn-sm" id="listFormaPago" name="listFormaPago" required="">
                    <option value="">Seleccione</option>
                    <?php
                    foreach ($listaFormasPago as $formaPago) {
                        echo '<option value="' . $formaPago->nombre . '">' . $formaPago->nombre . '</option>';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4"></div>
            <div class="form-group col-md-4"></div>
        </div>
    </div>
    <div style="font-size: 16px; text-align: center">
        <span class="control-label">DETALLE</span>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-sm">
            <thead>
                <tr style="font-weight: bold; font-size: 12px">
                    <th style="width:5%">CANTIDAD</th>
                    <th>PRODUCTO</th>
                    <th style="width:30%">DETALLES - OBSERVACIONES</th>
                    <th style="width:10%; text-align: center">APLICA IVA <br><input id="chkTodosIva" type="checkbox" onchange="toggle(this, <?php echo count($solicitud->listaDetalles); ?>)"></th>
                    <th style="width:10%">VALOR UNITARIO</th>
                    <th style="width:10%">VALOR TOTAL</th>
                </tr>
            </thead>
            <tbody id="tbodySol">
                <?php
                if(isset ($solicitud)){
                    $listaDetalles = $solicitud->listaDetalles;
                    if (isset($listaDetalles)) {
                        echo '<input id="registrosTabla" type="hidden" value="' . count($listaDetalles) . '">';
                        for ($i = 0; $i < count($listaDetalles); $i++) {
                            ?>
                            <tr>
                                <td style="text-align: center"><label id="lblCantidad<?php echo $i + 1 ?>"><?php echo $listaDetalles[$i]->cantidad ?></label></td>
                                <td><label id="lblDetalle<?php echo $i + 1 ?>"><?php echo $listaDetalles[$i]->detalle ?></label></td>
                                <td><input id="txtObservDetalle<?php echo $i + 1 ?>" style="width: 100%"></td>
                                <td style="text-align: center"><input id="chkIva<?php echo $i + 1 ?>" type="checkbox" onclick="valorTotal(<?php echo count($solicitud->listaDetalles); ?>);"></td>
                                <td style="text-align: end"><input type="number" id="txtValorUnitario<?php echo $i + 1 ?>" class="monto<?php echo $i + 1 ?>" onkeyup="valorTotalDetalle(<?php echo ($i + 1) . ', ' . count($solicitud->listaDetalles); ?>);" style="width: 100%; text-align: end;"></td>
                                <td style="text-align: end"><label id="lblValorTotal<?php echo $i + 1 ?>">0</label></td>
                            </tr>
                        <?php }
                    }
                }
                ?>
                <tr>
                    <td colspan="4"></td>
                    <td style="font-weight: bold; text-align: end">SUBTOTAL:</td>
                    <td style="text-align: end"><label id="lblSubtotal">0</label></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td style="font-weight: bold; text-align: end">SUBTOTAL SIN IVA:</td>
                    <td style="text-align: end"><label id="lblSubtotalSinIva">0</label></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td style="font-weight: bold; text-align: end">IVA:</td>
                    <td style="text-align: end"><label id="lblIva">0</label></td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td style="font-weight: bold; text-align: end">TOTAL:</td>
                    <td style="text-align: end"><label id="lblTotal">0</label></td>
                </tr>
            </tbody>
        </table>
        <div>
            <label class="control-label">Observaciones:</label>
            <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" placeholder="Observaciones" style="text-transform: uppercase;"></textarea>
        </div>
    </div>
    <br>
    <div style="text-align: center">
        <div class="form-row">
            <div class="form-group col-md-3" style="text-align:end; margin-top: 10px">
                <label for="exampleSelect1" id="lblListaEstado">Estado:</label>
            </div>
            <div class="form-group col-md-3 btn-sm">
                <select class="form-control" id="cbxListaEstado" name="cbxListaEstado" required="">
                    <option value="" disabled selected>Seleccione</option>
                    <option value="AUTORIZADO">Autorizar</option>
                    <option value="RECHAZADO">Rechazar</option>
                </select>
            </div>
            <div class="form-group col-md-3" style="text-align:end; margin-top:10px;">
                <label class="control-label btn-sm" id="lblRazonRechazo" style="display:none;">Razón rechazo:</label>
            </div>
            <div class="form-group col-md-3" style="margin-top:5px;">
                <input class="form-control btn-sm" id="txtRazonRechazo" name="txtRazonRechazo" type="text" placeholder="Raz&oacute;n del rechazo" required="" style="text-transform: uppercase; display:none;">
            </div>
        </div>
        <?php if (isset($token)) { ?>
        <button class="btn btn-primary" type="submit" id="btnGuarCot">
                <i class="fa fa-floppy-o"></i> Guardar y enviar</button>
<?php } ?>
        
        <button class="btn btn-primary" type="button" id="btnAutorizar" style="display: none" onclick="generarAutorizacion();">
                <i class="fa fa-floppy-o"></i> Guardar</button>
        
        <a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
    </div>
    <div class="RespuestaAjax" id="idRespuestaAjax"></div>
</form>

<script src="./Assets/js/functions_ordenes_compras.js"></script>