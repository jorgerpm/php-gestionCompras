function agregarFila() {
    //generar el id dinamico para el input del td nuevo que se crea
//    var tabla = document.getElementById('tblDetSolicitud');

    var tbody = document.getElementById('tbodySol');


//    let index = tabla.rows.length;
    var index = tbody.rows.length;

//    console.log("index tabla: ", index);
//    console.log("index tbody: ", tbody.rows.length);

    tbody.insertRow().innerHTML = '<td><input type="number" id="txtCantidad' + index + '" style="width: 100%"></td><td><input id="txtDetalle' + index + '" style="width: 100%; text-transform: uppercase;"></td><td><input id="' + index + '" type="button" value="x" onclick="eliminarFila(this);">'
            + '<input type="hidden" id="txtIdDetalle' + index + '" name="txtIdDetalle' + index + '" value="0"></td>';
}

function eliminarFila(input) {
//    let tabla = document.getElementById('tblDetSolicitud');
    var tbody = document.getElementById('tbodySol');

//        console.log(input.id);

    let index = input.id;

    tbody.deleteRow(index);
    //alert(tabla.rows[index].innerHTML);
    for (i = 0; i < tbody.rows.length; i++) {
        tbody.rows[i].cells[0].children[0].id = 'txtCantidad' + i;
        tbody.rows[i].cells[1].children[0].id = 'txtDetalle' + i;
        tbody.rows[i].cells[2].children[0].id = i;
        //para el input oculto
        tbody.rows[i].cells[2].children[1].id = 'txtIdDetalle' + i;

//            console.log(tabla.rows[i].cells[0].children[0].id);
//            console.log(tabla.rows[i].cells[1].children[0].id);
        console.log(tbody.rows[i].cells[2].children[1].id);
    }

}

function agregarCorreo() {
    var correoProv = document.getElementById('cmbProveed').value;
    if (correoProv !== null && correoProv !== '') {
        let correos = document.getElementById('txtCorreos');
        correos.value = correos.value + correoProv + ';';
        document.getElementById('cmbProveed').value = '';
    } else {
        swal('','Seleccione un proveedor de la lista.','warning');
    }
}


$('#formSolicitud').submit(function (e) {
    console.log('inicia la cargaaaa');
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';

    e.preventDefault(); //no se envíe el submit todavía

    var form = $(this);
    var respuesta = form.children('.RespuestaAjax');

    var formdata = new FormData(this);

    //adjuntar los campos de la tabla a enviar
//    let tabla = document.getElementById('tblDetSolicitud');
    var tbody = document.getElementById('tbodySol');

    formdata.append('registrosTabla', tbody.rows.length);

    for (i = 0; i < tbody.rows.length; i++) {
        //alert(tabla.rows[i].cells[0].innerHTML);
        let txtIdCantidad = 'txtCantidad' + i;
        let txtIdDetalle = 'txtDetalle' + i;
        let txtCodigoDetalle = 'txtIdDetalle' + i;
        let cant = document.getElementById(txtIdCantidad).value;
        let det = document.getElementById(txtIdDetalle).value;
        let idDetalle = document.getElementById(txtCodigoDetalle).value;
        //

        formdata.append(txtIdCantidad, cant);
        formdata.append(txtIdDetalle, det);
        formdata.append(txtCodigoDetalle, idDetalle);
    }


    $.ajax({
        type: 'POST',
        url: './acciones/guardarSolicitud.php',
        data: formdata ? formdata : form.serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            LOADING.style = 'display: none;';
            //console.log('fiiiinnn   successss');
            respuesta.html(data);
            document.getElementById("formSolicitud").reset();
        },
        error: function (error) {
            LOADING.style = 'display: none;';
            //console.log('fiiiinnn   errrroooorr: ', error);
            respuesta.html(error);
        }
    });
});

function abrirFormulario(val_datos) {

//    console.log(val_datos);
//    console.log("fechhaa::: ", new Date(val_datos.fechaSolicitud).toISOString().split('T')[0]);

    document.querySelector('#formSolicitud').reset();

    if (val_datos !== null) {
        document.querySelector('#txtId').value = val_datos.id;
        document.querySelector('#txtCodRC').value = val_datos.codigoRC;
        document.querySelector('#dtFechaSol').value = new Date(val_datos.fechaSolicitud).toISOString().split('T')[0];
        document.querySelector('#txtCorreos').value = val_datos.correos;
        document.querySelector('#txtObserv').value = val_datos.observacion;

        //ocultar los botones
        document.querySelector('#btnGuardaSolic').style = 'display: none;';
        document.querySelector('#btnAniadir').style = 'display: none;';


        //generar la tabla
//        let tabla = document.getElementById('tblDetSolicitud');
        var tbody = document.getElementById('tbodySol');
        let index = tbody.rows.length;

        for (i = 0; i < index; i++) {
            tbody.deleteRow(0);
        }

        for (i = 0; i < val_datos.listaDetalles.length; i++) {
//            console.log(val_datos.listaDetalles[i]);
            tbody.insertRow().innerHTML = '<td>' + val_datos.listaDetalles[i].cantidad + '</td>'
                    + '<td>' + val_datos.listaDetalles[i].detalle + '</td>'
                    + '<td></td>';

//            tbody.insertRow(-1).innerHTML = '<td><input type="number" id="txtCantidad' + (index + i) + '" style="width: 100%" value="' + val_datos.listaDetalles[i].cantidad + '"></td>'
//                    + '<td><input id="txtDetalle' + (index + i) + '" style="width: 100%; text-transform: uppercase;" value="' + val_datos.listaDetalles[i].detalle + '"></td>'
//                    + '<td><input id="' + (index + i) + '" type="button" value="x" onclick="eliminarFila(this);">'
//                    + '<input type="hidden" id="txtIdDetalle' + (index + i) + '" name="txtIdDetalle' + (index + i) + '" value="' + val_datos.listaDetalles[i].id + '"></td>';
        }

    } else {
        document.querySelector('#txtId').value = null;
    }

    $('#modalFormSolic').modal('show');
}