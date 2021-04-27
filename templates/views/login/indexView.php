<!DOCTYPE html>
<html lang="<?php echo SITE_LANG; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="Carlosahh">
  <meta name="theme-color" content="#009688">
  <link rel="shortcut icon" href="<?= FAVICON; ?>favicon.ico" type="image/x-icon">
  <title><?php echo isset($d->title) ? $d->title.' - '.get_sitename() : get_sitename(); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo PLUGINS;?>fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo PLUGINS;?>icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo CSS;?>adminlte.min.css">
</head>
<body class="hold-transition login-page dark-mode">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="home" class="h1"><b>Bee</b> Panel</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">INICIAR SESIÓN</p>

      <form action="login/post_login" method="post" novalidate>
        <?php echo insert_inputs(); ?>
        <div class="input-group mb-3">
          <input type="email" class="form-control validEmail" id="usuario" name="usuario" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col">
            <button type="submit" class="btn btn-primary btn-block">Ingresar</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        <?php echo Flasher::flash(); ?>
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1">
        <a href="login/forgot-password">Olvide mi contraseña</a>
      </p>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo PLUGINS;?>jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo PLUGINS;?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo JS;?>adminlte.min.js"></script>
<script src="<?= JS?>functions.js"></script>
</body>
</html>


