<?php 
//if(isset($_GET['numeroRC'])){
//    $solCont = new solicitudControlador();
//    $solicitudGet = $solCont->buscar_solicitud_por_numero($_GET['numeroRC']);
//} 
?>
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-calculator"></i> Solicitud de cotizaci&oacute;n</span>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item active"><a href="#">Solicitud de cotizaci&oacute;n</a></li>
        </ul>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    
                    <?php 
                if(file_exists('Template/formSolicitud.php')){
                    include 'Template/formSolicitud.php'; 
                }
                else{
                    include './Views/Template/formSolicitud.php'; 
                }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</main>
