<?php
class serviciosWebControlador {
    private $URL = "http://localhost:8080/ServiciosWeb/ideb/";
    public function invocarPost($urlServicio, $datos) {
        $url = $this->URL . $urlServicio;
        $ch = curl_init();

        $data = json_encode($datos);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT ,3);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $response = curl_exec($ch);

        $tipoArray = json_decode($response);
        
        curl_close ($ch);
        return $tipoArray;
    }
    
    public function invocarGet($urlServicio, $datos) {
        $url = $this->URL . $urlServicio;
        $ch = curl_init();

        $data = json_encode($datos);

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPGET, true);
        curl_setopt($ch, CURLOPT_HEADER ,0);
        curl_setopt($ch, CURLOPT_POST, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        $response = curl_exec($ch);

        $tipoArray = json_decode($response);
        
        curl_close ($ch);
        return $tipoArray;
    }
}
