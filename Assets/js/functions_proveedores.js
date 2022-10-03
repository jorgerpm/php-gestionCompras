function openModalProveedor(val_datos) {
    document.querySelector('#formProveedor').reset();
    if(val_datos !== null){
        document.querySelector('#idProveedor').value = val_datos.id;
        document.querySelector('#txtNombre').value = val_datos.nombre;
        document.querySelector('#txtRuc').value = val_datos.ruc;
        document.querySelector('#txtCodigoJD').value = val_datos.codigoJD;
    }
    else{
        document.querySelector('#idProveedor').value = null;
    }
    $('#modalFormProveedor').modal('show');
}