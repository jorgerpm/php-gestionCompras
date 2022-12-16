function ejecutarReportePdf(reporte, id){
    
    window.open('http://192.168.100.74:8080/ServiciosWebGestionCompras/ReporteServicio?reporte=' + reporte 
            +'&tipo=pdf&id=' + id, '_blank', 'height=450,width=375,resizable=1');
    
}