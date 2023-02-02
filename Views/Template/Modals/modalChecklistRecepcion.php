<div class="modal fade" id="modalChecklist" tabindex="1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="max-width: 90%; ">
        <div class="modal-content">
            <div class="modal-header headerRegister">
                <div><h5 class="modal-title" id="titleModal">CHECK LIST RECEPCIÓN PRODUCTOS Y/O SERVICIOS </h5>
                
                    <span style="color: red;">
                        Leer detenidamente las preguntas antes de contestar.
                        </span>
                
                </div>
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="FormularioChecklistRecepcion" action="acciones/guardarCheckListRecepcion.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                    
                    <div id="divChecklistRecep">    
                        <!-- aqui el html, que se genera dinamicamente desde la respuesta PHP -->
                        
                    </div>
                        
                    
                    <br>
                    <div class="tile-footer" style="text-align: center;">
                        <?php if(!$_SESSION['Rol']->principal || $_SESSION['Rol']->id ==1){ ?>
                        <button id="btnActionForm" class="btn btn-primary" type="submit" >
                            <i class="fa fa-fw fa-lg fa-check-circle"></i>
                            <span id="btnText">Guardar</span>
                        </button>&nbsp;&nbsp;&nbsp;
                        
                        <?php } ?>
                            
                        <a class="btn btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                        
                        &nbsp;&nbsp;&nbsp;
                        <button id="btnImprimir" class="btn btn-secondary" type="button" onclick="ejecutarReportePdf('RECEPCION', document.querySelector('#txtIdCheckList').value);" >
                            <i class="fa fa-fw fa-lg fa-print"></i>
                            <span id="btnText">Imprimir</span>
                        </button>
                        
                    </div>
                    <div class="RespuestaAjaxCheckListRecep"></div>
                </form>
            </div>
        </div>
    </div>
</div>