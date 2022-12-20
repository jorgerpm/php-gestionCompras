function ejecutarReportePdf(reporte, id) {

    window.open('http://192.168.100.74:8080/ServiciosWebGestionCompras/ReporteServicio?reporte=' + reporte
            + '&tipo=pdf&id=' + id, '_blank', 'height=450,width=375,resizable=1');

}

function pruebajspdf(reporte, id) {
    const LOADING = document.querySelector('.loader');
    LOADING.style = 'display: flex;';
//    var html1 = document.getElementById('divComparativo').innerHTML;
    var elementHTML = document.querySelector("#divComparativo");

//    console.log("es: ", elementHTML);

    window.jsPDF = window.jspdf.jsPDF;
    window.html2canvas = html2canvas;

    var doc = new jsPDF({orientation: 'landscape', });

    doc.html(elementHTML, {
        callback: function (doc) {
            LOADING.style = 'display: none;';
            // Save the PDF
            doc.save('sample-document.pdf');
        },
        margin: [10, 5, 10, 5],
        autoPaging: 'text',
        x: 0,
        y: 0,
        width: 287, //target width in the PDF document
        windowWidth: 1366 //window width in CSS pixels
    });

}