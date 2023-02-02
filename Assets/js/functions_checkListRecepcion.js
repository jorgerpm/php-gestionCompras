


function eliminarFilaRecep(input) {
    var tbody = document.getElementById('tbodyRecep');
    let index = input.id;
    tbody.deleteRow(index);
    for (i = 0; i < tbody.rows.length; i++) {
        
        tbody.rows[i].cells[0].children[0].id = "txtIdRolRecep" + i;
        tbody.rows[i].cells[1].children[0].id = "txtIdUserRecep" + i;
        tbody.rows[i].cells[3].children[0].id = "i"+i;
    }
}



$('.FormularioRecepciones').submit(function (e) {
    e.preventDefault(); //no se envíe el submit todavía
    
    //leer la tabla de los usuarios para enviar a guardar la lista de users.
    var tbody = document.getElementById('tbodyRecep');
    
    if(tbody.rows.length > 0){

        console.log('inicia la cargaaaa');
        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';

        var form = $(this);

        var accion = form.attr('action');
        var metodo = form.attr('method');
        var valorDiv = form.children('.RespuestaAjaxRecep');

        var formdata = new FormData(this);

        formdata.append('registrosTabla', tbody.rows.length);

        for (i = 0; i < tbody.rows.length; i++) {
            let txtIdUsuario = 'txtIdUserRecep' + i;
            let idUser = document.getElementById(txtIdUsuario).value;
            formdata.append(txtIdUsuario, idUser);

            //para el rol que tambien se guarde
            let txtIdRolRecep = 'txtIdRolRecep' + i;
            let idRol = document.getElementById(txtIdRolRecep).value;
            formdata.append(txtIdRolRecep, idRol);
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
    }
    else{
        swal("", "Debe ingresar al menos un usuario a la lista.", "warning");
    }
});



function abrirModalChecklist(val_datos) {
    console.log(";;", val_datos);
    document.getElementById('txtIdOrdenCompraRecep').value = val_datos.id;
    document.getElementById('txtNumRCRecep').value = val_datos.codigoRC;

    document.getElementById('txtEstadoRecep').value = val_datos.estado;
    document.getElementById('txtValTotalRecep').value = val_datos.total;
    document.getElementById('txtFechaOCRecep').value = new Date(val_datos.fechaOrdenCompra).toISOString().split('T')[0];
    
//    var tbody = document.getElementById('tbodyRecep');
//    for (i = 0; i < tbody.rows.length; i++) {
//        tbody.deleteRow(0);
//    }
    
    //si tiene detalle mostrar los detalles
//    console.log("ago");
//    console.log(val_datos.listaAutorizaciones);
    //cargarUsuariosInit(val_datos.listaAutorizaciones, val_datos.codigoRC);

    $('#modalRecepcion').modal('show');
}


function agregarUserCheckList() {
    var user = document.getElementById('cmbUserListRecep');
    if(user === null){
        swal('', 'Seleccione un rol y un usuario de la lista.', 'warning');
        return false;
    }
    var usuario = user.value;
    if (usuario !== null && usuario !== '') {

        var rolid = document.getElementById('cmbRolListRecep').value;


        var datuser = usuario.split("#"); //pos=0 es el nombre, en el 1 es el id del user, el 2=correo
        console.log(datuser);

        var tbody = document.getElementById('tbodyRecep');
        var index = tbody.rows.length; //este solo debe tener 4 maximo

        //validar si ya existe el usuario en la tala
        var existe = false;
        for (let i = 0; i < index; i++) {
            var iduser = document.getElementById('txtIdUserRecep' + i).value;
            if (iduser === datuser[1]) {
                existe = true;
            }
        }
        
        //si ya existe el rol en la tabla
        var existeRol = false;
        for (let i = 0; i < index; i++) {
            var idRoll = document.getElementById('txtIdRolRecep' + i).value;
            if (idRoll === rolid) {
                existeRol = true;
            }
        }

        if (existe) {
            swal("", "El usuario seleccionado ya se encuentra en la lista.", "error");
        }else if (existeRol) {
            swal("", "El rol seleccionado ya se encuentra en la lista.", "error");
        } else {
            var fila = tbody.insertRow();

            var tieneCamposBodega = document.getElementById('chkCampoBodega').checked;
            var tieneFechaAprob = document.getElementById('chkFechaAprob').checked;
            
            console.log("campos:: ", tieneCamposBodega);

            //var numRC = document.getElementById('txtNumRCRecep').value;
//            if (index < 4) {
                fila.insertCell().innerHTML = datuser[3] + '<input type="hidden" id="txtIdRolRecep' + index + '" value="' + rolid + '">';
                fila.insertCell().innerHTML = datuser[0] + '<input type="hidden" id="txtIdUserRecep' + index + '" value="' + datuser[1] + '">';
                fila.insertCell().innerHTML = datuser[2];
                fila.insertCell().innerHTML = '<input id="i' + index + '" type="button" value="x" onclick="eliminarFilaRecep(this);" class="btn btn-secondary btn-sm fa">'
                +'<input id="txtCampoBodega' + index + '" name="txtCampoBodega' + index + '" type="hidden" value="'+(tieneCamposBodega === true ? 'SI' : 'NO')+'">'
                +'<input id="txtFechaAprob' + index + '" name="txtFechaAprob' + index + '" type="hidden" value="'+(tieneFechaAprob === true ? 'SI' : 'NO')+'">';
                
                
//            } else {
//                swal("", "Solo se permite un máximo de 4 usuarios.", "error")
//            }
        }

        document.getElementById('cmbRolListRecep').value = '';
        document.getElementById('cmbUserListRecep').value = '';
        document.getElementById('chkCampoBodega').checked = false;
        document.getElementById('chkFechaAprob').checked = false;
        
    } else {
        swal('', 'Seleccione un usuario de la lista.', 'warning');
    }
}



function abrirModalRecepcion(val_datos, verGuardar){
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    console.log("checklist: ", val_datos);
    
    var valorDiv = document.querySelector('#divChecklistRecep');
    
    $.ajax({
        type: "POST",
        url: "acciones/mostrarCheckListRecepcion.php",
        data: {'dataChecklistRecep': val_datos},
//        cache: false,
//        contentType: false,
//        processData: false,
        success: function (data) {
            LOADING.style = 'display: none;';
//            console.log('fiiiinnn   successss: ', data);
            if(data.includes("window.location.replace")){
                window.location.replace("index");
            }
            valorDiv.innerHTML = (data);
            
            //bloquear el boton guardar si el estado ya es COMPLETO
            document.querySelector('#btnActionForm').style = '';
            document.querySelector('#btnImprimir').style = '';
//            
            if(val_datos.estado === "COMPLETO" || verGuardar === 0){//si es cero no muestra el boton guardar, si es 1 si muestra el boton guardar
                document.querySelector('#btnActionForm').style = 'display: none;';
            }
            if(verGuardar === 1)//es 1 para la pantalla de completar checklist
                document.querySelector('#btnImprimir').style = 'display: none;';
            //cerrar el popup
//            $('#modalAutorizaciones').modal('hide');
        },
        error: function (error) {
            LOADING.style = 'display: none;';
            //console.log('fiiiinnn   errrroooorr');
            if(error.includes("window.location.replace")){
                window.location.replace("index");
            }
            valorDiv.innerHTML = (error);
        }
    });

    $('#modalChecklist').modal('show');
    
}



$('#FormularioChecklistRecepcion').submit(function (e) {
    console.log('inicia la cargaaaa');
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    e.preventDefault(); //no se envíe el submit todavía

    var form = $(this);

    var accion = form.attr('action');
    var metodo = form.attr('method');
    var valorDiv = form.children('.RespuestaAjaxCheckListRecep');
    
    var formdata = new FormData(this);

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
        },
        error: function (error) {
            LOADING.style = 'display: none;';
            console.log('fiiiinnn   errrroooorr');
            valorDiv.html(error);
        }
    });
});




function buscarUserRol(cmbRol){
    console.log("combo: ", cmbRol.value);
    
    console.log("combo: ", cmbRol.form);
    
    var valorDiv = $('#divCmbUsers');
    
    $.ajax({
        type: "POST",
        url: "acciones/mostrarUsuariosPorRol.php",
        data: {"idComboRol": cmbRol.value},
//        cache: false,
//        contentType: false,
//        processData: false,
        success: function (data) {
//            console.log("data: ", data);
            valorDiv.html(data);
        },
        error: function (error) {
            valorDiv.html(error);
        }
    });
}

