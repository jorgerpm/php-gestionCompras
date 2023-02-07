function ejecutarReportePdf(reporte, id) {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
    
    $.ajax({
        type: 'POST',
        url: 'acciones/ejecutarReportes.php',
        data: {'reporte': reporte, 'id': id, 'tipo': 'pdf'},
        success: function (data) {
            LOADING.style = 'display: none;';
            
            console.log(data);
            
            window.open(data, '_blank', 'height=450,width=375,resizable=1');
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
            
            console.log(data);
            
            window.open(data, '_blank', 'height=450,width=375,resizable=1');
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

    $.ajax({
        type: 'POST',
        url: 'acciones/imprimirComparativo.php',
        data: {'comparativoSelect': val_datos},
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



const formatNumberES = (n, d = 0) => {
    n = new Intl.NumberFormat("en-US").format(parseFloat(n).toFixed(d));
//    n=new Intl.NumberFormat("en-US",  { style: 'currency', currency: 'USD' }).format(parseFloat(n).toFixed(d));
    if (d > 0) {
        // Obtenemos la cantidad de decimales que tiene el numero
        const decimals = n.indexOf(".") > -1 ? n.length - 1 - n.indexOf(".") : 0;

        // añadimos los ceros necesios al numero
        n = (decimals === 0) ? n + "." + "0".repeat(d) : n + "0".repeat(d - decimals);
    }
    return n;
}