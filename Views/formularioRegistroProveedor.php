<html lang="en">
    <head>
        <meta name="description" content="Sistema para carga de facturas xml">
        
        <title>Sistema para carga de facturas xml</title>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Main CSS-->
        <link rel="stylesheet" type="text/css" href="./Assets/css/main.css">
        <link rel="stylesheet" type="text/css" href="./Assets/css/estilosExtra.css">
        <!-- Font-icon css-->
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="./Assets/js/jquery-3.3.1.min.js"></script>
        
    </head>
    <body class="app" style="background-color: #E5E5E5">
        <div class="loader"></div>
        <!-- Barra de navegaciój-->
<main>
    <div class="row">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div style="text-align: center; margin-top: 10px">
            <span class="tamañoTitulo"><i class="fa fa-address-card-o"></i> Formulario para registro de proveedores</span>
        </div>
            <br>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form id="formProveedor" class="FormularioAjax login-form" action="acciones/guardarProveedor.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
                        <input type="hidden" id="idProveedor" name="idProveedor" value="">

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label" for="txtRuc">RUC:</label>
                                <input class="form-control" id="txtRuc" name="txtRuc" type="number" placeholder="Ruc del proveedor" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-6">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Raz&oacute;n social:</label>
                                <input class="form-control" id="txtRazonSocial" name="txtRazonSocial" type="text" placeholder="Raz&oacute;n social del proveedor" required="" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Nombre comercial:</label>
                                <input class="form-control" id="txtNombreComercial" name="txtNombreComercial" type="text" placeholder="Nomber comercial del proveedor" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Direcci&oacute;n:</label>
                                <input class="form-control" id="txtDireccion" name="txtDireccion" type="text" placeholder="Direcci&oacute;n del proveedor" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Correo:</label>
                                <input class="form-control" id="txtCorreo" name="txtCorreo" type="email" placeholder="CORREO DEL PROVEEDOR" required="">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Tel&eacute;fono 1:</label>
                                <input class="form-control" id="txtTelefono1" name="txtTelefono1" type="number" placeholder="Tel&eacute;fono 1 del proveedor" required="">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Tel&eacute;fono 2:</label>
                                <input class="form-control" id="txtTelefono2" name="txtTelefono2" type="number" placeholder="Tel&eacute;fono 2 del proveedor" style="text-transform: uppercase;">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="control-label">Usuario:</label>
                                <input class="form-control" id="txtCodigoJD" name="txtCodigoJD" type="text" placeholder="Usuario es el mismo RUC" style="text-transform: uppercase;">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="control-label">Contraseña:</label>
                                <input class="form-control" id="txtCodigoJD" name="txtCodigoJD" type="password" placeholder="Contraseña" style="text-transform: uppercase;">
                            </div>
                        </div>
                        <div class="tile-footer" style="text-align: end;">
                            <button id="btnActionForm" class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg
                                                                                                fa-check-circle"></i><span id="btnText">Guardar</span></button>&nbsp;&nbsp;&nbsp;<a class="btn
                                                                                                 btn-secondary" href="#" data-dismiss="modal"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancelar</a>
                        </div>
                        <div class="RespuestaAjax"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
            </div>
        <div class="col-md-2"></div>
    </div>
</main>
<script src="./Assets/js/popper.min.js"></script>
<script src="./Assets/js/bootstrap.min.js"></script>
<script src="./Assets/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="./Assets/js/plugins/pace.min.js"></script>
<script type="text/javascript" src="./Assets/js/plugins/bootstrap-notify.min.js"></script>
<script type="text/javascript" src="./Assets/js/plugins/sweetalert.min.js"></script>
<!-- Page specific javascripts-->

<script type="text/javascript" src="./Assets/js/md5.js"></script>

<!-- Data table plugin-->
<script type="text/javascript" src="./Assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./Assets/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">
        $('#sampleTable').DataTable({
        //scrollY: '34vh',
        //scrollCollapse: true,
        language: {
            lengthMenu: 'Mostrar _MENU_ registros por p&aacute;gina',
            zeroRecords: 'No existen registros',
            info: 'Mostrando p&aacute;gina _PAGE_ de _PAGES_',
            infoEmpty: 'No existen registros',
            infoFiltered: '(filtrados de los _MAX_ registros totales)',
            search: 'Buscar',
            paginate:{
                previous: '&laquo',
                next: '&raquo;',
            },
        },
        lengthMenu: [
            [10, 25, 50, 100], //cantidad
            [10, 25, 50, 100],//texto que se muestra
        ],
    });
    </script>
<!-- Google analytics script-->
<script type="text/javascript">
  if(document.location.hostname == 'pratikborsadiya.in') {
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
    ga('create', 'UA-72504830-1', 'auto');
    ga('send', 'pageview');
  }
</script>

<!-- para cuando se muestre el cargando, se oculte la imagen
. es cuando se carga por completo la pagina -->
<script type="text/javascript">
window.addEventListener('load', (event) => {
  console.log('page is fully loaded');
  $(".loader").fadeOut("slow");
});
</script>

</body>
</html>