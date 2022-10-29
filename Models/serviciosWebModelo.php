<?php

class serviciosWebModelo {

    protected function invocarPost($urlServicio, $datos) {
        $url = constantesUtil::$URL_WEB_SERVICE . $urlServicio;
        $ch = curl_init();

        $data = json_encode($datos);
        //print_r($data);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $response = curl_exec($ch);
        
        //validar el codigohttp de respuesta
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        //print_r($httpcode);
        if($httpcode != 200){
            //print_r($response);
        }
        $tipoArray = json_decode($response);

        curl_close($ch);
        return $tipoArray;
    }

    protected function invocarGet($urlServicio, $datos) {
        $url = constantesUtil::$URL_WEB_SERVICE . $urlServicio;
        $ch = curl_init();

        $data = json_encode($datos);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $response = curl_exec($ch);

        $tipoArray = json_decode($response);

        curl_close($ch);
        return $tipoArray;
    }

}
