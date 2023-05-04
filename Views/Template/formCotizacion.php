<form id="frmCotizacion" action="acciones/guardarCotizacion.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
    <div>
        <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
    </div>
    <div class="mb-4">
        <div class="mb-2" style="font-size: 16px; text-align: center">
            <span class="control-label">CABECERA</span>
        </div>
        <input type="hidden" id="txtIdCot" name="txtIdCot" value="">
        <div class="form-row">
            <div id="divUno" class="form-group col-md-<?php echo isset($token) ? '3' : '2' ?>">
                <label class="control-label btn-sm">C&Oacute;DIGO SOLICITUD:</label>
                <input class="form-control btn-sm" value="<?php echo isset($token) ? $solicitud->codigoSolicitud : (isset($_GET['txtCodSol']) ? $_GET['txtCodSol'] : ''); ?>"  id="txtCodSol" name="txtCodSol" type="text" required="" style="text-transform: uppercase;"
                       <?php echo isset($token) ? 'readonly' : '' ?> >
            </div>
            <?php if (!isset($token)) { ?>
                <div id="btnBusqCot" class="form-group col-md-1" style="text-align: center; align-self: end;">
                    <button class="btn btn-primary btn-sm" style="width: 100%" type="button"  id="btnBuscarSolicitud" name="btnBuscarSolicitud"
                            onclick="<?php echo $_SESSION['Rol']->id == 2 ? 'buscarSolicitudPorNumeroSol();' : 'buscarSolicitudPorNumeroSol();'; ?>">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
            <?php } ?>
            
            <div class="form-group col-md-3">
                <label class="control-label btn-sm">C&Oacute;DIGO COTIZACI&Oacute;N:</label>
                <input class="form-control btn-sm" value="<?php echo isset($token) ? ($solicitud->codigoSolicitud . '-' . $proveedor->ruc) : ''; ?>" readonly id="txtCodigoCotizacion" name="txtCodigoCotizacion" type="text" placeholder="C&oacute;digo cotizaci&oacute;n" required="" style="text-transform: uppercase;">
            </div>
            
            <div class="form-group col-md-3">
                <label class="control-label btn-sm">C&Oacute;DIGO RC:</label>
                <input class="form-control btn-sm" value="<?php echo isset($solicitud->codigoRC) ? $solicitud->codigoRC : null; ?>" readonly id="txtCodigoRc" name="txtCodigoRc" type="text" placeholder="C&oacute;digo RC" required="" style="text-transform: uppercase;" >
            </div>
            <div class="form-group col-md-3">
                <label class="control-label btn-sm">FECHA:</label>
                <input class="form-control btn-sm" value="<?php echo date('d/m/Y'); ?>" readonly id="txtFecha" name="txtFecha" type="text" placeholder="Fecha actual" required="">
            </div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-<?php echo (isset($token) || $_SESSION['Rol']->id == 2) ? '3' : '2' ?>">
                <label class="control-label btn-sm">RUC:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->ruc ?>" id="txtRuc" name="txtRuc" type="text" placeholder="RUC del proveedor" required="" style="text-transform: uppercase;"
                       <?php echo $_SESSION['Rol']->id == 2 ? 'readonly' : '' ?>>
            </div>
            
            <?php if (!isset($token) && $_SESSION['Rol']->id != 2) { ?>
                <div id="btnBusqProvv" class="form-group col-md-1" style="text-align: center; align-self: end;">
                    <button class="btn btn-primary btn-sm" style="width: 100%" type="button" onclick="buscarProvPorRuc()"><i class="fa fa-search"></i></button>
                </div>
            <?php } ?>
            
            <div class="form-group col-md-6">
                <label class="control-label btn-sm">RAZ&Oacute;N SOCIAL:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->razonSocial ?>" readonly id="txtRazonSocial" name="txtRazonSocial" type="text" placeholder="Razón social del proveedor" required="" style="text-transform: uppercase;">
            </div>
            <div class="form-group col-md-3">
                <label class="control-label btn-sm">TEL&Eacute;FONO:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->telefono1 ?>" readonly id="txtTelefono" name="txtTelefono" type="text" placeholder="Tel&eacute;fono del proveedor" required="" style="text-transform: uppercase;">
            </div>
        </div>
        <div class="form-row">
            
            <div class="form-group col-md-3">
                <label class="control-label btn-sm">E-MAIL:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->correo ?>" readonly id="txtCorreo" name="txtCorreo" type="text" required="" >
            </div>
            
            <div class="form-group col-md-6">
                <label class="control-label btn-sm">DIRECCI&Oacute;N:</label>
                <input class="form-control btn-sm" value="<?php echo $proveedor->direccion ?>" readonly id="txtDireccion" name="txtDireccion" type="text" placeholder="Direcci&oacute;n del proveedor" required="" style="text-transform: uppercase;">
            </div>
            <div class="form-group col-md-3"></div>
        </div>
        <div class="form-row">
            <div class="form-group col-md-4">
                <label class="control-label btn-sm">TIEMPO DE ENTREGA:</label>
                <select class="form-control btn-sm" id="txtTiempoEntrega" name="txtTiempoEntrega" required="">
                    <option value="">Seleccione</option>
                    <?php for ($i = 1; $i <= 60; $i++) { ?>
                        <option value="<?php echo $i . ($i == 1 ? " D&Iacute;A" : " D&Iacute;AS"); ?>"><?php echo $i . ($i == 1 ? " D&Iacute;A" : " D&Iacute;AS"); ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label class="control-label btn-sm">VALIDEZ COTIZACI&Oacute;N:</label>
                <input class="form-control btn-sm" value="" id="txtValidezCotizacion" name="txtValidezCotizacion" type="text" placeholder="Validez de la cotizaci&oacute;n" required="" style="text-transform: uppercase;">
            </div>
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
                    <th style="width:8%; text-align: center;">ARCHIVO</th>
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
                                <td><input id="txtObservDetalle<?php echo $i + 1 ?>" style="width: 100%; text-transform: uppercase"></td>
                                <td style="text-align: center;">
                                    <?php if(isset($listaDetalles[$i]->pathArchivo)){ ?>
                                    <a href="<?php echo $listaDetalles[$i]->pathArchivo; ?>" target="_blank">
                                        <i class="fa fa-fw fa-lg fa-download"></i>
                                    </a>
                                    <?php } ?>
                                    
                                </td>
                                <td style="text-align: center"><input id="chkIva<?php echo $i + 1 ?>" type="checkbox" onclick="valorTotal(<?php echo count($solicitud->listaDetalles); ?>);"></td>
                                <td style="text-align: end"><input type="number" id="txtValorUnitario<?php echo $i + 1 ?>" class="monto<?php echo $i + 1 ?>" onkeyup="valorTotalDetalle(<?php echo ($i + 1) . ', ' . count($solicitud->listaDetalles); ?>);" style="width: 100%; text-align: end;" lang="en" min="0.00" step="any" required=""></td>
                                <td style="text-align: end"><label id="lblValorTotal<?php echo $i + 1 ?>">0</label></td>
                            </tr>
                        <?php }
                    }
                }
                ?>
                <tr>
                    <td colspan="5"></td>
                    <td style="font-weight: bold; text-align: end">SUBTOTAL:</td>
                    <td style="text-align: end"><label id="lblSubtotal">0</label></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td style="font-weight: bold; text-align: end">SUBTOTAL SIN IVA:</td>
                    <td style="text-align: end"><label id="lblSubtotalSinIva">0</label></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td style="font-weight: bold; text-align: end">IVA:</td>
                    <td style="text-align: end"><label id="lblIva">0</label></td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td style="font-weight: bold; text-align: end">TOTAL:</td>
                    <td style="text-align: end"><label id="lblTotal">0</label></td>
                </tr>
            </tbody>
        </table>
        </div>
        <div class="mb-3">
            <label class="control-label">Observaciones solicitud:</label>
            <textarea class="form-control" id="txtobssol" name="txtobssol" style="text-transform: uppercase;" readonly="" ><?php echo isset($solicitud) ? $solicitud->observacion : ""; ?></textarea>
        </div>
        <div class="mb-3">
            <label class="control-label">Rubros adicionales:</label>
            <input class="form-control" type="text" id="txtRubrosAdicionales" name="txtRubrosAdicionales" placeholder="Rubros adicionales" style="text-transform: uppercase;">
        </div>
        <div>
            <label class="control-label">Observaciones proveedor:</label>
            <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" placeholder="Observaciones" style="text-transform: uppercase;"></textarea>
        </div>
    
    <br>
    <?php if($_SESSION['Rol']->id != 2){ ?>
    <div class="form-row" style="border: solid 1px graytext; display: none" id="divEstado">
        <div class="form-group col-md-1" style="padding-top: 10px">
            <label class="control-label" id="lblListaEstado">Estado:</label>
        </div>
        <div class="form-group col-md-3" style="padding-top: 10px">
            <select class="form-control" id="cbxListaEstado" name="cbxListaEstado" >
                <option value="" selected>- Seleccione -</option>
                <option value="ANULADO">ANULAR</option>
            </select>
        </div>
        <div class="form-group col-md-2" style="padding-top: 10px">
            <label class="control-label" id="lblRazonRechazo" style="display:none;">Razón anulaci&oacute;n:</label>
        </div>
        <div class="form-group col-md-5" style="padding-top: 10px">
            <input class="form-control" id="txtRazonRechazo" name="txtRazonRechazo" type="text" style="text-transform: uppercase; display:none;">
        </div>
        <div class="form-group col-md-1" style="padding-top: 10px; padding-left: 0px">
            <button class="btn-primary btn-sm fa" type="button" id="btnCambEst" style="display: none" onclick="cambiarEstadoCotizacion();">
                Guardar</button>
        </div>
    </div>
    <br>
    <?php } ?>
    
    <div style="text-align: center">
        <?php if (isset($token) || isset ($_GET['txtCodSol'])) { ?>
            <button class="btn btn-primary" type="submit" id="btnGuarCot">
                <i class="fa fa-floppy-o"></i> Guardar y enviar</button>
        <?php } ?>
        <?php if($_SESSION['Rol']->id != 2){ ?>
        
        <?php } ?>
        <a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
        
        <?php /*if($_SESSION['Rol']->id != 2){*/ ?>
        &nbsp;&nbsp;&nbsp;
        <button class="btn btn-secondary" type="button" onclick="ejecutarReportePdf('COTIZACION', document.querySelector('#txtIdCot').value);" >
            <i class="fa fa-fw fa-lg fa-print"></i>
            <span id="btnText">Imprimir</span>
        </button>
        <?php /*}*/ ?>
        
    </div>
    <div class="RespuestaAjax" id="idRespuestaAjax"></div>
</form>

<script src="./Assets/js/functions_cotizaciones.js"></script>