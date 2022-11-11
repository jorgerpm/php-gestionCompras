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
//            info: 'Mostrando p&aacute;gina _PAGE_ de _PAGES_',
            info: 'Mostrando del _START_ al _END_ de _MAX_',
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