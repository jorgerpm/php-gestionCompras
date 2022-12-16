<?php require_once 'Template/Modals/modalProveedor.php'; ?>
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-truck"></i> Gestión de proveedores</span>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Gestión proveedores</a></li>
        </ul>
    </div>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="mb-3">
                        <button class="btn btn-primary btn-sm fa" type="button" onclick="openModalProveedor(null);"><i class="fas fa-plus-circle"></i> Nuevo</button>
                        <div style="text-align: end; margin-top: -30px">
                            <input type="file" name="" class="btn btn-primary btn-sm fa" id="inputFileCsv" accept=".csv" required="">
                            <button type="button" class="btn btn-primary fa" name="btnCargarArchivo" id="btnCargarArchivo">cargar proveedores</button>
                        </div>
                    </div>
                    <div>
                        <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
                    </div>
                    
                    <!-- form method="POST" action="" ->
                    <div class="row" style="margin-bottom: -35px; text-align: center;">
                    <div class="col-sm-12 col-md-5"></div>
                    <div class="col-sm-12 col-md-3" style="padding: 0px;">
                        <div class="dataTables_filter">
                            <label class="control-label btn-sm" style="display: flex; white-space: nowrap">
                                    <span>Buscar por RUC: </span>
                                    <input  class="form-control form-control-sm" type="search" id="txtSearchRuc" placeholder aria-controls="tablaProveedores" style="z-index: 1">
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-3" style="padding: 0px;">
                        <div class="dataTables_filter">
                                <label class="control-label btn-sm" style="display: flex; white-space: nowrap">
                                    <span>Buscar por nombre: </span>
                                    <input  class="form-control form-control-sm" type="search" id="txtSearchName" placeholder aria-controls="tablaProveedores" style="z-index: 1">
                            </label>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-1" style="padding: 0px 10px 0px 0px">
                        <button id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" >buscar</button>
                    </div>
                </div>
                    <--</form -->
                    
                    <div class="">
                        <table class="table-responsive table table-hover table-bordered" id="tablaProveedores" style="white-space: nowrap">
                            <thead>
                                <tr>
                                    <th style="width: 5%"></th>
                                    <th>Código JD</th>
                                    <th>RUC</th>
                                    <th>Razón social</th>
                                    <th>Nombre comercial</th>
                                    <th>Contacto</th>
                                    <th>Correo</th>
                                    <th>Teléfono1</th>
                                    <th>Teléfono2</th>
                                    <th>Dirección</th>
                                    <th>Contabilidad</th>
                                    <th>Tel&eacute;fono contabilidad</th>
                                    <th>Correo contabilidad</th>
                                    <th>Estado</th>
                                    
                                </tr>
                            </thead>
                            
                        </table>
                    </div>
                    <div class="RespuestaAjax"></div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="./Assets/js/functions_proveedores.js"></script>

<!-- Data table plugin-->
<script type="text/javascript" src="./Assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./Assets/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    var tableProv = $('#tablaProveedores').DataTable({
        //scrollY: '34vh',
        //scrollCollapse: true,
        //dom: 'rtlip', //f es filter, esta quitado ahorita
        //filter: false, /desactiva la busqueda y no pasa valor de busqueda al post
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por p&aacute;gina',
            zeroRecords: 'No existen registros',
//            info: 'Mostrando p&aacute;gina _PAGE_ de _PAGES_',
            info: 'Mostrando del _START_ al _END_ de _MAX_',
            infoEmpty: 'No existen registros',
//            infoFiltered: '(filtrados de los _MAX_ registros totales)',
            search: 'Buscar: ',
            paginate: {
                previous: '&laquo',
                next: '&raquo;',
            },
        },
        lengthMenu: [
            [10, 25, 50, 100], //cantidad
            [10, 25, 50, 100], //texto que se muestra
        ],
        //processing: true, //indica el texto processing cuando se esta cargando la tabla
        serverSide: true,
        ajax: {
            url: './acciones/listarProveedores.php',
            type: 'POST',
        },
        //dom: '<"toolbar">frtip', coloca un div a donde se puede poner inputs como esta abajo
    });
    //$('div.toolbar').html('<input>'); //es el input que se coloca en el toolbar de arriba, se debe poner float: left
    
    $('#btnBuscar').on( 'click', function () {
        console.log("seeeeeee");
//        var buscaruc = document.getElementById('txtSearchRuc');
//        var busca = document.getElementById('txtSearchName');
//con esta linea envia a buscar
        //tableProv.search("").draw();
        
        //con esta linea envia a buscar una vez y coloca en dos columnas
//        tableProv.column(1).search( buscaruc.value ).column(2).search( busca.value ).draw();
//        
//        //con esta linea manda a buscar una vez
//        tableProv.column(2).search( busca.value ).draw();
    } );
</script>