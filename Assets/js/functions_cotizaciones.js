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
    document.getElementById('lblValorTotal' + index).innerHTML = valTotalDet.toFixed(4);

    valorTotal(cantDetalles);
}

function valorTotal(cantDetalles) {
    //recorrer todos los registros para obtener el subtotal
    let subtotal = 0;
    let subtotalSinIva = 0;
    for (j = 1; j <= cantDetalles; j++) {

        var lblValTotal = document.getElementById('lblValorTotal' + j).innerHTML;

        var tieneIva = document.getElementById('chkIva' + j).checked;

        if (!isNaN(lblValTotal) && lblValTotal !== '') {
            if (tieneIva)
                subtotal += parseFloat(lblValTotal);
            else
                subtotalSinIva += parseFloat(lblValTotal);
        }
    }
    document.getElementById('lblSubtotal').innerHTML = subtotal.toFixed(2);
    document.getElementById('lblSubtotalSinIva').innerHTML = subtotalSinIva.toFixed(2);

    var iva = subtotal * 0.12;
    document.getElementById('lblIva').innerHTML = iva.toFixed(2);
    var total = subtotalSinIva + subtotal + iva;
    document.getElementById('lblTotal').innerHTML = total.toFixed(2);


    /*
     var total1 = parseFloat(document.getElementById('lblCantidad1').innerHTML);
     $(".monto1").each(function() {
     if (isNaN(parseFloat($(this).val()))) {
     total1 *= 0;
     } else {
     total1 *= parseFloat($(this).val());
     }
     });
     var total2 = parseFloat(document.getElementById('lblCantidad2').innerHTML);
     $(".monto2").each(function() {
     if (isNaN(parseFloat($(this).val()))) {
     total2 *= 0;
     } else {
     total2 *= parseFloat($(this).val());
     }
     });
     //alert(total);
     document.getElementById('lblValorTotal1').innerHTML = total1.toFixed(2);
     document.getElementById('lblValorTotal2').innerHTML = total2.toFixed(2);
     var subtotal = total1 + total2;
     document.getElementById('lblSubtotal').innerHTML = subtotal.toFixed(2);
     var iva = subtotal * 0.12;
     document.getElementById('lblIva').innerHTML = iva.toFixed(2);
     var total = subtotal + iva;
     document.getElementById('lblTotal').innerHTML = total.toFixed(2);
     */
}

//enviar a guardar la cotizacion
$('#frmCotizacion').submit(function (e) {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';

    e.preventDefault(); //no se envíe el submit todavía

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
});

//funcion para buscar al cotizacion por codigoRC
function buscarCotizacion() {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    var codigoRC = document.getElementById('txtCodigoRc').value;

    var respuesta = document.getElementsByClassName('RespuestaAjax')[0];

    console.log(respuesta);

    var form = document.forms[0];

    console.log(form);

    var formdata = new FormData(document.querySelector('form'));



    $.ajax({
        type: 'GET',
        url: 'acciones/buscarCotizacionPorNumero.php?codigoRC=' + codigoRC,
        data: formdata ? formdata : form.serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            LOADING.style = 'display: none;';
            var cot = JSON.parse(data);
            console.log(cot);
            console.log(cot.id);
            
            if(cot.id > 0){
                abrirFormulario(cot);
            }
            else{
//                document.querySelector('#frmCotizacion').reset();
//                var tbody = document.getElementById('tbodySol');
//                let index = tbody.rows.length - 4; //se resta 4 porque es de los totales
//                console.log("indexx: ", index);
//                for (i = 0; i < index; i++) {
//                    tbody.deleteRow(0);
//                }
//                document.querySelector('#lblSubtotal').innerHTML = 0;
//                document.querySelector('#lblSubtotalSinIva').innerHTML = 0;
//                document.querySelector('#lblIva').innerHTML = 0;
//                document.querySelector('#lblTotal').innerHTML = 0;
                swal("", "No existe cotización con el número de requisición ingresado.", "warning");
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
        
        document.querySelector('#txtCodigoCotizacion').value = val_datos.codigoCotizacion;
        document.querySelector('#txtRuc').value = val_datos.rucProveedor;
        document.querySelector('#txtRazonSocial').value = val_datos.proveedorDto.razonSocial;
        document.querySelector('#txtTelefono').value = val_datos.proveedorDto.telefono1;
        document.querySelector('#txtDireccion').value = val_datos.proveedorDto.direccion;
        
        document.querySelector('#txtTiempoEntrega').value = val_datos.tiempoEntrega;
        document.querySelector('#txtValidezCotizacion').value = val_datos.validezCotizacion;
        document.querySelector('#listFormaPago').value = val_datos.formaPago;
        
        document.querySelector('#lblSubtotal').innerHTML = val_datos.subtotal;
        document.querySelector('#lblSubtotalSinIva').innerHTML = val_datos.subtotalSinIva;
        document.querySelector('#lblIva').innerHTML = val_datos.iva;
        document.querySelector('#lblTotal').innerHTML = val_datos.total;
        
        if(document.querySelector('#cbxListaEstado')){
            
            var cbxEstado = document.querySelector('#cbxListaEstado');
            document.querySelector('#cbxListaEstado').style = 'display: none;';
        
            cbxEstado.addEventListener("change", function() {
                var valor = cbxEstado.value;
                if(valor === "RECHAZADO" || valor === "ANULADO"){
                    document.querySelector('#lblRazonRechazo').style = '';
                    document.querySelector('#txtRazonRechazo').style = 'text-transform: uppercase;';

                    document.querySelector('#btnCambEst').style = '';
                    if(document.querySelector('#btnGeneraOC'))
                        document.querySelector('#btnGeneraOC').style =  'display: none;';
                } else {
                    document.querySelector('#lblRazonRechazo').style = 'display: none;';
                    document.querySelector('#txtRazonRechazo').style = 'text-transform: uppercase;display: none';

                    document.querySelector('#btnCambEst').style = 'display: none';
                    if(document.querySelector('#btnGeneraOC'))
                        document.querySelector('#btnGeneraOC').style =  '';
                }
            });
        }
        

        //ocultar los botones
        if(document.querySelector('#btnGuarCot')){
            document.querySelector('#btnGuarCot').style = 'display: none;';
        }
        if(document.querySelector('#registrosTabla')){
            document.querySelector('#registrosTabla').value = val_datos.listaDetalles.length;
        }
        if(val_datos.estado === 'COTIZADO'){ //RECHAZADO' && val_datos.estado !== 'GENERADO_OC'){
            if(document.querySelector('#btnGeneraOC'))
                document.querySelector('#btnGeneraOC').style =  '';
            if(document.querySelector('#divEstado'))
                document.querySelector('#divEstado').style = "border: solid 1px graytext;";
        }else{
            if(document.querySelector('#btnGeneraOC')){
                document.querySelector('#btnGeneraOC').style =  'display: none;';
                document.querySelector('#btnGeneraOC').setAttribute("onclick", "");
            }
            if(document.querySelector('#divEstado'))
                document.querySelector('#divEstado').style = "display: none;";
        }
        if(document.querySelector('#modalFormCotiz')){
            if(document.querySelector('#btnBusqCot')){
                document.querySelector('#btnBusqCot').style = 'display: none;';
            }
            document.querySelector('#divUno').classList.remove('col-md-3');
            document.querySelector('#divUno').classList.add('col-md-4');
            document.querySelector('#txtCodigoRc').setAttribute("readonly", "");
        }
        
        document.querySelector('#chkTodosIva').style = 'display: none;';
        
        if(val_datos.estado !== 'RECHAZADO' && val_datos.estado !== 'AUTORIZADO'){
//            document.querySelector('#btnAutorizar').style =  '';
            if(document.querySelector('#lblListaEstado'))
                document.querySelector('#lblListaEstado').style = '';
            if(document.querySelector('#cbxListaEstado'))
                document.querySelector('#cbxListaEstado').style = '';
        }else{
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
            
            rowAux.insertCell().innerHTML = '<label id="lblCantidad'+i+'" style="width: 100%; text-align: center;">'+val_datos.listaDetalles[i].cantidad+'</label>';
            rowAux.insertCell().innerHTML = '<label id="lblDetalle'+i+'">'+val_datos.listaDetalles[i].detalle+'</label>';
            rowAux.insertCell().innerHTML = '<label id="txtObservDetalle'+i+'" style="width: 100%">'+val_datos.listaDetalles[i].observacion+'</label>';
            rowAux.insertCell().innerHTML = '<label id="chkIva'+i+'" style="width: 100%; text-align: center;">'+(val_datos.listaDetalles[i].tieneIva ? 'SI' : 'NO')+'</label>';
            rowAux.insertCell().innerHTML = '<label id="txtValorUnitario'+i+'" class="monto'+i+'" style="width: 100%; text-align: end;">'+val_datos.listaDetalles[i].valorUnitario+'</label>';
            rowAux.insertCell().innerHTML = '<label id="lblValorTotal'+i+'" style="width: 100%; text-align: end;">'+val_datos.listaDetalles[i].valorTotal+'</label>';
        }

    } else {
        document.querySelector('#txtIdCot').value = null;
    }

    $('#modalFormCotiz').modal('show');
}


function generarOC(){
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    var numeroRC = document.querySelector('#txtCodigoRc').value;
    //var form = document.querySelector('#frmCotizacion');
    var form = document.forms['frmCotizacion'];
    var formdata = new FormData(form);
    
//    var respuesta = form.elements('.RespuestaAjax');
    var respuesta = $('#idRespuestaAjax');
    
    console.log(respuesta);
    
    $.ajax({
        type: 'POST',
        url: 'acciones/generarOrdenCompra.php',
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
}

function cambiarEstadoCotizacion(){
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
}