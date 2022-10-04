function openModalParametro(val_datos) {
    document.querySelector('#formParametro').reset();
    if(val_datos !== null){
        document.querySelector('#idParametro').value = val_datos.id;
        document.querySelector('#txtNombre').value = val_datos.nombre;
        document.querySelector('#txtValor').value = val_datos.valor;
        document.querySelector('#cbxListaEstado').value = val_datos.idEstado;
    }
    else{
        document.querySelector('#idParametro').value = null;
    }
    $('#modalFormParametro').modal('show');
}