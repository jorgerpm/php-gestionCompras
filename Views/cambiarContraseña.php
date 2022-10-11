<section class="login-content">
    <div class="logo">
        <h1 style="color: black">Cambio de contrase&ntilde;a</h1>
    </div>
    <div class="login-box">
        <!-- sección para iniciar sesión -->
        <form id="formUsuario" class="FormularioAjax login-form" action="acciones/cambiarClave.php" method="POST" data-form="save" autocomplete="off" enctype="multipart/form-data">
            
            <div>
                <p><button style="display: none;" id="btnBuscar" name="btnBuscar" class="btn btn-primary btn-sm fa" type="button" onclick="window.location.href=''">buscar</button></p>
            </div>
            
            <!-- Ingreso contraseña actual -->
            <div class="form-group">
                <label class="control-label">CONTRASE&Ntilde;A ACTUAL</label>
                <input class="form-control" type="password" name="txtClaveActual" placeholder="escriba la contrase&ntilde;a actual" id="clave" required>
            </div>

            <!-- Ingreso contraseña nueva -->
            <div class="form-group">
                <label class="control-label">CONTRASE&Ntilde;A NUEVA</label>
                <input class="form-control" type="password" name="txtClaveNueva" placeholder="ingrese la contrase&ntilde;a nueva" id="clave" required>
            </div>

            <!-- Repetir contraseña nueva -->
            <div class="form-group">
                <label class="control-label">REPETIR CONTRASE&Ntilde;A</label>
                <input class="form-control" type="password" name="txtRepetirClave" placeholder="repita la contrase&ntilde;a nueva" id="clave" required>
            </div>

            <!-- botón para iniciar sesión -->
            <div class="form-group btn-container">
                <button class="btn btn-primary btn-block"><i class="fa fa-exchange"></i>CAMBIAR CONTRASE&Ntilde;A</button>
            </div>
            <div class="RespuestaAjax"></div>
        </form>
    </div>
</section>