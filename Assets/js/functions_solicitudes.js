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
//    var correoProv = document.getElementById('cmbProveed').value;
//    if (correoProv !== null && correoProv !== '') {
//        let correos = document.getElementById('txtCorreos');
//        correos.value = correos.value + correoProv + ';';
//        document.getElementById('cmbProveed').value = '';
//    } else {
//        swal('','Seleccione un proveedor de la lista.','warning');
//    }
    var correo = document.querySelector("#correoHidden").value;
    if (correo !== null && correo !== '') {
        let correos = document.getElementById('txtCorreos');
        correos.value = correos.value + correo + ';';
        document.querySelector("#correoHidden").value = null;
        document.querySelector("#txtNombreProveedor").value = null;
    } else {
        swal('', 'Seleccione un proveedor de la lista.', 'warning');
    }
}


$('#formSolicitud').submit(function (e) {

    e.preventDefault(); //no se env??e el submit todav??a

    var tbody = document.getElementById('tbodySol');
    if (tbody.rows.length > 0) {

        console.log('inicia la cargaaaaxxxxxxxxxxxx');
        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';

        var form = $(this);
        var respuesta = form.children('.RespuestaAjax');

        var formdata = new FormData(this);

        //adjuntar los campos de la tabla a enviar
//    let tabla = document.getElementById('tblDetSolicitud');


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
                console.log('fiiiinnn   successss', data);
                respuesta.html(data);
//            if(data.includes("success"))
//                window.location.href = "solicitudCotizacion";
            },
            error: function (error) {
                LOADING.style = 'display: none;';
                console.log('fiiiinnn   errrroooorr: ', error);
                respuesta.html(error);
            },
            statusCode: {
                404: function () {
//              alert( "page not found" );
                }
            }
        }).done(function (data) {
//        console.log("se hixxoooo", data);//tambien
        })
                .fail(function () {
//    alert( "error" );
                })
                .always(function () {
//    alert( "complete" );
                });

    } else {
        swal("", "Ingrese los detalles a la solicitud.", "warning");
    }

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
        document.querySelector('#txtCodsol').value = val_datos.codigoSolicitud;

        document.querySelector('#txtMontoAprob').value = val_datos.montoAprobado;
        document.querySelector('#dtFechaAprobRC').value = new Date(val_datos.fechaAutorizaRC).toISOString().split('T')[0];
        document.querySelector('#txtEstadoRC').value = val_datos.estadoRC;

        //ocultar los botones
        document.querySelector('#btnGuardaSolic').style = 'display: none;';
        document.querySelector('#btnAniadir').style = 'display: none;';
        document.querySelector('#fileDetalles').style = 'display: none;';



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


function cargarProveedor(input) {
    console.log(input.value);

    $.ajax({
        type: 'POST',
        url: 'acciones/buscarProveedorNombre.php',
        data: {'txtNombreProveedor': input.value}
    })
            .done(function (listas_rep) {

                var tam = document.querySelector("#losli").childNodes.length;
                console.log("dd:: ", tam);
                for (let i = 0; i < tam; i++) {
                    document.querySelector("#losli").removeChild(document.querySelector("#losli").childNodes[0]);
                }

                if (listas_rep) {
                    var proveedores = JSON.parse(listas_rep);
                    console.log(proveedores);
                    proveedores.forEach(prov => {
//                const option = document.createElement('option');
                        const li = document.createElement('li');
                        li.setAttribute("id", prov.correo);
                        li.setAttribute("onclick", "seleccionProv(this);")
                        li.appendChild(document.createTextNode(prov.razonSocial));
//                li.style = 'cursor: pointer; padding: 2px 10px 2px 10px; display: block';
                        li.setAttribute("class", "liProveedor");
//                li.css("", "");
                        document.querySelector("#losli").appendChild(li);
//                option.value = prov.correo;
//                option.text = prov.razonSocial;
//                $select.appendChild(option);
                    });
                }
//            $("#cmbProveed").attr("size", proveedores.length);
//            $("#cmbProveed").css("position","fixed");
            })
            .fail(function () {
                alert('Hubo un errror al cargar los v??deos')
            });
}

function seleccionProv(li) {
    console.log("siii: ", li.id);
    var tam = document.querySelector("#losli").childNodes.length;
//        console.log("dd:: ", tam);

    document.querySelector("#txtNombreProveedor").value = li.innerHTML;
    document.querySelector("#correoHidden").value = li.id;

    for (let i = 0; i < tam; i++) {
        document.querySelector("#losli").removeChild(document.querySelector("#losli").childNodes[0]);
    }

}


///// para cargar los detalles
const fileSelector = document.getElementById('fileDetalles');
fileSelector.addEventListener('change', (event) => {
    const file = event.target.files[0];
    console.log(file);

    let reader = new FileReader();
    reader.onload = (e) => {
        // Cuando el archivo se termin?? de cargar
        let lines = parseCSV(e.target.result);
        let output = reverseMatrix(lines);
        let lineas = output[0];
        console.log("la respuesta: ", lineas);

        //ahora agreagr a la pagina
        for (i = 1; i < lineas.length; i++) {
            if (lineas[i] !== null && lineas[i] !== "") {
                var tbody = document.getElementById('tbodySol');
                var index = tbody.rows.length;

                let columnas = lineas[i].split(";");

                console.log("lineas: ", columnas);

                tbody.insertRow().innerHTML = '<td><input type="number" id="txtCantidad' + index + '" style="width: 100%" value="' + columnas[0] + '"></td>'
                        + '<td><input id="txtDetalle' + index + '" style="width: 100%; text-transform: uppercase;" value="' + columnas[1] + '"></td>'
                        + '<td><input id="' + index + '" type="button" value="x" onclick="eliminarFila(this);">'
                        + '<input type="hidden" id="txtIdDetalle' + index + '" name="txtIdDetalle' + index + '" value="0"></td>';
            }
        }


    };
    // Leemos el contenido del archivo seleccionado
    reader.readAsBinaryString(file);

    fileSelector.value = null;

});


function parseCSV(text) {
    // Obtenemos las lineas del texto
    let lines = text.replace(/\r/g, '').split('\n');
    return lines.map(line => {
        // Por cada linea obtenemos los valores
        let values = line.split(',');
        return values;
    });
}

function reverseMatrix(matrix) {
    let output = [];
    // Por cada fila
    matrix.forEach((values, row) => {
        // Vemos los valores y su posicion
        values.forEach((value, col) => {
            // Si la posici??n a??n no fue creada
            if (output[col] === undefined)
                output[col] = [];
            output[col][row] = value;
        });
    });
    return output;
}