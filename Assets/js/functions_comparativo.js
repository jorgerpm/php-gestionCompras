function abrirModalComparativo(val_datos){
    
    console.log("val_datos::: ", val_datos);
    
    var numeroSol = val_datos.codigoSolicitud;
    
    console.log("numeroSol: ", numeroSol);
    
    if(numeroSol !== null && numeroSol !== ''){
        
        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';

        //ocultar el boton generarOC
        document.querySelector('#btnActionForm').style = 'display: none';

        var respuesta = $('#divComparativo');

        $.ajax({
            type: 'POST',
            url: 'acciones/mostrarComparativo.php',
            data: {'comparativoSelect': val_datos},
//            cache: false,
//            contentType: false,
//            processData: false,
            success: function (data) {
//                console.log(data);
                LOADING.style = 'display: none;';
                respuesta.html(data);

                $('#modalComparativo').modal('show');
            },
            error: function (error) {
                LOADING.style = 'display: none;';
                respuesta.html(error);
            }
        });
    
    }
    else{
        console.log("ingrese el codigo de solicitud.");
        swal("", "Ingrese el número de solicitud.", "warning");
    }
    
    
}