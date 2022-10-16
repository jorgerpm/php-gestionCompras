function checkAll(vari) {
    document.querySelectorAll('#formMenuRol input[id=idRol]').forEach(function(checkElement) {
        checkElement.checked = vari.checked;
    });
}

function funcion(comboBox) {
    alert(comboBox.value);
    console.log(comboBox.value);
    var formData = new FormData();
    formData.append("cbxListaRol", comboBox.value);
    var xhttp = new XMLHttpRequest();

        // Set POST method and ajax file path
        xhttp.open("POST", "./acciones/listarMenuPorRol.php", true);

        // call on request changes state
        xhttp.onreadystatechange = function () {
            if (this.readyState === 4 && this.status === 200) {

                var response = this.responseText;
                alert(response);

                /*if (response === "OK") {

                    fileXml = [];
                    filePdf = [];
                    actualizarListaDeArchivos(1);
                    actualizarListaDeArchivos(2);

                    swal("", "Archivos cargados correctamente", "success");
                } else {
                    swal("", "Error en la carga del archivo. " + response, "error");
                }*/

            } else {
                //swal("2", "Error en la carga del archivo. " + this.responseText, "error");
            }
        };

        // Send request with data
        xhttp.send(formData);
}

function actualizarPermisos(boton) {
    //alert("prueba alerta");
    var form = boton.form;
    //alert(form);
    var formdata = new FormData(form);
    $.ajax({
        type: "POST",
        url: "./acciones/actualizarPermisos.php",
        data: formdata ? formdata : form.serialize(),
        cache: false,
        contentType: false,
        processData: false,
        success: function (data) {
            swal("", "Permisos actualizados correctamente", "success");
        },
        error: function (error) {
            swal("", "Error en la actualización de permisos.", "error");
        }
    });
}