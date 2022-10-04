function openModalEstado(val_datos) {
    document.querySelector('#formEstado').reset();
    if(val_datos !== null){
        document.querySelector('#idEstado').value = val_datos.id;
        document.querySelector('#txtNombre').value = val_datos.nombre;
    }
    else{
        document.querySelector('#idEstado').value = null;
    }
    $('#modalFormEstado').modal('show');
}