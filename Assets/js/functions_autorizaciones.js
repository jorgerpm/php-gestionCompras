function abrirFormularioAut(val_datos) {
    document.getElementById('txtIdOrdenCompra').value = val_datos.id;
    document.getElementById('txtNumRCModal').value = val_datos.codigoRC;

    document.getElementById('txtEstadoModal').value = val_datos.estado;
    document.getElementById('txtValTotalModal').value = val_datos.total;
    document.getElementById('txtFechaOCModal').value = new Date(val_datos.fechaOrdenCompra).toISOString().split('T')[0];
    
    //si tiene detalle mostrar los detalles
//    console.log("ago");
//    console.log(val_datos.listaAutorizaciones);
    cargarUsuariosInit(val_datos.listaAutorizaciones, val_datos.codigoRC);

    $('#modalAutorizaciones').modal('show');
}

function cargarUsuariosInit(usuariosAut, numRC){
    var tbody = document.getElementById('tbodyAutor');
    var ixb = tbody.rows.length;
    
    //primero eliminar todo el tbodyautor
    for (let i = 0; i < ixb; i++) {
        tbody.deleteRow(0);
    }
    
    var index = usuariosAut.length;
    for (let i = 0; i < index; i++) {
        var fila = tbody.insertRow();
        fila.insertCell().innerHTML = numRC;
        fila.insertCell().innerHTML = usuariosAut[i].nombreUsuario + '<input type="hidden" id="txtIdUserModal' + i + '" value="' + usuariosAut[i].idUsuario + '">' + '<input type="hidden" id="txtIdAutorModal' + i + '" value="' + usuariosAut[i].id + '">';
        fila.insertCell().innerHTML = usuariosAut[i].estado;
        fila.insertCell().innerHTML = '<input id="' + i + '" type="button" value="x" onclick="eliminarFilaModal(this);" class="btn btn-secondary btn-sm fa">';
    }
}

function agregarUserModal() {
    var usuario = document.getElementById('cmbUserList').value;
    if (usuario !== null && usuario !== '') {


        var datuser = usuario.split("#"); //pos=0 es el nombre, en el 1 es el id del user
        console.log(datuser);

        var tbody = document.getElementById('tbodyAutor');
        var index = tbody.rows.length; //este solo debe tener 4 maximo

        //validar si ya existe el usuario en la tala
        var existe = false;
        for (let i = 0; i < index; i++) {
            var iduser = document.getElementById('txtIdUserModal' + i).value;
            if (iduser === datuser[1]) {
                existe = true;
            }
        }

        if (existe) {
            swal("", "El usuario seleccionado ya se encuentra en la lista.", "error")
        } else {
            var fila = tbody.insertRow();

            var numRC = document.getElementById('txtNumRCModal').value;
            if (index < 4) {
                fila.insertCell().innerHTML = numRC;
                fila.insertCell().innerHTML = datuser[0] + '<input type="hidden" id="txtIdUserModal' + index + '" value="' + datuser[1] + '">' + '<input type="hidden" id="txtIdAutorModal' + index + '" value="">';
                fila.insertCell().innerHTML = "";
                fila.insertCell().innerHTML = '<input id="' + index + '" type="button" value="x" onclick="eliminarFilaModal(this);" class="btn btn-secondary btn-sm fa">';
            } else {
                swal("", "Solo se permite un máximo de 4 usuarios.", "error");
            }
        }

        document.getElementById('cmbUserList').value = '';
    } else {
        swal('', 'Seleccione un usuario de la lista.', 'warning');
    }
}


function eliminarFilaModal(input) {
    var tbody = document.getElementById('tbodyAutor');
    let index = input.id;
    
    //colocar en una lista para enviar a elimimnar en la base de datos
    var idAutorElimn = document.querySelector('#txtIdAutorModal'+index).value;
    console.log("usr a elimnar : ", idAutorElimn);
    //solo si tiene ya un id desde la base se manda a eliminar al servicio
    if(idAutorElimn !== null && idAutorElimn !== ""){
        var txtElimina = document.querySelector('#txtEliminaUser').value;
        txtElimina = txtElimina !== null ? txtElimina : "";
        txtElimina = txtElimina + "" + idAutorElimn + ",";
        document.querySelector('#txtEliminaUser').value = txtElimina;
    }
    //
    
    tbody.deleteRow(index);
    for (i = 0; i < tbody.rows.length; i++) {
        tbody.rows[i].cells[1].children[0].id = "txtIdUserModal" + i;
        tbody.rows[i].cells[1].children[1].id = "txtIdAutorModal" + i;
        tbody.rows[i].cells[3].children[0].id = i;
    }
}

function guardarAutorizadores(){
    
}

$('.FormularioAutorizadores').submit(function (e) {
    console.log('inicia la cargaaaa');
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    e.preventDefault(); //no se envíe el submit todavía

    var form = $(this);

    
    var accion = form.attr('action');
    var metodo = form.attr('method');
    var valorDiv = form.children('.RespuestaAjax');

    
    var formdata = new FormData(this);

//leer la tabla de los usuarios para enviar a guardar la lista de users.
    var tbody = document.getElementById('tbodyAutor');

    formdata.append('registrosTabla', tbody.rows.length);

    for (i = 0; i < tbody.rows.length; i++) {
        let txtIdUsuario = 'txtIdUserModal' + i;
        let idUser = document.getElementById(txtIdUsuario).value;
        formdata.append(txtIdUsuario, idUser);
    }

    $.ajax({
        type: metodo,
        url: accion,
        data: formdata ? formdata : form.serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            LOADING.style = 'display: none;';
            console.log('fiiiinnn   successss');
            valorDiv.html(data);
            //cerrar el popup
//            $('#modalAutorizaciones').modal('hide');
        },
        error: function (error) {
            LOADING.style = 'display: none;';
            console.log('fiiiinnn   errrroooorr');
            valorDiv.html(error);
        }
    });
});



function abrirModalChecklist(val_datos) {
    document.getElementById('txtIdOrdenCompra').value = val_datos.id;
    document.getElementById('txtNumRCRecep').value = val_datos.codigoRC;

    document.getElementById('txtEstadoRecep').value = val_datos.estado;
    document.getElementById('txtValTotalRecep').value = val_datos.total;
    document.getElementById('txtFechaOCRecep').value = new Date(val_datos.fechaOrdenCompra).toISOString().split('T')[0];
    
    //si tiene detalle mostrar los detalles
//    console.log("ago");
//    console.log(val_datos.listaAutorizaciones);
    //cargarUsuariosInit(val_datos.listaAutorizaciones, val_datos.codigoRC);

    $('#modalRecepcion').modal('show');
}


//function agregarUserCheckList() {
//    var usuario = document.getElementById('cmbUserList').value;
//    if (usuario !== null && usuario !== '') {
//
//
//        var datuser = usuario.split("#"); //pos=0 es el nombre, en el 1 es el id del user
//        console.log(datuser);
//
//        var tbody = document.getElementById('tbodyAutor');
//        var index = tbody.rows.length; //este solo debe tener 4 maximo
//
//        //validar si ya existe el usuario en la tala
//        var existe = false;
//        for (let i = 0; i < index; i++) {
//            var iduser = document.getElementById('txtIdUserModal' + i).value;
//            if (iduser === datuser[1]) {
//                existe = true;
//            }
//        }
//
//        if (existe) {
//            swal("", "El usuario seleccionado ya se encuentra en la lista.", "error")
//        } else {
//            var fila = tbody.insertRow();
//
//            var numRC = document.getElementById('txtNumRCModal').value;
//            if (index < 4) {
//                fila.insertCell().innerHTML = numRC;
//                fila.insertCell().innerHTML = datuser[0] + '<input type="hidden" id="txtIdUserModal' + index + '" value="' + datuser[1] + '">';
//                fila.insertCell().innerHTML = "";
//                fila.insertCell().innerHTML = '<input id="' + index + '" type="button" value="x" onclick="eliminarFilaModal(this);" class="btn btn-secondary btn-sm fa">';
//            } else {
//                swal("", "Solo se permite un máximo de 4 usuarios.", "error")
//            }
//        }
//
//        document.getElementById('cmbUserList').value = '';
//    } else {
//        swal('', 'Seleccione un usuario de la lista.', 'warning');
//    }
//}