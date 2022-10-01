/*function uploadFile() {
 var totalfiles = document.getElementById('archivos').files.length;
 if(totalfiles > 0 ){
 var formData = new FormData();
 //Leer los archivos seleccionados
 for (var index = 0; index < totalfiles; index++) {
 formData.append("archivos[]", document.getElementById('archivos').files[index]);
 }
 var xhttp = new XMLHttpRequest();
 //Enviar $POST a la función cargarXmlControlador.php
 xhttp.open("POST", "./Controllers/cargarXmlControlador.php", true);
 //Mostrar los cambios de estado
 xhttp.onreadystatechange = function() {
 if (this.readyState == 4 && this.status == 200) {
 var response = this.responseText;
 alert(response + " Archivos cargados");
 }
 };
 //Enviar solicitud de datos
 xhttp.send(formData);
 }else{
 alert("Por favor seleccione archivos");
 }
 }*/

//--------------------------------  -----------------------
var inputFile = $("#inputFile");
var listaDeArchivos = $("#listaDeArchivos");
var archivosParaSubir = [];

function actualizarListaDeArchivos() {
    let listaHtml = archivosParaSubir.map(function (item, index) {
        return `<li>
      ${item.name} 
      <button data-index="${index}" class="file-list-eliminar">Eliminar</button>
    </li>`;
    });
    listaDeArchivos.html(listaHtml);
}

inputFile.on('change', function (e) {
    let files = e.target.files;
    if (files.length == 0)
        return;
    files = Array.from(files);
    files.forEach(uu => {
        archivosParaSubir.push(uu);
    });
    actualizarListaDeArchivos();
    $(this).val('');
});

$(document).on("click", ".file-list-eliminar", function () {
    let index = $(this).data('index');
    archivosParaSubir.splice(index, 1);
    actualizarListaDeArchivos();
});

// Upload file
function uploadFile() {
    if (archivosParaSubir.length == 0) {
        //alert('seleccione al menos un archivo');
        swal("", "Seleccione al menos un archivo", "warning");
    } else {
        var formData = new FormData();
        // Read selected files
        archivosParaSubir.forEach(fe => {
            formData.append("archivos[]", fe);
            console.log('arhicvo: ', fe);
        });
        var xhttp = new XMLHttpRequest();
        // Set POST method and ajax file path
        xhttp.open("POST", "./Controllers/cargarXmlControlador.php", true);
        // call on request changes state
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = this.responseText;
                archivosParaSubir = [];
                actualizarListaDeArchivos();
                swal("Prueba!", "Your imaginary file has been deleted.", "success");
            }
        };
        // Send request with data
        xhttp.send(formData);
    }
}

$('#demoSwal').click(function () {
    swal("Prueba!", "Your imaginary file has been deleted.", "success");
});