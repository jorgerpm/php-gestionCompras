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
                        <?php require_once './acciones/buscarProveedorRuc.php'; ?>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">C&Oacute;DIGO RC:</label>
                                <input class="form-control btn-sm" value="" disabled id="txtCodigoRc" name="txtCodigoRc" type="text" placeholder="C&oacute;digo RC" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">FECHA:</label>
                                <input class="form-control btn-sm" value="<?php echo date('d/m/y'); ?>" disabled id="txtFecha" name="txtFecha" type="text" placeholder="Fecha actual" required="">
                            </div>
                            <div class="form-group col-md-4">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">RUC:</label>
                                <input class="form-control btn-sm" value="<?php echo $proveedor->ruc ?>" disabled id="txtRuc" name="txtRuc" type="text" placeholder="Nombre del producto" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-8">
                                <label class="control-label btn-sm">RAZ&Oacute;N SOCIAL:</label>
                                <input class="form-control btn-sm" value="<?php echo $proveedor->razonSocial ?>" disabled id="txtRazonSocial" name="txtRazonSocial" type="text" placeholder="Razón social del proveedor" required="" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">TEL&Eacute;FONO:</label>
                                <input class="form-control btn-sm" value="<?php echo $proveedor->telefono1 ?>" disabled id="txtTelefono" name="txtTelefono" type="text" placeholder="Tel&eacute;fono del proveedor" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-8">
                                <label class="control-label btn-sm">DIRECCI&Oacute;N:</label>
                                <input class="form-control btn-sm" value="<?php echo $proveedor->direccion ?>" disabled id="txtDireccion" name="txtDireccion" type="text" placeholder="Direcci&oacute;n del proveedor" required="" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">TIEMPO DE ENTREGA:</label>
                                <select class="form-control btn-sm" id="txtTiempoEntrega" name="txtTiempoEntrega" required="">
                                    <?php for($i = 1; $i <= 60; $i++) {?>
                                        <option value="<?php echo $i ?>"><?php echo $i . " D&Iacute;AS" ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="control-label btn-sm">VALIDEZ COTIZACI&Oacute;N:</label>
                                <input class="form-control btn-sm" value="1 MES" id="txtValidezCotizacion" name="txtValidezCotizacion" type="text" placeholder="Validez de la cotizaci&oacute;n" required="" style="text-transform: uppercase;">
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
                    <div class="table-responsive btn-sm">
                        <table class="table table-hover table-bordered table-sm">
                            <thead>
                                <tr style="font-weight: bold;">
                                    <th style="width:5%">CANTIDAD</th>
                                    <th>PRODUCTO</th>
                                    <th style="width:30%">DETALLES</th>
                                    <th style="width:10%; text-align: center">APLICA IVA <br><input type="checkbox" onchange="toggle(this)"></th>
                                    <th style="width:10%">VALOR UNITARIO</th>
                                    <th style="width:10%">VALOR TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once './acciones/listaDetalles.php';
                                $listaDetalles = $listaSolicitudes[0]->listaDetalles;
                                //foreach($listaDetalles as $detalle) {
                                for($i=0; $i < $listaSolicitudes[0]->totalRegistros; $i++) {?>
                                            <tr>
                                                <td style="text-align: end"><label id="lblCantidad<?php echo $i + 1 ?>"><?php echo $listaDetalles[$i]->cantidad ?></label></td>
                                                <td><?php echo $listaDetalles[$i]->detalle ?></td>
                                                <td><input id="txtDetalles" style="width: 100%"></td>
                                                <td style="text-align: center"><input id="chkIva<?php echo $i + 1 ?>" type="checkbox"></td>
                                                <td style="text-align: end"><input id="txtValorUnitario<?php echo $i + 1 ?>" class="monto<?php echo $i + 1 ?>" name="txtValorUnitario<?php echo $i + 1 ?>" onkeyup="valorTotal();" style="width: 100%"></td>
                                                <td style="text-align: end"><label id="lblValorTotal<?php echo $i + 1 ?>">0</label></td>
                                            </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="4"></td>
                                    <td style="font-weight: bold; text-align: end">SUBTOTAL:</td>
                                    <td style="text-align: end"><label id="lblSubtotal">0</label></td>
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
                        <div class="mb-3">
                            <label class="control-label">Rubros adicionales:</label>
                            <input class="form-control" type="text" id="txtRubrosAdicionales" name="txtRubrosAdicionales" placeholder="Rubros adicionales">
                        </div>
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
<script>
    function toggle(source) {
        for(j=1; j<3; j++){
            var checkboxes = document.querySelectorAll('input[id="chkIva'+[j]+'"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
    }
</script>
<script>
    function valorTotal() {
        var total1 = parseFloat(document.getElementById('lblCantidad1').innerHTML);
        $(".monto1").each(function() {
          if (isNaN(parseFloat($(this).val()))) {
            total1 *= 0;
          } else {
            total1 *= parseFloat($(this).val());
          }
        });
        var total2 = parseFloat(document.getElementById('lblCantidad2').innerHTML);
        $(".monto2").each(function() {
          if (isNaN(parseFloat($(this).val()))) {
            total2 *= 0;
          } else {
            total2 *= parseFloat($(this).val());
          }
        });
        //alert(total);
        document.getElementById('lblValorTotal1').innerHTML = total1;
        document.getElementById('lblValorTotal2').innerHTML = total2;
        var subtotal = total1 + total2;
        document.getElementById('lblSubtotal').innerHTML = subtotal;
        var iva = subtotal * 0.12;
        document.getElementById('lblIva').innerHTML = iva;
        var total = subtotal + iva;
        document.getElementById('lblTotal').innerHTML = total;
      }
</script>