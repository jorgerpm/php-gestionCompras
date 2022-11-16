<?php include 'Template/Modals/modalProducto.php'; ?>
<main class="app-content">
    <div class="app-title" style="height: 50px">
        <div>
            <span class="tamañoTitulo"><i class="fa fa-cube"></i> Gestión de productos</span>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Administraci&oacute;n</li>
            <li class="breadcrumb-item active"><a href="#">Gesti&oacute;n de productos</a></li>
        </ul>
    </div>
    <div class="row espacio">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">

                    <div>
                        <p><button class="btn btn-primary btn-sm fa" type="button" onclick="openModalProducto(null);"><i class="fas fa-plus-circle"></i> Nuevo</button></p>
                    </div>
                    <div>
                        <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href = ''">buscar</button></p>
                    </div>

                    <div class="">
                        <table class="table-responsive table table-hover table-bordered" id="tableProductos" >
                            <thead>
                                <tr>
                                    <!-- th>C&oacute;digo</th -->
                                    <th>C&oacute;digo producto</th>
                                    <th>Nombre</th>
                                    <th>Valor unitario</th>
                                    <th>¿Tiene IVA?</th>
                                    <th>Estado</th>
                                    <th style="width: 5%"></th>
                                </tr>
                            </thead>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<script src="./Assets/js/functions_productos.js"></script>

<!-- Data table plugin-->
<script type="text/javascript" src="./Assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./Assets/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
    $('#tableProductos').DataTable({
        //scrollY: '34vh',
        //scrollCollapse: true,
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por p&aacute;gina',
//            zeroRecords: 'No existen registros',
//            info: 'Mostrando p&aacute;gina _PAGE_ de _PAGES_',
            info: 'Mostrando del _START_ al _END_ de _MAX_',
//            infoEmpty: 'No existen registros',
//            infoFiltered: '(filtrados de los _MAX_ registros totales)',
            search: 'Buscar: ',
            //processing: 'cargando',
            paginate: {
                previous: '&laquo',
                next: '&raquo;',
            },
        },
        lengthMenu: [
            [10, 25, 50, 100], //cantidad
            [10, 25, 50, 100], //texto que se muestra
        ],
        processing: true, //indica el texto processing cuando se esta cargando la tabla
        serverSide: true,
        ajax: {
            url: './acciones/listarProductos.php',
            type: 'POST',
        },
    });
</script>