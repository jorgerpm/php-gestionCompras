function openModalMenu(val_datos) {
    document.querySelector('#formMenu').reset();
    if(val_datos !== null){
        document.querySelector('#idMenu').value = val_datos.id;
        document.querySelector('#txtTitulo').value = val_datos.titulo;
        document.querySelector('#txtLink').value = val_datos.link;
        document.querySelector('#txtImagen').value = val_datos.imagen;
        document.querySelector('#cbxListaMenu').value = val_datos.idMenu;
        document.querySelector('#cbxListaEstado').value = val_datos.idEstado;
    }
    else{
        document.querySelector('#idMenu').value = null;
    }
    $('#modalFormMenu').modal('show');
}