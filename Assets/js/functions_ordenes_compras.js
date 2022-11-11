function abrirFormulario(val_datos) {

    console.log(val_datos);
//    console.log("fechhaa::: ", new Date(val_datos.fechaSolicitud).toISOString().split('T')[0]);

    document.querySelector('#frmOrdenCompra').reset();

    if (val_datos !== null) {
//        document.querySelector('#txtId').value = val_datos.id;
        document.querySelector('#txtCodigoRc').value = val_datos.codigoRC;
        document.querySelector('#txtFecha').value = new Date(val_datos.fechaOrdenCompra).toISOString().split('T')[0];
        //document.querySelector('#txtRubrosAdicionales').value = val_datos.adicionales;
        document.querySelector('#txtObservaciones').value = val_datos.observacion;
        
        document.querySelector('#txtUsuario').value = val_datos.usuario;
        document.querySelector('#txtRuc').value = val_datos.rucProveedor;
        document.querySelector('#txtRazonSocial').value = val_datos.proveedorDto.razonSocial;
        document.querySelector('#txtTelefono').value = val_datos.proveedorDto.telefono1;
        document.querySelector('#txtDireccion').value = val_datos.proveedorDto.direccion;
        
        //document.querySelector('#txtTiempoEntrega').value = val_datos.tiempoEntrega;
        //document.querySelector('#txtValidezCotizacion').value = val_datos.validezCotizacion;
        document.querySelector('#listFormaPago').value = val_datos.formaPago;
        
        document.querySelector('#lblSubtotal').innerHTML = val_datos.subtotal;
        document.querySelector('#lblSubtotalSinIva').innerHTML = val_datos.subtotalSinIva;
        document.querySelector('#lblIva').innerHTML = val_datos.iva;
        document.querySelector('#lblTotal').innerHTML = val_datos.total;

        //ocultar los botones
        if(document.querySelector('#btnGuarCot')){
            document.querySelector('#btnGuarCot').style = 'display: none;';
        }
        if(document.querySelector('#registrosTabla')){
            document.querySelector('#registrosTabla').value = val_datos.listaDetalles.length;
        }
        if(document.querySelector('#btnBusqCot')){
            document.querySelector('#btnBusqCot').style = 'display: none;';
        }
        if(val_datos.estado !== 'RECHAZADO' && val_datos.estado !== 'GENERADO_OC'){
            document.querySelector('#btnGeneraOC').style =  '';
        }else{
            document.querySelector('#btnGeneraOC').style =  'display: none;';
            document.querySelector('#btnGeneraOC').setAttribute("onclick", "");
        }
        
        document.querySelector('#chkTodosIva').style = 'display: none;';
        document.querySelector('#divUno').classList.remove('col-md-3');
        document.querySelector('#divUno').classList.add('col-md-4');
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
            rowAux.insertCell().innerHTML = '<label id="lblDetalle'+i+'">'+val_datos.listaDetalles[i].detalle+'</label>';
            rowAux.insertCell().innerHTML = '<label id="txtObservDetalle'+i+'" style="width: 100%">'+val_datos.listaDetalles[i].observacion+'</label>';
            rowAux.insertCell().innerHTML = '<label id="chkIva'+i+'" style="width: 100%; text-align: center;">'+(val_datos.listaDetalles[i].tieneIva ? 'SI' : 'NO')+'</label>';
            rowAux.insertCell().innerHTML = '<label id="txtValorUnitario'+i+'" class="monto'+i+'" style="width: 100%; text-align: end;">'+val_datos.listaDetalles[i].valorUnitario+'</label>';
            rowAux.insertCell().innerHTML = '<label id="lblValorTotal'+i+'" style="width: 100%; text-align: end;">'+val_datos.listaDetalles[i].valorTotal+'</label>';
        }

    } else {
//        document.querySelector('#txtId').value = null;
    }

    $('#modalFormOrdCompra').modal('show');
}