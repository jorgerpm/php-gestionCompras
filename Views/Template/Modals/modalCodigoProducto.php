<div class="modal fade" id="modalCodigoProducto" tabindex="1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false" >
    <div class="modal-dialog modal-lg" style="max-width: 90%; ">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">C&oacute;digo del producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formCodigoProducto" class="FormularioAjax" action="acciones/guardarComparativo.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
                    <div id="divCodigoProducto">
                        <!-- aqui el html, que se genera dinamicamente desde la respuesta PHP -->
                    </div>
                    
                    <div class="RespuestaAjax"></div>
                    
                </form>
            </div>
        </div>
    </div>
</div>