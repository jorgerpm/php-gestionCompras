function abrirModalComparativo(val_datos) {

    console.log("val_datos::: ", val_datos);

    var numeroSol = val_datos.codigoSolicitud;

    console.log("numeroSol: ", numeroSol);

    if (numeroSol !== null && numeroSol !== '') {

        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';


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

                //ocultar el boton generarOC
                document.querySelector('#btnActionForm').style = 'display: none';
                document.querySelector('#btnRechazar').style = 'display: none';
            },
            error: function (error) {
                LOADING.style = 'display: none;';
                respuesta.html(error);
            }
        });

    } else {
        console.log("ingrese el codigo de solicitud.");
        swal("", "Ingrese el número de solicitud.", "warning");
    }


}




function abrirModalCodigoProducto(val_datosAux) {
    
    var obsComparativo = document.querySelector('#txtObsComp').value;

    if (obsComparativo !== null && obsComparativo !== '') {

        console.log("abrirModalCodigoProducto::: ", val_datosAux);

        var numeroSol = val_datosAux.codigoSolicitud;

        console.log("numeroSol: ", numeroSol);

        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';


        var numeroSolicitud = document.querySelector('#txtCodSolComp').value;
        var rucProveedor = document.querySelector('#txtRucProv').value;

        //para enviar solo la cotizacion sobre la que se debe generar la OC
        var val_datos=null;
        val_datosAux.map(v=> {
            console.log("dd: ", v);
            if(v.codigoSolicitud === numeroSolicitud && v.rucProveedor === rucProveedor){
                console.log("si igual");
                val_datos = v;
            }
            
        });

        var respuesta = $('#divCodigoProducto');

        $.ajax({
            type: 'POST',
            url: 'acciones/mostrarCodigoProducto.php',
            data: {'comparativoSelect': val_datos},
    //            cache: false,
    //            contentType: false,
    //            processData: false,
            success: function (data) {
    //                console.log(data);
                LOADING.style = 'display: none;';
                respuesta.html(data);

                $('#modalCodigoProducto').modal('show');

                document.querySelector('#modalCodigoProducto').style = 'background: rgba(0, 0, 0, .5);';

            },
            error: function (error) {
                LOADING.style = 'display: none;';
                respuesta.html(error);
            }
        });

    } else {
        swal("", "Debe ingresar una observación.", "warning");
    }
}

//$("#modalCodigoProducto").on("hidden.bs.modal", function () {
//    alert('se cierra');
//});