<div class="modal fade" id="modalComparativo" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 90%; ">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <h5 class="modal-title" id="titleModal">Comparativo de cotizaciones</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formComparativo" class="FormularioAjax" action="acciones/guardarComparativo.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
                    <div id="divComparativo">    
                        <!-- aqui el html, que se genera dinamicamente desde la respuesta PHP -->
                    </div>
                        
                    
                    <br>
                    <div class="tile-footer" style="text-align: center;">
                        <button id="btnActionForm" class="btn btn-primary" type="button" onclick="generarOC();" disabled="true">
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                            <span id="btnText">Generar OC</span>
                        </button>&nbsp;&nbsp;&nbsp;
                            
                        <a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                        
                        &nbsp;&nbsp;&nbsp;
                        <button class="btn btn-secondary" type="button" onclick="pruebajspdf('COMPARATIVO', document.querySelector('#txtRucProv').value);" >
                            <i class="fa fa-fw fa-lg fa-print"></i>
                            <span id="btnText">Imprimir</span>
                        </button>
                        
                    </div>
                    <div class="RespuestaAjax"></div>
                </form>
            </div>
        </div>
    </div>
</div>                    