<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Formulario por cotizaci&oacute;n</span>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">Formulario por cotizaci&oacute;n</a></li>
        </ul>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div>
                        <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
                    </div>
                    <div class="mb-4">
                        <div class="mb-2" style="font-size: 20px; text-align: center">
                            <span class="control-label">CABECERA</span>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">C&Oacute;DIGO RC:</label>
                                <input class="form-control btn-sm" value="1HL2G4" disabled id="txtCodigoRc" name="txtCodigoRc" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">C&Oacute;DIGO DE SOLICITUD:</label>
                                <input class="form-control btn-sm" value="123456789001" disabled id="txtCodigoCotizacion" name="txtCodigoCotizacion" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">FECHA:</label>
                                <input class="form-control btn-sm" value="<?php echo date('d-m-Y'); ?>" disabled id="txtFecha" name="txtFecha" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">RUC:</label>
                                <input class="form-control btn-sm" value="1234567890001" disabled id="txtRuc" name="txtRuc" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-8">
                                <label class="control-label btn-sm">RAZ&Oacute;N SOCIAL:</label>
                                <input class="form-control btn-sm" value="123456789001" disabled id="txtRazonSocial" name="txtRazonSocial" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">TEL&Eacute;FONO:</label>
                                <input class="form-control btn-sm" value="0987654321" disabled id="txtTelefono" name="txtTelefono" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-8">
                                <label class="control-label btn-sm">DIRECCI&Oacute;N:</label>
                                <input class="form-control btn-sm" value="0912345678" disabled id="txtDireccion" name="txtDireccion" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">TIEMPO DE ENTREGA:</label>
                                <input class="form-control btn-sm" value="3 DÍAS" id="txtTiempoEntrega" name="txtTiempoEntrega" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">VALIDEZ COTIZACI&Oacute;N:</label>
                                <input class="form-control btn-sm" value="1 MES" id="txtValidezCotizacion" name="txtValidezCotizacion" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="btn-sm" for="exampleSelect1">Forma de pago:</label>
                                <?php require_once './acciones/listarFormasPago.php'; ?>
                                <select class="form-control btn-sm" id="listFormaPago" name="listFormaPago" required="">
                                    <?php
                                    foreach ($listaFormasPago as $formaPago) {
                                        echo '<option value="' . $formaPago->id . '">' . $formaPago->nombre . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div style="font-size: 20px; text-align: center">
                        <span class="control-label">DETALLE</span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr style="font-weight: bold;">
                                    <th style="width:5%">CANTIDAD</th>
                                    <th>PRODUCTO</th>
                                    <th style="width:30%">DETALLES</th>
                                    <th style="width:10%">VALOR UNITARIO</th>
                                    <th style="width:10%">VALOR TOTAL</th>
                                </tr>
                            </thead>
                                <tr>
                                    <td>4</td>
                                    <td>FUNDAS DE CAFE MINERVA</td>
                                    <td><input style="width: 100%"></td>
                                    <td style="text-align: end"><input style="width: 100%"></td>
                                    <td style="text-align: end"><input style="width: 100%"></td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td style="font-weight: bold; text-align: end">SUBTOTAL:</td>
                                    <td style="font-weight: bold; text-align: end">341.00</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td style="font-weight: bold; text-align: end">IVA:</td>
                                    <td style="font-weight: bold; text-align: end">3.60</td>
                                </tr>
                                <tr>
                                    <td colspan="3"></td>
                                    <td style="font-weight: bold; text-align: end">TOTAL:</td>
                                    <td style="font-weight: bold; text-align: end">344.60</td>
                                </tr>
                            </tbody>
                        </table>
                        <div>
                            <label class="control-label">Observaciones:</label>
                            <textarea class="form-control" id="txtObservaciones" name="txtObservaciones" placeholder="Observaciones"></textarea>
                        </div>
                    </div>
                    <br>
                    <div style="text-align: center">
                        <button class="btn btn-primary btn-sm fa" type="button" >
                            <i class="fa fa-floppy-o"></i> Guardar y enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>