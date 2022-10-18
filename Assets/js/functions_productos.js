function openModalProducto(val_datos) {
    document.querySelector('#formProducto').reset();
    if(val_datos !== null){
        document.querySelector('#idProducto').value = val_datos.id;
        document.querySelector('#txtCodigoProducto').value = val_datos.codigoProducto;
        document.querySelector('#txtNombre').value = val_datos.nombre;
        document.querySelector('#txtValorUnitario').value = val_datos.valorUnitario;
        document.querySelector('#chkTieneIva').checked = val_datos.tieneIva == 1 ? true : false;
        document.querySelector('#listStatus').value = val_datos.idEstado;
    }
    else{
        document.querySelector('#idProducto').value = null;
    }
    $('#modalFormProducto').modal('show');
}