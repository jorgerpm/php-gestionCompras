<div class="modal fade" id="modalFormCotiz" tabindex="1" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 80%; ">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Cotizaci&oacute;n</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                   
                
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