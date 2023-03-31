<?php 
$contr1sol = new solicitudControlador();
$numSolicitud = $contr1sol->getUltimoCodigoSolicitud();
?>

<form id="formSolicitud" autocomplete="off">
    <div class="row" style="padding-bottom: 5px">
        <input type="hidden" value="<?php echo isset($solicitudGet) ? $solicitudGet->id : "0" ?>" id="txtId" name="txtId">
        
        <div class="col-md-2 col-sm-2 col-12">
            <label>C&oacute;digo de RC</label>
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <input id="txtCodRC" name="txtCodRC" class="form-control btn-sm" style="text-transform: uppercase;" value="<?php echo isset($solicitudGet) ? $solicitudGet->codigoRC : ""; ?>" required="" >
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <label>C&oacute;digo solicitud</label>
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <input id="txtCodsol" name="txtCodsol" class="form-control btn-sm" style="text-transform: uppercase;" value="<?php echo isset($numSolicitud) ? $numSolicitud->codigoSolicitud : (isset($solicitudGet) ? $solicitudGet->codigoSolicitud : "") ?>" required="">
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <label>Fecha</label>
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <input id="dtFechaSol" name="dtFechaSol" class="form-control btn-sm" type="date" value="<?php echo isset($solicitudGet) ? date("Y-m-d", $solicitudGet->fechaSolicitud / 1000) : date("Y-m-d"); ?>" required="">
        </div>
    </div>
    
    
    
    
    <div class="row" style="padding-bottom: 5px">
        <div class="col-md-2 col-sm-2 col-12">
            <label class="control-label">Monto aprobado</label>
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <input type="number" step="any" id="txtMontoAprob" name="txtMontoAprob" class="form-control btn-sm" style="text-transform: uppercase;" value="<?php echo isset($solicitudGet) ? $solicitudGet->montoAprobado : "" ?>" >
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <label class="control-label">Fecha autorizaci&oacute;n RC</label>
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <input id="dtFechaAprobRC" name="dtFechaAprobRC" class="form-control btn-sm" type="date" value="<?php echo isset($solicitudGet) ? date("Y-m-d", $solicitudGet->fechaAutorizaRC / 1000) : date("Y-m-d"); ?>" >
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <label class="control-label">Estado RC</label>
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <input id="txtEstadoRC" name="txtEstadoRC" class="form-control btn-sm" style="text-transform: uppercase;" value="<?php echo isset($solicitudGet) ? $solicitudGet->estadoRC : "" ?>" >
        </div>
    </div>
    
    
    

    <div class="row" style="padding-bottom: 5px">
        <div class="col-md-2 col-sm-2 col-12">
            <label>Proveedor</label>
        </div>
        <div class="col-md-4 col-sm-4 col-12">

            <?php
//            require_once './Controllers/proveedorControlador.php';
//            $provCont = new proveedorControlador();
//            $listaProvs = $provCont->listarProveedoresActivosNombre();
            ?>
            <input id="txtNombreProveedor" name="txtNombreProveedor" class="form-control"  onkeyup="cargarProveedor(this);">
            <input type="hidden" id="correoHidden" value="">
            <div id="losli" style="position: absolute; z-index: 1; background-color: white; border: solid 1px;"></div>
            
            
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <button class="btn btn-primary btn-sm fa" type="button" onclick="agregarCorreo();">
                <i class="fa fa-plus"></i></button>
        </div>
        
        <div class="col-md-2 col-sm-2 col-12">
            <label class="control-label">Unidad de negocio</label>
        </div>
        <div class="col-md-2 col-sm-2 col-12">
            <input id="txtUnidadNegoRC" name="txtUnidadNegoRC" class="form-control btn-sm" style="text-transform: uppercase;" value="<?php echo isset($solicitudGet) ? $solicitudGet->unidadNegocioRC : "" ?>" >
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-2 col-12">
            <label>Lista de correos</label>
        </div>
        <div class="col-md-10 col-sm-10 col-12">
            <input id="txtCorreos" name="txtCorreos" class="form-control btn-sm" value="<?php echo isset($solicitudGet) ? $solicitudGet->correos : "" ?>" required="">
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 col-sm-2 col-12">
            <button class="btn btn-primary btn-sm fa" type="button" onclick="agregarFila();" id="btnAniadir">
                <i class="fa fa-plus"></i> A&ntilde;adir producto</button>
        </div>
        <div class="col-md-7"></div>
        <div class="col-md-3" style="text-align: end;">
            <input type="file" name="" class="btn btn-primary btn-sm fa" id="fileDetalles" accept=".csv" style="width: 100%;">
        </div>
    </div>


    <br>
    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="tblDetSolicitud" name="tblDetSolicitud">
            <thead>
                <tr>
                    <th style="width: 5%">Cantidad</th>
                    <!-- th>C&oacute;digo producto</th -->
                    <th>Descripci&oacute;n</th>
                    
                    <th>Archivo</th>
                    <th style="width: 5%"></th>
                </tr>
            </thead>
            <tbody id="tbodySol">
                <?php
                if (isset($solicitudGet)) {
                    for ($i = 0; $i < count($solicitudGet->listaDetalles); $i++) {
                        echo '<tr>';
                        echo '<td><input type="number" id="txtCantidad' . ($i + 1) . '" style="width: 100%" value="' . $solicitudGet->listaDetalles[$i]->cantidad . '"></td>'
                        . '<td><input id="txtDetalle' . ($i + 1) . '" style="width: 100%; text-transform: uppercase;" value="' . $solicitudGet->listaDetalles[$i]->detalle . '"></td>'
                        . '<td>aqui archivo</td>'
                        . '<td><input id="' . ($i + 1) . '" type="button" value="x" onclick="eliminarFila(this);">';
                        echo '<input type="hidden" id="txtIdDetalle' . ($i + 1) . '" name="txtIdDetalle' . ($i + 1) . '" value="' . $solicitudGet->listaDetalles[$i]->id . '"></td>';
                        echo '</tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
    <div>
        <label class="control-label">Observaciones:</label>
        <textarea id="txtObserv" name="txtObserv" class="form-control" placeholder="Observaciones" style="text-transform: uppercase;"
                  ><?php echo isset($solicitudGet) ? $solicitudGet->observacion : "" ?></textarea>
    </div>

    <br>
    <div style="text-align: center">
        <button class="btn btn-primary" type="submit" id="btnGuardaSolic">
            <i class="fa fa-floppy-o"></i> Guardar y enviar</button>
        <a class="btn btn-secondary" href="./solicitudCotizacion" data-dismiss="modal">
            <i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
    </div>
    <div class="RespuestaAjax" ></div>
</form>
<script src="./Assets/js/functions_solicitudes.js"></script>

