function openModalPregunta(val_datos) {
    document.querySelector('#formPregunta').reset();
    if(val_datos !== null){
        document.querySelector('#idPregunta').value = val_datos.id;
        document.querySelector('#txtPregunta').value = val_datos.pregunta;
        document.querySelector('#listRoles').value = val_datos.rol.id;
        document.querySelector('#listStatus').value = val_datos.idEstado;
        //document.querySelector('#checkList').checked = val_datos.cheklistRecepcion == 1 ? true : false;
    }
    else{
        document.querySelector('#idPregunta').value = null;
    }

    $('#modalPregunta').modal('show');
}