function toggle(source, cantDetalles) {
    for (j = 1; j <= cantDetalles; j++) {
        var checkboxes = document.querySelectorAll('input[id="chkIva' + [j] + '"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }

    valorTotal(cantDetalles);
}

function valorTotalDetalle(index, cantDetalles) {
    //calcular el valor del registro actual
    var cantidad = parseFloat(document.getElementById('lblCantidad' + index).innerHTML);
    var txtValUnit = document.getElementById('txtValorUnitario' + index).value;
    var valUnit = 0;
    if (!isNaN(txtValUnit) && txtValUnit !== '') {
        valUnit = parseFloat(txtValUnit);
    }
    var valTotalDet = cantidad * valUnit;
    console.log("valTotalDet: ", valTotalDet);
    
    //este metodo "formatNumber.new" esta en el archivo main.js
    document.getElementById('lblValorTotal' + index).innerHTML = miFormatoNumber.new(valTotalDet, CANT_DECIMALES);//aqui estaba con 4 decimales

    valorTotal(cantDetalles);
}

function valorTotal(cantDetalles) {
    //recorrer todos los registros para obtener el subtotal
    let subtotal = 0;
    let subtotalSinIva = 0;
    for (j = 1; j <= cantDetalles; j++) {

        var lblValTotal = document.getElementById('lblValorTotal' + j).innerHTML;
        lblValTotal = lblValTotal.replace(",", "");
        
        var tieneIva = document.getElementById('chkIva' + j).checked;

        if (!isNaN(lblValTotal) && lblValTotal !== '') {
            
            if (tieneIva)
                subtotal += parseFloat(lblValTotal);
            else
                subtotalSinIva += parseFloat(lblValTotal);
        }
    }
    document.getElementById('lblSubtotal').innerHTML = miFormatoNumber.new(subtotal, CANT_DECIMALES);
    document.getElementById('lblSubtotalSinIva').innerHTML = miFormatoNumber.new(subtotalSinIva, CANT_DECIMALES);

//porcentaje del iva
    const porcentajeIva = document.getElementById("porcentajeIva").value;

    var iva = subtotal * parseFloat(parseFloat(porcentajeIva)/100);
    //var iva = subtotal * 0.12;
    document.getElementById('lblIva').innerHTML = miFormatoNumber.new(iva, CANT_DECIMALES);
    var total = subtotalSinIva + subtotal + iva;
    document.getElementById('lblTotal').innerHTML = miFormatoNumber.new(total, CANT_DECIMALES);
}

//enviar a guardar la cotizacion
$('#frmCotizacion').submit(function (e) {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';

    e.preventDefault(); //no se envíe el submit todavía
    
    //comprobar que si exista el proveedor buscado
    if(document.querySelector("#txtRazonSocial").value === null || document.querySelector("#txtRazonSocial").value === ''){
        console.log("NOOOO existe la razon social");
        swal('','COMPLETE LOS DATOS DEL PROVEEDOR','warning');
        LOADING.style = 'display: none;';
    }
    else{
        console.log("SII existe la razon social");

        //obtener los datos de los totales
        var lblSubtotal = document.getElementById('lblSubtotal').innerHTML;
        var lblSubtotalSinIva = document.getElementById('lblSubtotalSinIva').innerHTML;
        var lblIva = document.getElementById('lblIva').innerHTML;
        var lblTotal = document.getElementById('lblTotal').innerHTML;

        //obtener datos de los detalles
        var regs = document.getElementById('registrosTabla').value;
        var listaDetalles = new Array();
        for (i = 1; i <= regs; i++) {
            const detalle = {
                cantidad: document.getElementById('lblCantidad' + i).innerHTML,
                detalle: document.getElementById('lblDetalle' + i).innerHTML,
                observDetalle: document.getElementById('txtObservDetalle' + i).value,
                tieneIva: document.getElementById('chkIva' + i).checked,
                valorUnitario: document.getElementById('txtValorUnitario' + i).value,
                valorTotal: document.getElementById('lblValorTotal' + i).innerHTML,
            };
            listaDetalles.push(detalle);
        }


        var form = $(this);

        var accion = form.attr('action');
        var metodo = form.attr('method');

        var respuesta = form.children('.RespuestaAjax');

        var formdata = new FormData(this);

        formdata.append('lblSubtotal', lblSubtotal);
        formdata.append('lblSubtotalSinIva', lblSubtotalSinIva);
        formdata.append('lblIva', lblIva);
        formdata.append('lblTotal', lblTotal);

        formdata.append('listaDetalles', JSON.stringify(listaDetalles));

        console.log(listaDetalles);

        $.ajax({
            type: metodo,
            url: accion,
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                LOADING.style = 'display: none;';
                respuesta.html(data);
                document.getElementById("frmCotizacion").reset();
            },
            error: function (error) {
                LOADING.style = 'display: none;';
                respuesta.html(error);
            }
        });
        
    }
});

//funcion para buscar al cotizacion por codigoRC
function buscarCotizacion() {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';

    var codigoSol = document.getElementById('txtCodSol').value;

    var respuesta = document.getElementsByClassName('RespuestaAjax')[0];

    console.log(respuesta);

    var form = document.forms[0];

    console.log(form);

    var formdata = new FormData(document.querySelector('form'));



    $.ajax({
        type: 'GET',
        url: 'acciones/buscarCotizacionPorNumero.php?codigoSol=' + codigoSol,
        data: formdata ? formdata : form.serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            LOADING.style = 'display: none;';
            var cot = JSON.parse(data);
            console.log(cot);
//            console.log(cot.id);

            if (cot && cot.id > 0) {
                abrirFormulario(cot);
            } else {
                swal("", "No existe cotización con el código de solicitud ingresado.", "warning");
            }

        },
        error: function (cot) {
            LOADING.style = 'display: none;';
            //respuesta.html(error);
        }
    });
}


function abrirFormulario(val_datos) {

    console.log(val_datos);
//    console.log("fechhaa::: ", new Date(val_datos.fechaSolicitud).toISOString().split('T')[0]);

    document.querySelector('#frmCotizacion').reset();

    console.log("ssss: ", document.querySelector('#modalFormCotiz'));

    if (val_datos !== null) {
        document.querySelector('#txtIdCot').value = val_datos.id;
        document.querySelector('#txtCodigoRc').value = val_datos.codigoRC;
        document.querySelector('#txtFecha').value = new Date(val_datos.fechaCotizacion).toISOString().split('T')[0];
        document.querySelector('#txtRubrosAdicionales').value = val_datos.adicionales;
        document.querySelector('#txtObservaciones').value = val_datos.observacion;
        document.querySelector('#txtCodSol').value = val_datos.codigoSolicitud;

        document.querySelector('#txtCodigoCotizacion').value = val_datos.codigoCotizacion;
        document.querySelector('#txtRuc').value = val_datos.rucProveedor;

        document.querySelector('#txtDireccion').value = val_datos.proveedorDto.direccion;
        document.querySelector('#txtRazonSocial').value = val_datos.proveedorDto.razonSocial;
        document.querySelector('#txtTelefono').value = val_datos.proveedorDto.telefono1;
        document.querySelector('#txtDireccion').value = val_datos.proveedorDto.direccion;
        document.querySelector('#txtCorreo').value = val_datos.proveedorDto.correo;

        document.querySelector('#txtTiempoEntrega').value = val_datos.tiempoEntrega;
        document.querySelector('#txtValidezCotizacion').value = val_datos.validezCotizacion;
        document.querySelector('#listFormaPago').value = val_datos.formaPago;

        document.querySelector('#lblSubtotal').innerHTML = miFormatoNumber.new(val_datos.subtotal, CANT_DECIMALES);
        document.querySelector('#lblSubtotalSinIva').innerHTML = miFormatoNumber.new(val_datos.subtotalSinIva, CANT_DECIMALES);
        document.querySelector('#lblIva').innerHTML = miFormatoNumber.new(val_datos.iva, CANT_DECIMALES);
        document.querySelector('#lblTotal').innerHTML = miFormatoNumber.new(val_datos.total, CANT_DECIMALES);
        
        document.querySelector('#txtobssol').value = val_datos.solicitudDto.observacion;

        if (document.querySelector('#cbxListaEstado')) {

            var cbxEstado = document.querySelector('#cbxListaEstado');
            document.querySelector('#cbxListaEstado').style = 'display: none;';

            cbxEstado.addEventListener("change", function () {
                var valor = cbxEstado.value;
                if (valor === "RECHAZADO" || valor === "ANULADO") {
                    document.querySelector('#lblRazonRechazo').style = '';
                    document.querySelector('#txtRazonRechazo').style = 'text-transform: uppercase;';

                    document.querySelector('#btnCambEst').style = '';
                    if (document.querySelector('#btnGeneraOC'))
                        document.querySelector('#btnGeneraOC').style = 'display: none;';
                } else {
                    document.querySelector('#lblRazonRechazo').style = 'display: none;';
                    document.querySelector('#txtRazonRechazo').style = 'text-transform: uppercase;display: none';

                    document.querySelector('#btnCambEst').style = 'display: none';
                    if (document.querySelector('#btnGeneraOC'))
                        document.querySelector('#btnGeneraOC').style = '';
                }
            });
        }


        //ocultar los botones
        if (document.querySelector('#btnGuarCot')) {
            document.querySelector('#btnGuarCot').style = 'display: none;';
        }
        if (document.querySelector('#registrosTabla')) {
            document.querySelector('#registrosTabla').value = val_datos.listaDetalles.length;
        }
        if (val_datos.estado === 'COTIZADO') { //RECHAZADO' && val_datos.estado !== 'GENERADO_OC'){
            if (document.querySelector('#btnGeneraOC'))
                document.querySelector('#btnGeneraOC').style = '';
            if (document.querySelector('#divEstado'))
                document.querySelector('#divEstado').style = "border: solid 1px graytext;";
        } else {
            if (document.querySelector('#btnGeneraOC')) {
                document.querySelector('#btnGeneraOC').style = 'display: none;';
                document.querySelector('#btnGeneraOC').setAttribute("onclick", "");
            }
            if (document.querySelector('#divEstado'))
                document.querySelector('#divEstado').style = "display: none;";
        }
        if (document.querySelector('#modalFormCotiz')) {
            if (document.querySelector('#btnBusqCot')) {
                document.querySelector('#btnBusqCot').style = 'display: none;';
            }
            document.querySelector('#divUno').classList.remove('col-md-2');
            document.querySelector('#divUno').classList.add('col-md-3');
            document.querySelector('#txtCodSol').setAttribute("readonly", "");
        }

        document.querySelector('#chkTodosIva').style = 'display: none;';

        if (val_datos.estado !== 'RECHAZADO' && val_datos.estado !== 'AUTORIZADO') {
//            document.querySelector('#btnAutorizar').style =  '';
            if (document.querySelector('#lblListaEstado'))
                document.querySelector('#lblListaEstado').style = '';
            if (document.querySelector('#cbxListaEstado'))
                document.querySelector('#cbxListaEstado').style = '';
        } else {
//            document.querySelector('#btnAutorizar').style =  'display: none;';
//            document.querySelector('#btnAutorizar').setAttribute("onclick", "");
        }



        //generar la tabla
//        let tabla = document.getElementById('tblDetSolicitud');
        var tbody = document.getElementById('tbodySol');
        let index = tbody.rows.length - 4; //se resta 4 porque es de los totales
        console.log("indexx: ", index);
        for (i = 0; i < index; i++) {
            tbody.deleteRow(0);
        }

        for (i = 0; i < val_datos.listaDetalles.length; i++) {
            console.log(val_datos.listaDetalles[i]);
            var rowAux = tbody.insertRow(0);

            rowAux.insertCell().innerHTML = '<label id="lblCantidad' + i + '" style="width: 100%; text-align: center;">' + val_datos.listaDetalles[i].cantidad + '</label>';
            rowAux.insertCell().innerHTML = '<label id="lblDetalle' + i + '">' + val_datos.listaDetalles[i].detalle + '</label>';
            rowAux.insertCell().innerHTML = '<label id="txtObservDetalle' + i + '" style="width: 100%">' + val_datos.listaDetalles[i].observacion + '</label>';
            
            console.log(";;;;", val_datos.solicitudDto.listaDetalles[i]);
            
            if(val_datos.solicitudDto.listaDetalles[i] && val_datos.solicitudDto.listaDetalles[i].pathArchivo){
                rowAux.insertCell().innerHTML = '<div style="text-align:center;"><a href="'+val_datos.solicitudDto.listaDetalles[i].pathArchivo+'" target="_blank"><i class="fa fa-fw fa-lg fa-download"></i></a></div>';
            }
            else{
                rowAux.insertCell().innerHTML = "";
            }
            
            rowAux.insertCell().innerHTML = '<label id="chkIva' + i + '" style="width: 100%; text-align: center;">' + (val_datos.listaDetalles[i].tieneIva ? 'SI' : 'NO') + '</label>';
            rowAux.insertCell().innerHTML = '<label id="txtValorUnitario' + i + '" class="monto' + i + '" style="width: 100%; text-align: end;">' + miFormatoNumber.new(val_datos.listaDetalles[i].valorUnitario, CANT_DECIMALES) + '</label>';
            rowAux.insertCell().innerHTML = '<label id="lblValorTotal' + i + '" style="width: 100%; text-align: end;">' + miFormatoNumber.new(val_datos.listaDetalles[i].valorTotal, CANT_DECIMALES) + '</label>';
        }

    } else {
        document.querySelector('#txtIdCot').value = null;
    }

    $('#modalFormCotiz').modal('show');
}


function generarOC(val_datos) {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';

    var respuesta = $('.RespuestaAjax');
    console.log(respuesta);

    //esto debe ir para el post
//    ' => $_POST['txtNumSol'],
//                'rucProveedor' => $_POST['txtRuc'],

    var numeroSolicitud = document.querySelector('#txtCodSolComp').value;
    var rucProveedor = document.querySelector('#txtRucProv').value;
    var obsComparativo = document.querySelector('#txtObsComp').value;
    
    var txtDetaFinal = document.querySelector('#txtDetaFinal').value;
    var txtObserOC = document.querySelector('#txtObserOC').value;

    if (obsComparativo !== null && obsComparativo !== '') {
        
        //validar los datos del formulario
//        var cant = val_datos.listaDetalles.length;
//        console.log("val_datos.listaDetalles.length:: ", val_datos.listaDetalles.length, cant);
        var detsCodigos = [];
        var datosCompletos = true;
        val_datos.listaDetalles.forEach(dt => {
            var codProd = document.querySelector('#txtCodProdOC'+dt.id).value;
            var nomProd = document.querySelector('#txtNomProdOC'+dt.id).value;
            
            if((codProd === null || codProd.length === 0) || nomProd.length === 0){
//                console.log("esta vacciioooo");
                datosCompletos = false;
            }
//            console.log("codProd: ", codProd);
//            console.log("nomProd: ", nomProd);
            detsCodigos.push({"id": dt.id, "codigoProducto": codProd.toUpperCase(), "detalle": nomProd.toUpperCase()});
        });
        
        if(!datosCompletos){
            LOADING.style = 'display: none;';
            swal("", "Complete los datos de los productos.", "warning");
            return;
        }

        $.ajax({
            type: 'POST',
            url: 'acciones/generarOrdenCompra.php',
            data: {"txtNumSol": numeroSolicitud, "txtRuc": rucProveedor, "txtObsComp": obsComparativo, "detallesProd": detsCodigos,
            'txtDetaFinal':txtDetaFinal,'txtObserOC':txtObserOC},
            //        cache: false,
            //        contentType: false,
            //        processData: false,
            success: function (data) {
                console.log(data);
                LOADING.style = 'display: none;';
                respuesta.html(data);
                //document.querySelector('#modalCodigoProducto').style = 'background: rgba(0, 0, 0, .5);';
            },
            error: function (error) {
                LOADING.style = 'display: none;';
                respuesta.html(error);
            }
        });

    } else {
        LOADING.style = 'display: none;';
        swal("", "Debe ingresar una observación.", "warning");
    }
}

function cambiarEstadoCotizacion() {
    const valRazonDev = document.getElementById("txtRazonRechazo").value;
    
    if(valRazonDev && valRazonDev !== null && valRazonDev !== ''){

        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';

        var form = document.forms['frmCotizacion'];
        var formdata = new FormData(form);

    //    var respuesta = form.elements('.RespuestaAjax');
        var respuesta = $('#idRespuestaAjax');

        console.log(respuesta);

        $.ajax({
            type: 'POST',
            url: 'acciones/cambiarEstadoCotizacion.php',
            data: formdata ? formdata : form.serialize(),
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                LOADING.style = 'display: none;';
                respuesta.html(data);
            },
            error: function (error) {
                LOADING.style = 'display: none;';
                respuesta.html(error);
            }
        });
        
    }else{
        swal('','Ingrese la raz\u00f3n de anulaci\u00f3n.','warning');
    }
}

function abrirComprativo() {

    var numeroSol = document.querySelector('#txtNumSol').value;

    console.log("numeroSol: ", numeroSol);

    if (numeroSol !== null && numeroSol !== '') {

        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';

        var respuesta = $('#divComparativo');

        $.ajax({
            type: 'POST',
            url: 'acciones/mostrarComparativo.php',
            data: {'txtNumSol': numeroSol},
//            cache: false,
//            contentType: false,
//            processData: false,
            success: function (data) {
//                console.log(data);
                LOADING.style = 'display: none;';
                respuesta.html(data);

                if (!data.includes("\"warning\""))
                    $('#modalComparativo').modal('show');
            },
            error: function (error) {
                LOADING.style = 'display: none;';
                respuesta.html(error);
            }
        });

    } else {
        console.log("ingrese el codigo de solicitud.");
        swal("", "Ingrese el código de solicitud.", "warning");
    }


}


function selectCotizacion(source, ruc) {
//    console.log("el ruc: ", ruc);
    var checkboxes = document.querySelectorAll('.chkCompart');
//    console.log("los boxes:", checkboxes);
//    console.log("el id:", checkboxes[0].id);
    for (var i = 0; i < checkboxes.length; i++) {
//        console.log("for: ", checkboxes[i]);
//        console.log("el id:", checkboxes[i].id);
        if (checkboxes[i].id === ruc) {
            checkboxes[i].checked = source.checked;
        } else {
            checkboxes[i].checked = false;
        }
    }

    document.querySelector("#txtRucProv").value = null;

    if (source.checked) {//para habilitar o desactivar el boton
//        console.log("butt: ", document.querySelector("#btnActionForm"));
        document.querySelector("#btnActionForm").disabled = false;
        document.querySelector("#txtRucProv").value = ruc;
    } else {
        document.querySelector("#btnActionForm").disabled = true;
    }
    
    console.log("ruc select: ",  document.querySelector("#txtRucProv").value);
}


function buscarProvPorRuc() {
    var ruc = document.querySelector('#txtRuc').value;
    if (ruc !== null && ruc !== '') {
        $.ajax({
            type: 'POST',
            url: 'acciones/buscarProveedorRuc.php',
            data: {'txtRucProv': ruc},
//            cache: false,
//            contentType: false,
//            processData: false,
            success: function (data) {
                if(data !== null){
                    console.log("proveedor encontrado: ", JSON.parse(data));
                    data = JSON.parse(data);
                    if(data !== null && data.id !== null){
        //                LOADING.style = 'display: none;';
                        document.querySelector("#txtRazonSocial").value = data.razonSocial;
                        document.querySelector("#txtTelefono").value = data.telefono1;
                        document.querySelector("#txtCorreo").value = data.correo;
                        document.querySelector("#txtDireccion").value = data.direccion;
    //                document.querySelector("#txtDireccion").value = data.direccion;
                    }
                    else{
                        swal('','NO EXISTE UN PROVEEDOR CON EL RUC INGRESADO','warning');
                    }
                }
                else{
                    swal('','NO EXISTE UN PROVEEDOR CON EL RUC INGRESADO','warning');
                }
            },
            error: function (error) {
//                LOADING.style = 'display: none;';
//                respuesta.html(error);
            }
        });
    } else {

    }
}




function buscarSolicitudPorNumeroSol() {
    var codSol = document.querySelector('#txtCodSol').value;

    if (codSol !== null && codSol !== '') {

        window.location.href = "formularioCotizacion?txtCodSol=" + codSol;

    } else {

    }
}


function rechazarTodas(){
    
    var obsComparativo = document.querySelector('#txtObsComp').value;

    if (obsComparativo !== null && obsComparativo !== '') {

        const LOADING = document.querySelector('.loader');
        LOADING.style = 'display: flex;';

        var numeroSolicitud = document.querySelector('#txtCodSolComp').value;
        var numeroRC = document.querySelector('#txtCodRcComp').value;

        var respuesta = $('.RespuestaAjax');

        $.ajax({
                type: 'POST',
                url: 'acciones/rechazarTodasCotizaciones.php',
                data: {
                    'codigoSolicitud': numeroSolicitud,
                    "codigoRC": numeroRC,
                    "obsRechazo": obsComparativo
                },
    //            cache: false,
    //            contentType: false,
    //            processData: false,
                success: function (data) {
                    LOADING.style = 'display: none;';
                    console.log("respuesta: ", data);
                    respuesta.html(data);
                },
                error: function (error) {
                    LOADING.style = 'display: none;';
                    respuesta.html(error);
                }
            });
            
    }
    else{
        swal("", "Debe ingresar una observación del rechazo.", "warning");
    }
}



