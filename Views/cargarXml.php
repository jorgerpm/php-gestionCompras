<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-th-list"></i> Cargar archivo Xml</h1>
            <p>Subir los archivos xml y pdf para almacenar en la base de datos</p>
        </div>
        <ul class="app-breadcrumb breadcrumb side">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Menú</li>
            <li class="breadcrumb-item active"><a href="#">Cargar Xml</a></li>
        </ul>
    </div>
    <!-- Cargar archivo xml -->
    <div class="form-group">
        <label class="col-sm-2 control-label">Archivos</label>
        <div class="col-sm-8">

            <label for="inputFile" class="btn btn-primary">Select Image</label>
            <input type="file" name="" id="inputFile" multiple style="display:none">
        </div>
        <button type="button" class="btn btn-primary" onclick="uploadFile();">Cargar</button>
        <ul id="listaDeArchivos">
        </ul>
    </div>
</main>