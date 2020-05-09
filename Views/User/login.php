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
  <div class="login-box">
    <div class="login-logo">
      <img src="dist/img/logo.png" style="width: 80%; height: 80%;" alt="" srcset="">
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <h5 class="login-box-msg">Inicio de Sesión</h5>

        <form action="validar.php" method="post">
          <div class="input-group mb-3">
            <input name="user" type="text" class="form-control" placeholder="Usuario" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user-tie"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input name="password" type="password" class="form-control" placeholder="Password" required>
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <select name="module" class="form-control" id="exampleFormControlSelect1" required>
              <option value="0" selected>Seleccione</option>
              <option value="1">Módulo Administración Pagina Web</option>
              <option value="2">Módulo Sistema Académico Estudiantil</option>
              <option value="3">Módulo Financiero FFIRocaFuerte</option>
            </select>
          </div>
          <div class="row">
            <!-- /.col -->
            <input type="hidden" value="ok" name="oculto">
            <div class="col-12 mb-3">
              <button id="acceder" type="submit" class="btn btn-warning btn-block">Acceder</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>-->
        <!-- /.social-auth-links -->

        <p class="mb-1">
          <a href="resetPassword.html">¿Olvidaste la contraseña? </a>
        </p>
        <p class="mb-0">
          <a href="?controller=user&action=Register" class="text-center">Registrarse</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->


  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>