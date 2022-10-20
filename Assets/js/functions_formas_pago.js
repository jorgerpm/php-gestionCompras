function openModalFormaPago(val_datos) {
    document.querySelector('#formFormaPago').reset();
    if(val_datos !== null){
        document.querySelector('#idFormaPago').value = val_datos.id;
        document.querySelector('#txtNombre').value = val_datos.nombre;
        document.querySelector('#listStatus').value = val_datos.idEstado;
    }
    else{
        document.querySelector('#idFormaPago').value = null;
    }
    $('#modalFormFormaPago').modal('show');
}