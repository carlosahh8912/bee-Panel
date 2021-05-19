<!DOCTYPE html>
<html lang="<?php echo SITE_LANG; ?>">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo isset($d->title) ? $d->title.' - '.get_sitename() : get_sitename(); ?></title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= PLUGINS?>fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= PLUGINS?>icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= CSS?>adminlte.min.css">
   <!-- Toastr css -->
   <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <!-- Waitme css -->
  <link rel="stylesheet" href="<?php echo PLUGINS.'waitme/waitMe.min.css'; ?>">
  <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo PLUGINS;?>sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="#" class="h1"><b>Bee</b>Panel</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">¿Olvidaste tu contraseña?, recuperala facilmente colocando tu correo con el que estas registrado.</p>
      <form id="forgotPasswordForm" name="forgotPasswordForm" novalidate>
        <div class="input-group mb-3">
          <?php echo insert_inputs(); ?>
          <input type="email" name="emailUser" id="emailUser" class="form-control validEmail" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block">Enviar correo</button>
            </div>
            <div class="col-12">
                <?php echo Flasher::flash(); ?>
            </div>    
          <!-- /.col -->
        </div>
      </form>
      <p class="mt-3 mb-1">
        <a href="/login">Ingresar</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?= PLUGINS?>jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= PLUGINS?>bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= JS?>adminlte.min.js"></script>
<!-- toastr js -->
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<!-- waitme js -->
<script src="<?php echo PLUGINS.'waitme/waitMe.min.js'; ?>"></script>
<!-- SweetAlert2 -->
<script src="<?php echo PLUGINS;?>sweetalert2/sweetalert2.min.js"></script>
<!-- jquery-validation -->
<script src="<?php echo PLUGINS;?>jquery-validation/jquery.validate.min.js"></script>
<script src="<?php echo PLUGINS;?>jquery-validation/additional-methods.min.js"></script>
<script src="<?php echo PLUGINS;?>jquery-validation/localization/messages_es.min.js"></script>

<script src="<?= JS?>functions.js"></script>
<!-- Scripts registrados manualmente -->
<?php echo load_scripts(); ?>

</body>
</html>
