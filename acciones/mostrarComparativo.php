<?php
if(is_file('./Utils/configUtil.php')){
    require_once './Utils/configUtil.php';
}
else{
    require_once '../Utils/configUtil.php';
}


if(isset($_POST['comparativoSelect'])){
    foreach ($_POST['comparativoSelect']['listaDetalles'] as $dett){
//        print_r($dett);
        $dett['cotizacion']['solicitudDto'] = $_POST['comparativoSelect']['solicitud'];
        $dett['cotizacion']['proveedorDto'] = $dett['proveedorDto'];
        
        $respuesta[] = json_decode( json_encode($dett['cotizacion']) );
    }
    
}
else{
    $cotcontr = new cotizacionControlador();
    $respuesta = $cotcontr->get_cotizaciones_para_comparativo_controlador();
}

//print_r($respuesta);
if(isset($respuesta) && $respuesta != null){
    
    echo '<input type="hidden" id="txtRucProv" name="txtRucProv" value="">';
    
echo    '<div class="row">
                        <div class="col-sm-3">
                            <label class="control-label form-control-sm">FECHA SOLICITUD:</label>
                            <input class="form-control form-control-sm" value="'.date("d/m/Y", $respuesta[0]->solicitudDto->fechaSolicitud / 1000).'" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label form-control-sm">FECHA COMPARATIVO:</label>
                            <input class="form-control form-control-sm" value="'.date('d/m/Y').'" readonly>
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label form-control-sm">CÓDIGO DE SOLICITUD:</label>
                            <input class="form-control form-control-sm" value="'.$respuesta[0]->solicitudDto->codigoSolicitud.'" readonly id="txtCodSolComp" name="txtCodSolComp">
                        </div>
                        <div class="col-sm-3">
                            <label class="control-label form-control-sm">MONTO APROBADO</label>
                            <input class="form-control form-control-sm" readonly value="'.$respuesta[0]->solicitudDto->montoAprobado.'">
                        </div>
                    </div>
                    <br>
                    <div class="table-responsive">';
    

echo '<table class="table table-hover table-bordered table-sm" id="tablaComparativo" style=" border: 1px solid">
        <thead>
            <tr>
                <th></th>
                <th></th>';
foreach ($respuesta as $cot){
         echo '<th colspan="3" style="border: 1px solid; text-align:center;"><input type="checkbox" id="'.$cot->proveedorDto->ruc.'" name="'.$cot->proveedorDto->ruc.'" onchange="selectCotizacion(this, \''.$cot->proveedorDto->ruc.'\');" class="chkCompart" >&nbsp;&nbsp;'
    .$cot->proveedorDto->razonSocial.'</th>';
}
echo            '
            </tr>
            <tr>
                <th style="border: 1px solid;">Detalle</th>
                <th style="border: 1px solid;">Cantidad</th>';
foreach ($respuesta as $cot){
                //<!-- esto cambia por cada proveedor, y se debe repetir por cada proveedor -->
                echo '<th style="border: 1px solid;">Valor unit.</th>
                <th style="border: 1px solid;">Valor total</th>
                <th style="border: 1px solid;">Tiempo entrega</th>';
                //<!-- hasta aca se deb repetir -->
}
echo           '
            </tr>
        </thead>
        <tbody>';

foreach ($respuesta[0]->listaDetalles as $detalle){
      echo '<tr>
                <td style="border: 1px solid;">'.$detalle->detalle.'</td>
                <td style="border: 1px solid;">'.$detalle->cantidad.'</td>';
    foreach ($respuesta as $cotizacion){
            //<!-- esto cambia por cada proveedor, y se debe repetir por cada proveedor -->
        foreach ($cotizacion->listaDetalles as $detCot){    
            if($detalle->detalle == $detCot->detalle){
    
                echo   '<td style="border: 1px solid; text-align:end;">$ '.number_format($detCot->valorUnitario, 2).'</td>
                    <td style="border: 1px solid; text-align:end;">$ '.number_format($detCot->valorTotal, 2).'</td>
                    <td style="border: 1px solid; text-align:center;">'.$cotizacion->tiempoEntrega.'</td>';
                    //<!-- hasta aca se deb repetir -->
            }
        }
    }
    echo   '
            </tr>
            <tr>
                <td></td>
                <td></td>';
    foreach ($respuesta as $cotizacion){
            //<!-- esto cambia por cada proveedor, y se debe repetir por cada proveedor -->
        foreach ($cotizacion->listaDetalles as $detCot){    
            if($detalle->detalle == $detCot->detalle){
                echo '<td colspan="3" style="border: 1px solid; text-align:center;">'.$detCot->observacion.'</td>';
            }
        }
    }
    echo   '
            </tr>';
}
 echo '           <tr>
                <td></td>
                <td></td>';
    foreach ($respuesta as $cot){
        echo   '<td style="border: 1px solid;">SUBTOTAL</td>
                <td colspan="2" style="border: 1px solid; text-align:end;">$ '.number_format($cot->subtotal, 2).'</td>';
    }
    echo   '
            </tr>
            <tr>
                <td></td>
                <td></td>';
    foreach ($respuesta as $cot){
        echo   '<td style="border: 1px solid;">SUBTOTAL SIN IVA</td>
                <td colspan="2" style="border: 1px solid; text-align:end;">$ '.number_format($cot->subtotalSinIva, 2).'</td>';
    }
    echo       '
            </tr>
            <tr>
                <td></td>
                <td></td>';
    foreach ($respuesta as $cot){
         echo '<td style="border: 1px solid;">IVA</td>
                <td colspan="2" style="border: 1px solid; text-align:end;">$ '.number_format($cot->iva, 2).'</td>';
    }
    echo   '
            </tr>
            <tr>
                <td></td>
                <td></td>';
    foreach ($respuesta as $cot){
        echo   '<td style="border: 1px solid;">TOTAL</td>
                <td colspan="2" style="border: 1px solid; text-align:end;">$ '.number_format($cot->total, 2).'</td>';
    }
    echo      '
            </tr>
            <tr>
                <td></td>
                <td></td>';
    foreach ($respuesta as $cot){
        echo   '<td colspan="2" style="border: 1px solid; text-align:center;">FORMA DE PAGO</td>
                <td style="border: 1px solid; text-align:center;">'.$cot->formaPago.'</td>';
    }
    
    echo      '
            </tr>
            <tr>
                <td></td>
                <td></td>';
    foreach ($respuesta as $cot){
        echo   '<td colspan="3" style="border: 1px solid; text-align:center;">';
        echo ($cot->adicionales != null && $cot->adicionales != "") ? ($cot->adicionales." - ") : "";
        echo ($cot->observacion != null && $cot->observacion != "") ? $cot->observacion : "";
        echo '</td>';
    }
    echo      '
            </tr>';

echo   '</tbody>
    </table>';


echo '</div>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="control-label form-control-sm">OBSERVACIONES:</label>
                        </div>
                        <div class="col-sm-10" style="padding-left: 0px">
                            <input class="form-control form-control-sm" id="txtObsComp" name="txtObsComp" value="'
.(isset($_POST['comparativoSelect']['observacion']) ? $_POST['comparativoSelect']['observacion'] : '')
        .'" required style="text-transform: uppercase;">
                        </div>
                    </div>
                    
                    <br>
                    <div class="row">
                        <div class="col-sm-2">
                            <label class="control-label form-control-sm">SOLICITADO POR:</label>
                        </div>
                        <div class="col-sm-2" style="padding: 0px">
                            <input class="form-control form-control-sm" value="'.$respuesta[0]->solicitudDto->usuario.'" readonly>
                        </div>
                        <div class="col-sm-2" style="padding-right: 0px">
                            <label class="control-label form-control-sm">ELABORADO POR:</label>
                        </div>
                        <div class="col-sm-2" style="padding: 0px">
                            <input class="form-control form-control-sm" value="'.$_SESSION['Usuario']->nombre.'" readonly>
                        </div>
                        <div class="col-sm-2">
                            <label class="control-label form-control-sm">APROBADO POR:</label>
                        </div>
                        <div class="col-sm-2" style="padding-left: 0px">
                            <input class="form-control form-control-sm" readonly>
                        </div>
                    </div>';


}
else{
    echo '<script>swal("", "No existen cotizaciones en estado COTIZADO para comparar.", "warning");</script>';
}