<?php require_once 'Template/Modals/modalRol.php'; ?>
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Gestión de proveedores</h1>
            <p>crear y editar proveedores</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Cargar Xml</a></li>
        </ul>
    </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <div class="table-responsive">
                        <div>
                            <p><button class="btn btn-primary btn-sm fa" type="button" onclick="openModal();"><i class="fas fa-plus-circle"></i> Nuevo</button></p>
                        </div>
                        <table class="table table-hover table-bordered" id="sampleTable">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>nombre</th>
                                    <th>ruc</th>
                                    <th>código JD</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php require_once './Controllers/proveedorControlador.php';
                                foreach ($respuesta as $listaProveedor) { ?>
                                    <tr>
                                        <td><?php echo $listaProveedor->id ?></td>
                                        <td><?php echo $listaProveedor->nombre ?></td>
                                        <td><?php echo $listaProveedor->ruc ?></td>
                                        <td><?php echo $listaProveedor->codigoJD ?></td>
                                        <td>
                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                <button class="btn btn-info fa fa-edit" type="button"></button>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Essential javascripts for application to work-->
<script src="./Assets/js/jquery-3.3.1.min.js"></script>
<script src="./Assets/js/popper.min.js"></script>
<script src="./Assets/js/bootstrap.min.js"></script>
<script src="./Assets/js/main.js"></script>
<!-- The javascript plugin to display page loading on top-->
<script src="./Assets/js/plugins/pace.min.js"></script>
<!-- Page specific javascripts-->
<!-- Data table plugin-->
<script type="text/javascript" src="./Assets/js/plugins/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="./Assets/js/plugins/dataTables.bootstrap.min.js"></script>
<script type="text/javascript">$('#sampleTable').DataTable();</script>
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