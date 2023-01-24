<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}

if(isset($_POST['dataChecklistRecep'])){
    
    //aqui poner todo el html que se debe mostrar dentro de este div divChecklistRecep
    
    $respuesta = json_decode( json_encode($_POST['dataChecklistRecep']) );
    
    ?>

<input type="hidden" id="txtIdCheckList" name="txtIdCheckList" value="<?php echo $respuesta->id; ?>">
    
     <div class="row">
            <div class="col-md-3">
                <label class="control-label">Codigo solicitud</label>
                <input class="form-control form-control-sm" value="<?php echo $respuesta->codigoSolicitud; ?>" readonly="">
            </div>
            <div class="col-md-3">
                <label class="control-label">Codigo RC</label>
                <input class="form-control form-control-sm" value="<?php echo $respuesta->solicitud->codigoRC; ?>" readonly="">
            </div>
            <div class="col-md-3">
                <label class="control-label">Fecha solicitud</label>
                <input class="form-control form-control-sm" value="<?php echo date("d/m/Y", $respuesta->solicitud->fechaSolicitud / 1000); ?>" readonly="">
            </div>
            <div class="col-md-3">
                <label class="control-label">Solicitado por</label>
                <input class="form-control form-control-sm" value="<?php echo $respuesta->solicitud->usuario; ?>" readonly="">
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">Proveedor asignado</label>
                <input class="form-control form-control-sm" value="<?php echo $respuesta->ordenCompra->rucProveedor; ?>" readonly="" >
            </div>
            <div class="col-md-3">
                <label class="control-label">Raz&oacute;n social</label>
                <input class="form-control form-control-sm" value="<?php echo $respuesta->ordenCompra->proveedorDto->razonSocial; ?>" readonly="">
            </div>
            <div class="col-md-3">
                <label class="control-label">Nombre comercial</label>
                <input class="form-control form-control-sm" value="<?php echo $respuesta->ordenCompra->proveedorDto->nombreComercial; ?>" readonly="">
            </div>
            <div class="col-md-3"></div>
        </div>

<div class="row">
            <div class="col-md-3">
                <label class="control-label">C&oacute;digo del material</label>
                <input type="text" class="form-control form-control-sm" id="txtCodMaterialRecep" name="txtCodMaterialRecep"
                       value="<?php echo ($respuesta->codigoMaterial!=null && $respuesta->codigoMaterial!="") ? 
                       $respuesta->codigoMaterial : $respuesta->ordenCompra->listaDetalles[0]->codigoProducto; ?>" 
                       style="text-transform: uppercase" 
                       readonly=""
                       <?php /*echo ($respuesta->codigoMaterial!=null && $respuesta->codigoMaterial!="") ? "readonly" : "";*/ ?> required="">
            </div>
            <div class="col-md-3">
                <label class="control-label">Material solicitado</label>
                <input class="form-control form-control-sm" value="<?php echo $respuesta->ordenCompra->listaDetalles[0]->detalle; ?>" readonly="">
            </div>
            <div class="col-md-3">
                <label class="control-label">Cantidad solicitada</label>
                <input class="form-control form-control-sm" value="<?php echo $respuesta->ordenCompra->listaDetalles[0]->cantidad; ?>" readonly="">
            </div>
            
            <div class="col-md-3"></div>
        </div>
        


        <?php 
        $rols = array();
        foreach ($respuesta->listaDetalles as $deta) { 
            $rols[$deta->idUsuario]['nombreRol'] = $deta->nombreRol;
            $rols[$deta->idUsuario]['idRol'] = $deta->idRol;
            $rols[$deta->idUsuario]['idUsuario'] = $deta->idUsuario;
            $rols[$deta->idUsuario]['camposBodega'] = $deta->camposBodega;
            $rols[$deta->idUsuario]['fechaAprobacionArtes'] = $deta->fechaAprobacionArtes;
        }
        
        foreach($rols as $rrol){
            ?>
<hr>
<div style="text-align: center;"><label class="control-label">INFORMACIÓN A LLENAR POR <?php echo $rrol['nombreRol']; echo "(".$rrol['idUsuario'].")" ?></label></div>

        <?php if($rrol['idRol'] == 5 || $rrol['camposBodega'] == 'SI'){ ?>

        <div class="row">
            <!-- div class="col-md-3">
                <label class="control-label">C&oacute;digo del material</label>
                <input type="text" class="form-control form-control-sm" id="txtCodMaterialRecep" name="txtCodMaterialRecep"
                       value="<php echo ($respuesta->codigoMaterial!=null && $respuesta->codigoMaterial!="") ? 
                       $respuesta->codigoMaterial : $respuesta->ordenCompra->listaDetalles[0]->codigoProducto; ?>" 
                       style="text-transform: uppercase" 
                       readonly=""
                       <php /*echo ($respuesta->codigoMaterial!=null && $respuesta->codigoMaterial!="") ? "readonly" : "";*/ ?> required="">
            </div -->
            <div class="col-md-3">
                <label class="control-label">CANTIDAD RECIBIDA</label>
                <input type="number" class="form-control form-control-sm" id="txtCantidadRecep" name="txtCantidadRecep"
                       value="<?php echo $respuesta->cantidadRecibida; ?>" min="1"
                           <?php echo ($respuesta->cantidadRecibida!=null && $respuesta->cantidadRecibida!="" && $respuesta->cantidadRecibida>0) ? "readonly" : "" ?> required="">
            </div>
            <div class="col-md-3">
                <label class="control-label">Fecha de recepci&oacute;n</label>
                <input type="date" class="form-control form-control-sm" id="txtFechaRecepta" name="txtFechaRecepta"
                       value="<?php echo ($respuesta->fechaRecepcionBodega != null ? date('Y-m-d', $respuesta->fechaRecepcionBodega / 1000) : null ); ?>" 
                       <?php echo ($respuesta->fechaRecepcionBodega!=null && $respuesta->fechaRecepcionBodega!="") ? "readonly" : "" ?> required="">
            </div>
            
        </div>
        <br>

        <?php } ?>
        
        <!-- para asitente compras y coordinador compras -->
        <?php if($rrol['idRol'] == 7 || $rrol['idRol'] == 8){ ?>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">MONTO TOTAL FACTURA</label>
                <input type="number" class="form-control form-control-sm" id="txtMontoFactRecep" name="txtMontoFactRecep"
                       value="<?php echo $respuesta->montoTotalFactura; ?>" min="1"
                           <?php echo ($respuesta->montoTotalFactura!=null && $respuesta->montoTotalFactura!="" && $respuesta->montoTotalFactura>0) ? "readonly" : "" ?> required="">
            </div>
        </div>
        <br>
        <?php } ?>
        
        <!-- para el campo de fecha aprobacion artes -->
        <?php if($rrol['fechaAprobacionArtes'] == 'SI'){ ?>
        <div class="row">
            <div class="col-md-3">
                <label class="control-label">FECHA APROBACI&Oacute;N (ARTES)</label>
                <input type="date" class="form-control form-control-sm" id="txtfechaAprobacionArtes" name="txtfechaAprobacionArtes"
                       value="<?php echo ($respuesta->fechaAprobacionArtes != null ? date('Y-m-d', $respuesta->fechaAprobacionArtes / 1000) : 'new Date()' ); ?>"
                           <?php echo ($respuesta->fechaAprobacionArtes!=null && $respuesta->fechaAprobacionArtes!="") ? "readonly" : "" ?> required="">
            </div>
        </div>
        <br>    
        <?php }?>


        <?php $observ = null;
        $idObs = 0;
        foreach ($respuesta->listaDetalles as $pregunta) {
            if($pregunta->idRol == $rrol['idRol'] && $pregunta->idUsuario == $rrol['idUsuario']){
                $idObs = $pregunta->id;
                ?>

        <div class="row">
            <div class="col-md-10" style="border-bottom: 1px solid;">
                <label class="control-label"><?php echo $pregunta->pregunta;?></label>
            </div>
            <div class="col-md-2">
                <select class="form-control form-control-sm" required="" id="cmbPreg<?php echo $pregunta->id; ?>" name="cmbPreg<?php echo $pregunta->id; ?>" 
                    <?php echo ($pregunta->respuesta!=null && $pregunta->respuesta!="") ? "disabled" : "" ?> >
                    <option value="">- Seleccione -</option>
                    <?php 
                    echo '<option value="NO" '.($pregunta->respuesta=="NO" ? 'selected' : '').'>NO</option>';
                    echo '<option value="SI" '.($pregunta->respuesta=="SI" ? 'selected' : '').'>SI</option>';
                    ?>
                </select>
            </div>
        </div>
            <?php 
                if($pregunta->observacion != null){
                    $observ = $pregunta->observacion;
                }
            } ?>

        <?php 
            
        }?>

        <br>
        <div class="row">
            <div class="col-md-12">
                <label class="control-label">EN EL CASO DE TENER NOVEDADES, ESPECIFÍQUELO</label>
                <input type="text" class="form-control form-control-sm" value="<?php echo $observ ?>" 
                       id="txtNovedad<?php echo $idObs; ?>" name="txtNovedad<?php echo $idObs; ?>" style="text-transform: uppercase"
                       <?php echo ($observ!=null && $observ!="") ? "readonly" : "" ?> >
            </div>
        </div>
        
        <?php }?>
    
        
        
<?php }