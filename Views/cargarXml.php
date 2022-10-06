<main class="app-content">
    <div class="app-title">
        <div>
            <span style="font-size: 18px"><i class="fa fa-th-list"></i> Cargar archivo Xml</span>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Menú</li>
            <li class="breadcrumb-item active"><a href="#">Cargar Xml</a></li>
        </ul>
    </div>
    <!-- Cargar archivo xml -->
    <div class="container">		
        <div class="panel panel-primary">
            <div class="panel-body">
                
                
                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-4">
                            <label for="inputFileXml" class="btn btn-primary">Cargar factura xml</label>
                            <input type="file" name="" class="btn btn-primary" id="inputFileXml" accept=".xml" style="display:none" required="">
                        </div>
                        <div class="col-sm-8">
                            <label id="archivoXml" style="word-break:break-word;"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-12">
                            <label for="inputFilePdf" class="btn btn-primary">Cargar factura Ride</label>
                            <input type="file" name="" class="btn btn-primary" id="inputFilePdf" accept=".pdf" style="display:none" required="">
                        </div>
                        <div class="col-sm-8">
                            <label id="archivoPdf" style="word-break:break-word;"></label>
                        </div>
                    </div>
                    
                </div>
                <button type="button" class="btn btn-primary" onclick="uploadFile();">Cargar archivos</button>

                <div class="form-group">
                    <div class="row">
                        <div class="col-sm-8">
                            <ul id="listaDeArchivos">
                            </ul>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>

</main>

<script src="./Assets/js/functions_alertas.js"></script>
