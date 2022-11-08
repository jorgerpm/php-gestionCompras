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
                    <?php 
                if(file_exists('Template/formCotizacion.php')){
                    include 'Template/formCotizacion.php'; 
                }
                else{
                    include './Views/Template/formCotizacion.php'; 
                }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</main>
