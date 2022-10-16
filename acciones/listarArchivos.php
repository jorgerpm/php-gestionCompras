<?php
if (is_file('./Utils/configUtil.php')) {
    require_once './Utils/configUtil.php';
} else {
    require_once '../Utils/configUtil.php';
}

$archiCont = new archivoXmlControlador();
$respuesta = $archiCont->listar_archivos_controlador($_POST, 10000);
$columns = $archiCont->crear_columnas($respuesta);

$csv = [];

$colus = "";
foreach ($columns as $cols){
    //array_push($colus, $cols['col']);
    $colus = $colus.$cols['col'].";";
}
$colus = $colus."~";

array_push($csv, $colus);




if (count($respuesta) > 0) {
    foreach ($respuesta as $listaArchivoXml) {
        $filas = [];
        array_push($filas, $listaArchivoXml->nombreUsuario);
        array_push($filas, date("d/m/Y", $listaArchivoXml->fechaEmision / 1000));
        array_push($filas, date("d/m/Y", $listaArchivoXml->fechaAutorizacion / 1000));
        array_push($filas, $listaArchivoXml->estado);
        array_push($filas, $listaArchivoXml->numeroAutorizacion);
        array_push($filas, $listaArchivoXml->ambiente);
        
        $listvarj = json_decode($listaArchivoXml->comprobante);

        $docum = null;
        if (isset($listvarj->factura)) {
            $docum = $listvarj->factura;
        }
        if ($docum != null) {
            $valores = [];

            for ($ind = 6; $ind < (count($columns) - 4); $ind++) {
                $coincide = false;
                foreach ($docum->infoTributaria as $key => $val) {
                    if ($columns[$ind]['col'] == $key) {
                        array_push($valores, $val);
                        $coincide = true;
                        break;
                    }
                }
                if ($coincide) {
                    
                } else {
                    foreach ($docum->infoFactura as $key => $val) {
                        if (!isset($val->pago) && !isset($val->totalImpuesto)) {
                            if ($columns[$ind]['col'] == $key) {
                                array_push($valores, $val);
                                $coincide = true;
                                break;
                            }
                        }
                    }
                    if ($coincide) {
                        
                    } else {
                        array_push($valores, ' - ');
                    }
                }
            }

            foreach ($valores as $vals) {
                
                array_push($filas, $vals);
                
            }
        }
        
        array_push($filas, $listaArchivoXml->tipoDocumento);
        array_push($filas, $listaArchivoXml->idProveedor);
        array_push($filas, '');
        array_push($filas, '');
        

        //al final se agregar fila por fila
        $filAux="";
        foreach ($filas as $dd){
            $filAux = $filAux.$dd.";";
        }
        $filAux = $filAux."~";
        
        array_push($csv, $filAux);
    }
    
    //echo '<br>';
    print_r($csv);
//    echo json_encode($csv);
    //echo '<br>';
}

