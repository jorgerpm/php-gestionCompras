var cbxEstado = document.querySelector('#cbxListaEstado');

function abrirFormularioOrdenCompra(val_datos, rolAutoriza) {

    console.log(val_datos);
//    console.log("fechhaa::: ", new Date(val_datos.fechaSolicitud).toISOString().split('T')[0]);

    document.querySelector('#frmOrdenCompra').reset();

    if (val_datos !== null) {
        document.querySelector('#txtId').value = val_datos.id;
        document.querySelector('#txtCodigoRc').value = val_datos.codigoRC;
        document.querySelector('#txtFecha').value = new Date(val_datos.fechaOrdenCompra).toISOString().split('T')[0];
        //document.querySelector('#txtRubrosAdicionales').value = val_datos.adicionales;
        document.querySelector('#txtObservaciones').value = val_datos.observacion;
        document.querySelector('#txtDetaFinal').value = val_datos.detalleFinal;
        document.querySelector('#txtEstado').value = val_datos.estado;
        
        document.querySelector('#txtUsuario').value = val_datos.usuario;
        document.querySelector('#txtRuc').value = val_datos.rucProveedor;
        document.querySelector('#txtRazonSocial').value = val_datos.proveedorDto.razonSocial;
        document.querySelector('#txtTelefono').value = val_datos.proveedorDto.telefono1;
        document.querySelector('#txtDireccion').value = val_datos.proveedorDto.direccion;
        document.querySelector('#txtNomcomercial').value = val_datos.proveedorDto.nombreComercial;
        
        //document.querySelector('#txtTiempoEntrega').value = val_datos.tiempoEntrega;
        //document.querySelector('#txtValidezCotizacion').value = val_datos.validezCotizacion;
        document.querySelector('#listFormaPago').value = val_datos.formaPago;
        
        document.querySelector('#lblSubtotal').innerHTML = formatNumberES(val_datos.subtotal, 2);
        document.querySelector('#lblSubtotalSinIva').innerHTML = formatNumberES(val_datos.subtotalSinIva, 2);
        document.querySelector('#lblIva').innerHTML = formatNumberES(val_datos.iva, 2);
        document.querySelector('#lblTotal').innerHTML = formatNumberES(val_datos.total, 2);

        //ocultar input y label razón rechazo
        if(document.querySelector('#lblRazonRechazo')){
            document.querySelector('#lblRazonRechazo').style = 'display: none;';
        }
        if(document.querySelector('#txtRazonRechazo')){
            document.querySelector('#txtRazonRechazo').style = 'display: none;';
        }
        if(document.querySelector('#lblListaEstado')){
            document.querySelector('#lblListaEstado').style = 'display: none;';
        }
        if(document.querySelector('#cbxListaEstado')){
            document.querySelector('#cbxListaEstado').style = 'display: none;';
        }
        cbxEstado.addEventListener("change", function() {
            var valor = cbxEstado.value;
            document.querySelector('#txtRazonRechazo').value = null;
            if(valor === "RECHAZADO" || valor === "ANULADO"){
                document.querySelector('#lblRazonRechazo').style = '';
                document.querySelector('#txtRazonRechazo').style = 'text-transform: uppercase;';
            } else {
                document.querySelector('#lblRazonRechazo').style = 'display: none;';
                document.querySelector('#txtRazonRechazo').style = 'text-transform: uppercase;display: none';
            }
        });

        //ocultar los botones
        if(document.querySelector('#btnAutorizar')){
            document.querySelector('#btnAutorizar').style = 'display: none;';
        }
        if(document.querySelector('#registrosTabla')){
            document.querySelector('#registrosTabla').value = val_datos.listaDetalles.length;
        }
        if(document.querySelector('#btnBusqCot')){
            document.querySelector('#btnBusqCot').style = 'display: none;';
        }
        console.log("auto: ", rolAutoriza);
        var display = "display: none;";
        if(rolAutoriza === 1)
            display = "";
            
        if(val_datos.estado !== 'RECHAZADO' && val_datos.estado !== 'AUTORIZADO' && val_datos.estado !== 'COMPLETO'
                && val_datos.estado !== 'PENDIENTE_RECEPCION'){
            if(document.querySelector('#btnAutorizar')){
                document.querySelector('#btnAutorizar').style =  '';
            }
            document.querySelector('#lblListaEstado').style = '';
            document.querySelector('#cbxListaEstado').style = '';
            document.querySelector('#divCmbEstados').style =  'border: solid 1px graytext; ' + display;
        }else{
            if(document.querySelector('#btnAutorizar')){
                document.querySelector('#btnAutorizar').style =  'display: none;';
//                document.querySelector('#btnAutorizar').setAttribute("onclick", "");
            }
            document.querySelector('#divCmbEstados').style =  'border: none 1px graytext: ' + display;
        }
        
        document.querySelector('#chkTodosIva').style = 'display: none;';
//        document.querySelector('#divUno').classList.remove('col-md-3');
//        document.querySelector('#divUno').classList.add('col-md-4');
        document.querySelector('#txtCodigoRc').setAttribute("readonly", "")
        

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
            
            rowAux.insertCell().innerHTML = '<label>'+ (val_datos.listaDetalles[i].codigoProducto === null ? '' : val_datos.listaDetalles[i].codigoProducto) +'</label></td>';
            
            rowAux.insertCell().innerHTML = '<label id="lblDetalle'+i+'">'+val_datos.listaDetalles[i].detalle+'</label>';
            rowAux.insertCell().innerHTML = '<label id="txtObservDetalle'+i+'" style="width: 100%">'+val_datos.listaDetalles[i].observacion+'</label>';
            rowAux.insertCell().innerHTML = '<label id="chkIva'+i+'" style="width: 100%; text-align: center;">'+(val_datos.listaDetalles[i].tieneIva ? 'SI' : 'NO')+'</label>';
            rowAux.insertCell().innerHTML = '<label id="txtValorUnitario'+i+'" class="monto'+i+'" style="width: 100%; text-align: end;">'+formatNumberES(val_datos.listaDetalles[i].valorUnitario, 2)+'</label>';
            rowAux.insertCell().innerHTML = '<label id="lblValorTotal'+i+'" style="width: 100%; text-align: end;">'+formatNumberES(val_datos.listaDetalles[i].valorTotal, 2)+'</label>';
        }

    //para la parte de los autorizadores, pero solo si ya esta autorizado la OC
        var tbody = document.getElementById('tbodyAutorOC');
        var ixb = tbody.rows.length;

        //primero eliminar todo el tbodyautor
        for (let i = 0; i < ixb; i++) {
            tbody.deleteRow(0);
        }
        
        if(val_datos.estado === 'AUTORIZADO' || val_datos.estado === 'COMPLETO' || val_datos.estado === 'PENDIENTE_RECEPCION'){
            document.querySelector('#divAprovs').style = '';
            var indexAuts = val_datos.listaAutorizaciones.length;
            for (let i = 0; i < indexAuts; i++) {
                var fila = tbody.insertRow();
                fila.insertCell().innerHTML = val_datos.listaAutorizaciones[i].nombreUsuario + '<input type="hidden" id="txtIdUserModal' + i + '" value="' + val_datos.listaAutorizaciones[i].idUsuario + '">';
                //fila.insertCell().innerHTML = usuariosAut[i].estado;
                //fila.insertCell().innerHTML = '<input id="' + i + '" type="button" value="x" onclick="eliminarFilaModal(this);" class="btn btn-secondary btn-sm fa">';
            }
        }
        else{
            document.querySelector('#divAprovs').style = 'display: none;';
        }



    } else {
//        document.querySelector('#txtId').value = null;
    }

    $('#modalFormOrdCompra').modal('show');
}

function valorEstado() {
    cbxEstado.addEventListener("change", function() {
        var valor = cbxEstado.value
        if(valor === "2"){
            return document.querySelector('#txtRazonRechazo').style = '';
            //return document.querySelector('#lblRazonRechazo').style = '';
        }
    });
}

function generarAutorizacion(){
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    var form = document.forms['frmOrdenCompra'];
    var formdata = new FormData(form);
    
//    var respuesta = form.elements('.RespuestaAjax');
    var respuesta = $('#idRespuestaAjax');
    
    console.log(respuesta);
    
    $.ajax({
        type: 'POST',
        url: 'acciones/generarAutorizacion.php',
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