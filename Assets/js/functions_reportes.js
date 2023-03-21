function ejecutarReportePdf(reporte, id) {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    $.ajax({
        type: 'POST',
        url: 'acciones/ejecutarReportes.php',
        data: {'reporte': reporte, 'id': id, 'tipo': 'pdf'},
        success: function (data) {
            LOADING.style = 'display: none;';          
//            console.log(data);
            
            //se recibe en el data = el archivo en base64
            var byteCharacters = atob(data);
            var byteNumbers = new Array(byteCharacters.length);
            for (var i = 0; i < byteCharacters.length; i++) {
              byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            var byteArray = new Uint8Array(byteNumbers);
            var file = new Blob([byteArray], { type: 'application/pdf;base64' });
            var fileURL = URL.createObjectURL(file);
            window.open(fileURL, '_blank', 'height=450,width=375,resizable=1');
            
        },
        error: function (error) {
            LOADING.style = 'display: none;';
            console.log(data);
        }
    });

}

function ejecutarReporteCsv(reporte, fechaIni, fechaFin) {

    console.log("fechaIni: ", fechaIni);
    console.log("fechaFin: ", fechaFin);

    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    $.ajax({
        type: 'POST',
        url: 'acciones/ejecutarReportes.php',
        data: {'reporte': reporte, 'fechaIni': fechaIni, 'fechaFin': fechaFin, 'tipo': 'xls'},
        success: function (data) {
            LOADING.style = 'display: none;';
//            console.log(data);
//            window.open(data, '_blank', 'height=450,width=375,resizable=1');

            //se recibe en el data = el archivo en base64
            var byteCharacters = atob(data);
            var byteNumbers = new Array(byteCharacters.length);
            for (var i = 0; i < byteCharacters.length; i++) {
              byteNumbers[i] = byteCharacters.charCodeAt(i);
            }
            var byteArray = new Uint8Array(byteNumbers);
            var file = new Blob([byteArray], { type: 'application/vnd.ms-excel;base64' });
            
            let link = document.createElement('a');
            link.download = reporte + '.xls';
            link.href = URL.createObjectURL(file); //aqui se pone el blob
            link.click();
            URL.revokeObjectURL(link.href);
            
        },
        error: function (error) {
            LOADING.style = 'display: none;';
            console.log(data);
        }
    });
}

function pruebajspdf(val_datos) {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';

    var elementHTML = document.querySelector("#divImprimeComparativo");

    console.log(elementHTML);

    console.log(val_datos);
    
    let dataImpr = {'comparativoSelect': val_datos}
    
    if(val_datos === null){
        var d = document.getElementById('txtNumSol');
        console.log("es null:: ", d);
        dataImpr = {'txtNumSol': d.value};
    }

    $.ajax({
        type: 'POST',
        url: 'acciones/imprimirComparativo.php',
        data: dataImpr,
//            cache: false,
//            contentType: false,
//            processData: false,
        success: function (data) {
            LOADING.style = 'display: none;';

            elementHTML.innerHTML = data;

            console.log(elementHTML);

            window.jsPDF = window.jspdf.jsPDF;
            window.html2canvas = html2canvas;

            var doc = new jsPDF({orientation: 'landscape', });

            doc.html(elementHTML, {
                callback: function (doc) {
//                        LOADING.style = 'display: none;';
                    // Save the PDF
                    doc.save('comparativo.pdf');
                },
                margin: [10, 5, 10, 5],
                autoPaging: 'text',
                x: 0,
                y: 0,
                width: 287, //target width in the PDF document
                windowWidth: 1366 //window width in CSS pixels
            });

        },
        error: function (error) {
            LOADING.style = 'display: none;';

        }
    });



}



const NOFUNCA_formatNumberESxxx = (n, d = 0) => {
    console.log("el d: ", d);
    n = new Intl.NumberFormat("en-US").format(parseFloat(n).toFixed(d));
//    n=new Intl.NumberFormat("en-US",  { style: 'currency', currency: 'USD' }).format(parseFloat(n).toFixed(d));
    if (d > 0) {
        // Obtenemos la cantidad de decimales que tiene el numero
        
        console.log("vaolor.n: ", n);
        console.log("n.indexOf():", n.indexOf("."));
        console.log("n.length: ", n.length);
        
        const decimals = n.indexOf(".") > -1 ? n.length - n.indexOf(".") : 0;
        
        console.log("decimals: ", decimals);

        // añadimos los ceros necesios al numero
        n = (decimals === 0) ? n + "." + "0".repeat(d) : n + "0".repeat(d - decimals);
        
        console.log("n: ", n);
    }
    return n;
}
