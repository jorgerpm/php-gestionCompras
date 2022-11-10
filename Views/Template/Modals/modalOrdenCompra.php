<div class="modal fade" id="modalFormOrdCompra" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 80%; ">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Orden compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">                   
                
                <?php 
                if(file_exists('Template/formOrdenCompra.php')){
                    include 'Template/formOrdenCompra.php'; 
                }
                else{
                    include './Views/Template/formOrdenCompra.php'; 
                }
                    ?>

            </div>
        </div>
    </div>
</div>