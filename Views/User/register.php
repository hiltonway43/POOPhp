<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FFI Roca Fuerte</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition login-page" style="background-color: #029ADB;">

    <div class="register-box">

        <div class="login-logo">
            <img src="dist/img/logo.png" style="width: 80%; height: 80%;" alt="" srcset="">
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <h5 class="login-box-msg">Crear cuenta de usuario</h5>

                <form id="register-form" name="register-form" action="?controller=user&&action=Insert" method="post">

                    <div class="input-group mb-3">
                        <input name="ndoc" id="ndoc" type="text" class="form-control" placeholder="No. Identificación">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <input name="name" id="name" type="text" class="form-control" placeholder="Usuario">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>

                    <div class="input-group mb-3">
                        <select id="rol" name="rol" class="form-control" id="exampleFormControlSelect1">
                            <option value="0">Seleccione</option>
                            <option value="1">Coordinador</option>
                            <option value="2">Docente</option>
                            <option value="3">Acudiente</option>
                        </select>
                    </div>


                    <div class="input-group mb-3">
                        <input name="email" id="email" type="email" class="form-control" placeholder="Correo Electrónico">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="password" id="password" type="password" class="form-control" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input name="cpassword" id="cpassword" type="password" class="form-control" placeholder="Repetir password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input id="activo" name="activo" type="checkbox" value="0">
                                <label for="agreeTerms">
                                    Acepto todos los <a href="#">términos</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" id="submit_btn" data-loading-text="Registrando...." class="btn btn-warning btn-block">Registrar</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <div class="social-auth-links text-center">

                </div>

                <a href="?controller=user&action=Index" class="text-center">Ya tengo una cuenta</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

</body>

</html>