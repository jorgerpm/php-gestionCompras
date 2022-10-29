<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Formulario de cotizaci&oacute;n</span>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">Formulario de cotizaci&oacute;n</a></li>
        </ul>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    
                    <?php 
if(isset($_GET['token'])){
    $token = $_GET['token'];
    
    $key = "hashidebsystems1";
        
    $numeroRC = openssl_decrypt(base64_decode($token), "aes-128-ecb", $key, OPENSSL_RAW_DATA);
    
    //echo '<p>aa::'.$numeroRC.'</p>';
    
    //buscar en la base de datos con ese numero de requisicion
    $solContr = new solicitudControlador();
    $solicitud = $solContr->buscar_solicitud_por_numero($numeroRC);
    
    if(!isset($solicitud)){
        echo '<p style="font-size: 20px; color: red; text-align: center;">La solicitud con n&uacute;mero: '.$numeroRC.' ya fue enviada</p>';
    }
//    echo '<br>';
//    print_r($solicitud->listaDetalles);
//    echo '<br>';
}
else{
    echo '<p style="font-size: 20px; color: red; text-align: center;">No existe solicitud sin n&uacute;mero de requisici&oacute;n</p>';
}

require_once './acciones/buscarProveedorRuc.php';

if(!isset($proveedor) || $proveedor->id == 0){
    echo '<p style="font-size: 20px; color: red; text-align: center;">No existe proveedor asociado a este usuario</p>';
}
?>
                    <form id="frmCotizacion" action="acciones/guardarCotizacion.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                        <div>
                            <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
                        </div>
                        <div class="mb-4">
                            <div class="mb-2" style="font-size: 16px; text-align: center">
                                <span class="control-label">CABECERA</span>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-<?php echo isset($token)?'4':'3' ?>">
                                    <label class="control-label btn-sm">C&Oacute;DIGO RC:</label>
                                    <input class="form-control btn-sm" value="<?php echo $solicitud->codigoRC; ?>"  id="txtCodigoRc" name="txtCodigoRc" type="text" placeholder="C&oacute;digo RC" required="" style="text-transform: uppercase;" 
                                        <?php echo isset($token)?'readonly':'' ?> >
                                </div>
                                <?php if(!isset($token)){ ?>
                                    <div class="form-group col-md-1">
                                        <button class="btn btn-primary btn-sm" type="button" style="position: absolute; bottom: 3px;"><i class="fa fa-search"></i></button>
                                    </div>
                                <?php }?>
                                <div class="form-group col-md-4">
                                    <label class="control-label btn-sm">C&Oacute;DIGO COTIZACI&Oacute;N:</label>
                                    <input class="form-control btn-sm" value="<?php echo isset($token)?($solicitud->codigoRC.'-'.$proveedor->ruc):''; ?>" readonly id="txtCodigoCotizacion" name="txtCodigoCotizacion" type="text" placeholder="C&oacute;digo cotizaci&oacute;n" required="" style="text-transform: uppercase;">
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label btn-sm">FECHA:</label>
                                    <input class="form-control btn-sm" value="<?php echo date('d/m/Y'); ?>" readonly id="txtFecha" name="txtFecha" type="text" placeholder="Fecha actual" required="">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="control-label btn-sm">RUC:</label>
                                    <input class="form-control btn-sm" value="<?php echo $proveedor->ruc ?>" readonly id="txtRuc" name="txtRuc" type="text" placeholder="Nombre del proveedor" required="" style="text-transform: uppercase;">
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
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label class="control-label btn-sm">TIEMPO DE ENTREGA:</label>
                                    <select class="form-control btn-sm" id="txtTiempoEntrega" name="txtTiempoEntrega" required="">
                                        <option value="">Seleccione</option>
                                        <?php for($i = 1; $i <= 60; $i++) {?>
                                            <option value="<?php echo $i . ($i==1?" D&Iacute;A":" D&Iacute;AS"); ?>"><?php echo $i . ($i==1?" D&Iacute;A":" D&Iacute;AS"); ?></option>
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
                                        <th style="width:10%; text-align: center">APLICA IVA <br><input type="checkbox" onchange="toggle(this, <?php echo count($solicitud->listaDetalles);?>)"></th>
                                        <th style="width:10%">VALOR UNITARIO</th>
                                        <th style="width:10%">VALOR TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    $listaDetalles = $solicitud->listaDetalles;
                                    if(isset($listaDetalles)){
                                        echo '<input id="registrosTabla" type="hidden" value="'.count($listaDetalles).'">';
                                        for($i=0;$i<count($listaDetalles);$i++) {?>
                                            <tr>
                                                <td style="text-align: center"><label id="lblCantidad<?php echo $i + 1 ?>"><?php echo $listaDetalles[$i]->cantidad ?></label></td>
                                                <td><label id="lblDetalle<?php echo $i + 1 ?>"><?php echo $listaDetalles[$i]->detalle ?></label></td>
                                                <td><input id="txtObservDetalle<?php echo $i + 1 ?>" style="width: 100%"></td>
                                                <td style="text-align: center"><input id="chkIva<?php echo $i + 1 ?>" type="checkbox" onclick="valorTotal(<?php echo count($solicitud->listaDetalles);?>);"></td>
                                                <td style="text-align: end"><input type="number" id="txtValorUnitario<?php echo $i + 1 ?>" class="monto<?php echo $i + 1 ?>" onkeyup="valorTotalDetalle(<?php echo ($i + 1) .', '. count($solicitud->listaDetalles);?>);" style="width: 100%; text-align: end;"></td>
                                                <td style="text-align: end"><label id="lblValorTotal<?php echo $i + 1 ?>">0</label></td>
                                            </tr>
                                    <?php } 
                                    }?>
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
                            <?php if(isset($token)){?>
                            <button class="btn btn-primary btn-sm fa" type="submit" >
                                <i class="fa fa-floppy-o"></i> Guardar y enviar</button>
                            <?php }?>
                        </div>
                        <div class="RespuestaAjax"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    function toggle(source, cantDetalles) {
        for(j=1; j<=cantDetalles; j++){
            var checkboxes = document.querySelectorAll('input[id="chkIva'+[j]+'"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i] != source)
                    checkboxes[i].checked = source.checked;
            }
        }
        
        valorTotal(cantDetalles);
    }
</script>
<script>
    function valorTotalDetalle(index, cantDetalles){
        //calcular el valor del registro actual
        var cantidad = parseFloat(document.getElementById('lblCantidad'+index).innerHTML);
        var txtValUnit = document.getElementById('txtValorUnitario'+index).value;
        var valUnit = 0;
        if(!isNaN(txtValUnit) && txtValUnit !== ''){
            valUnit = parseFloat(txtValUnit);
        }
        var valTotalDet = cantidad * valUnit;
        document.getElementById('lblValorTotal'+index).innerHTML = valTotalDet.toFixed(4);
        
        valorTotal(cantDetalles);
    }
    
    function valorTotal(cantDetalles) {
        //recorrer todos los registros para obtener el subtotal
        let subtotal = 0;
        let subtotalSinIva = 0;
        for(j=1; j<=cantDetalles; j++){
            
            var lblValTotal = document.getElementById('lblValorTotal'+j).innerHTML;
            
            var tieneIva = document.getElementById('chkIva'+j).checked;
            
            if(!isNaN(lblValTotal) && lblValTotal !== ''){
                if(tieneIva)
                    subtotal += parseFloat(lblValTotal);
                else
                    subtotalSinIva += parseFloat(lblValTotal);
            }
        }
        document.getElementById('lblSubtotal').innerHTML = subtotal.toFixed(2);
        document.getElementById('lblSubtotalSinIva').innerHTML = subtotalSinIva.toFixed(2);
        
        var iva = subtotal * 0.12;
        document.getElementById('lblIva').innerHTML = iva.toFixed(2);
        var total = subtotalSinIva + subtotal + iva;
        document.getElementById('lblTotal').innerHTML = total.toFixed(2);
        
        
        /*
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
        document.getElementById('lblValorTotal1').innerHTML = total1.toFixed(2);
        document.getElementById('lblValorTotal2').innerHTML = total2.toFixed(2);
        var subtotal = total1 + total2;
        document.getElementById('lblSubtotal').innerHTML = subtotal.toFixed(2);
        var iva = subtotal * 0.12;
        document.getElementById('lblIva').innerHTML = iva.toFixed(2);
        var total = subtotal + iva;
        document.getElementById('lblTotal').innerHTML = total.toFixed(2);
         */
      }
      
      //enviar a guardar la cotizacion
      $('#frmCotizacion').submit(function (e) {
            const LOADING = document.querySelector('.loader');
            LOADING.style = 'display: flex;';

            e.preventDefault(); //no se envíe el submit todavía
            
            //obtener los datos de los totales
            var lblSubtotal = document.getElementById('lblSubtotal').innerHTML;
            var lblSubtotalSinIva = document.getElementById('lblSubtotalSinIva').innerHTML;
            var lblIva = document.getElementById('lblIva').innerHTML;
            var lblTotal = document.getElementById('lblTotal').innerHTML;
            
            //obtener datos de los detalles
            var regs = document.getElementById('registrosTabla').value;
            var listaDetalles = new Array();
            for(i=1;i<=regs;i++){
                const detalle = {
                    cantidad: document.getElementById('lblCantidad'+i).innerHTML,
                    detalle: document.getElementById('lblDetalle'+i).innerHTML,
                    observDetalle: document.getElementById('txtObservDetalle'+i).value,
                    tieneIva: document.getElementById('chkIva'+i).checked,
                    valorUnitario: document.getElementById('txtValorUnitario'+i).value,
                    valorTotal: document.getElementById('lblValorTotal'+i).innerHTML,
                };
                listaDetalles.push(detalle);
            }
            

            var form = $(this);

            var accion = form.attr('action');
            var metodo = form.attr('method');
            
            var respuesta = form.children('.RespuestaAjax');

            var formdata = new FormData(this);
            
            formdata.append('lblSubtotal', lblSubtotal);
            formdata.append('lblSubtotalSinIva', lblSubtotalSinIva);
            formdata.append('lblIva', lblIva);
            formdata.append('lblTotal', lblTotal);
            
            formdata.append('listaDetalles', JSON.stringify(listaDetalles));
            
            console.log(listaDetalles);
            
            $.ajax({
                type: metodo,
                url: accion,
                data: formdata ? formdata : form.serialize(),
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    LOADING.style = 'display: none;';
                    respuesta.html(data);
                    document.getElementById("frmCotizacion").reset();
                },
                error: function (error) {
                    LOADING.style = 'display: none;';
                    respuesta.html(error);
                }
            });
      });
      
</script>