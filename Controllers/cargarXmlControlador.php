<?php

session_start();

class cargarXmlControlador extends cargarXmlModelo {

    public function cargar_archivo_controlador() {

        $countfiles = count($_FILES['archivos']['name']); //Cuenta el total de archivos
        $upload_location = __DIR__ . 'Archivos_subidos/'; //cargar directorio
        $upload_location = str_replace("Controllers", "", $upload_location);
//        $upload_location = constantesUtil::$ARCHIVOS_SUBIDOS;
        $count = 0;

        for ($i = 0; $i < $countfiles; $i++) {
            $file_name = $_FILES['archivos']['name'][$i]; //Nombre del archivo
            $path = $upload_location . $file_name; //Ruta del archivo
            $file_extension = pathinfo($path, PATHINFO_EXTENSION); //Extensión del archivo
            $file_extension = strtolower($file_extension); //String cambia las letras a minúsculas; strtoupper pone en mayúsculas
            if ($file_extension == "xml") {
                $archivo_xml = $_FILES['archivos']['name'][$i];
            } elseif ($file_extension == "pdf") {
                $archivo_pdf = $_FILES['archivos']['name'][$i];
            }
            $valid_ext = array("xml", "pdf"); //Extensiones válidas
            if (in_array($file_extension, $valid_ext)) { //Verificar extensiones
                if (move_uploaded_file($_FILES['archivos']['tmp_name'][$i], $path)) { //Cargar archivos
                    $count += 1;
                }
            }
        }
//echo $count;

        $array = [
            'ubicacionArchivo' => constantesUtil::$ARCHIVOS_SUBIDOS . $archivo_xml,
//            'ubicacionArchivo' => $upload_location . $archivo_xml,
            'nombreArchivoXml' => $archivo_xml,
            'nombreArchivoPdf' => isset($archivo_pdf) ? $archivo_pdf : null,
            'urlArchivo' => constantesUtil::$URL_ARCHIVOS,
            'idUsuarioCarga' => $_SESSION['Usuario']->id,
            'tipoDocumento' => '01'
        ];
        
        $respuesta = cargarXmlModelo::cargar_archivo_modelo($array);
        return $respuesta;        
    }

}
