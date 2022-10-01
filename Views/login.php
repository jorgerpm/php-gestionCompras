<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="./Assets/css/main.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Login - Vali Admin</title>
</head>

<body>
    <!-- Color superior (Verde) -->
    <section class="material-half-bg">
        <div class="cover"></div>
    </section>

    <!-- Color inferior (gris) -->
    <section class="login-content">
        <div class="logo">
            <h1>Vali</h1>
        </div>
        <div class="login-box">
            <!-- sección para iniciar sesión -->
            <form class="login-form" action="./Controllers/loginControlador.php" method="post" name="FormEntrar">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>INICIO DE SESIÓN</h3> <!-- título sección -->

                <!-- Ingreso nombre de usuario -->
                <div class="form-group">
                    <label class="control-label">NOMBRE DE USUARIO</label>
                    <input class="form-control" type="text" name="usuario" placeholder="Usuario" id="Usuario" autofocus required>
                </div>

                <!-- Ingreso contraseña -->
                <div class="form-group">
                    <label class="control-label">CONTRASEÑA</label>
                    <input class="form-control" type="password" name="clave" placeholder="Password" id="Clave" required>
                </div>

                <!-- chkList y link para recupera la contraseña -->
                <div class="form-group">
                    <div class="utility">
                        <div class="animated-checkbox"> <!-- chk list -->
                            <label>
                                <input type="checkbox"><span class="label-text">Mantener sesión iniciada</span>
                            </label>
                        </div> <!-- link -->
                        <p class="semibold-text mb-2"><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
                    </div>
                </div>

                <!-- botón para iniciar sesión -->
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>INICIAR SESIÓN</button>
                </div>
            </form>

            <!-- Sección para recuperar la contraseña -->
            <form class="forget-form" action="controlador/loginControlador.php" method="post" name="FormEntrar">
                <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>¿OLVIDASTE TU CONTRASEÑA?</h3> <!-- título sección -->

                <!-- Ingreso de correo -->
                <div class="form-group">
                    <label class="control-label">CORREO</label>
                    <input class="form-control" type="text" placeholder="Correo">
                </div>
                <div class="form-group btn-container">
                    <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RECUPERAR</button>
                </div>
                <div class="form-group mt-3">
                    <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Iniciar sesión</a></p>
                </div>
            </form>
        </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script src="./Assets/js/jquery-3.3.1.min.js"></script>
    <script src="./Assets/js/popper.min.js"></script>
    <script src="./Assets/js/bootstrap.min.js"></script>
    <script src="./Assets/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="./Assets/js/plugins/pace.min.js"></script>
    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
</body>

</html>

