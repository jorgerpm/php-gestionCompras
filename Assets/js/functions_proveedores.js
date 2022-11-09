function openModalProveedor(val_datos) {
    document.querySelector('#formProveedor').reset();
    if(val_datos !== null){
        document.querySelector('#idProveedor').value = val_datos.id;
        document.querySelector('#txtNombreComercial').value = val_datos.nombreComercial;
        document.querySelector('#txtRazonSocial').value = val_datos.razonSocial;
        document.querySelector('#txtDireccion').value = val_datos.direccion;
        document.querySelector('#txtTelefono1').value = val_datos.telefono1;
        document.querySelector('#txtTelefono2').value = val_datos.telefono2;
        document.querySelector('#txtCorreo').value = val_datos.correo;
        document.querySelector('#txtRuc').value = val_datos.ruc;
        document.querySelector('#txtCodigoJD').value = val_datos.codigoJD;
        document.querySelector('#cbxListaEstado').value = val_datos.idEstado;
    }
    else{
        document.querySelector('#idProveedor').value = null;
    }
    $('#modalFormProveedor').modal('show');
}

var inputFileCsv = document.querySelector("#inputFileCsv");
var btnCargarArchivo = document.querySelector("#btnCargarArchivo");
var valorDiv = $('.RespuestaAjax');
// Upload file
btnCargarArchivo.addEventListener("click", () => {
    if(inputFileCsv.files.length > 0 ) {
        let formData = new FormData();
        formData.append("archivo", inputFileCsv.files[0]); // En la posición 0; es decir, el primer elemento
        fetch("./acciones/cargaMasivaProveedores.php", {
            method: 'POST',
            body: formData,
        })
        .then(respuesta => respuesta.text())
            .then(decodificado => {
                //console.log(decodificado);
                //console.log(valorDiv);
                valorDiv.html(decodificado);
                
            });
        
    } else {
        // El usuario no ha seleccionado archivos
        swal("", "Ningún archivo seleccionado", "warning");
    }
});