<?php

class constantesUtil {
    public static $TIEMPO_SESION = 600;// 180; //3 minutos, esto ya no aqui
    public static $PUERTO_WEB_SERVICE = "8080";
    public static $CONTEXTO_WEB_SERVICE = "ServiciosWebGestionCompras";
    public static $URL_WEB_SERVICE = "http://192.168.100.74:8080/ServiciosWebGestionCompras/ideb/";
//    public static $URL_WEB_SERVICE = "http://localhost:8080/ServiciosWebGestionCompras/ideb/";
    
    public static function get_url_web_services(){
        return "";
    }
}