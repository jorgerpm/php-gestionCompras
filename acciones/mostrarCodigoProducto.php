<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}


if(isset($_POST['comparativoSelect'])){
    
//    print_r($_POST['comparativoSelect']);
    
//$respuesta[] = json_decode( json_encode($dett['cotizacion']) );
        
        foreach ($_POST['comparativoSelect']['listaDetalles'] as $detaCotz){
//            print_r($detaCotz);
            ?>
            <div class="row">
                <div class="col-md-4">
                    <label class="control-label">C&oacute;digo producto</label>
                    <input class="form-control" id="txtCodProdOC<?php echo $detaCotz['id'];?>" name="txtCodProdOC<?php echo $detaCotz['id'];?>" 
                           required="" style="text-transform: uppercase;">
                </div>
                <div class="col-md-8">
                    <label class="control-label">Nombre producto</label>
                    <input class="form-control" id="txtNomProdOC<?php echo $detaCotz['id'];?>" name="txtNomProdOC<?php echo $detaCotz['id'];?>" 
                           value="<?php echo $detaCotz['detalle']; ?>" required="" style="text-transform: uppercase;">
                </div>
            </div>
            <?php
            
            
        }
    
    ?>


    <br>
                    <div class="tile-footer" style="text-align: center;">
                        
                        <!-- onclick="generarOC();"-->
                        
                        <button id="btnCodProdGuardar" class="btn btn-primary" type="button" 
                                onclick='generarOC(varCot = <?php echo json_encode($_POST['comparativoSelect']);?>);' >
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                            <span id="btnText">Generar OC</span>
                        </button>&nbsp;&nbsp;&nbsp;
                            
                        <a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                        
                        
                    </div>

    
<?php
    
}