
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="<?php echo SITE_LANG; ?>">
<head>
  <!-- Agregar basepath para definir a partir de donde se deben generar los enlaces y la carga de archivos -->
  <base href="<?php echo BASEPATH; ?>">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="author" content="Carlosahh">
  <meta name="theme-color" content="#009688">
  <link rel="shortcut icon" href="<?= FAVICON; ?>favicon.ico" type="image/x-icon">
  <title><?php echo isset($d->title) ? $d->title.' - '.get_sitename() : get_sitename(); ?></title>

  <!-- inc_styles.php -->
  <?php require_once INCLUDES.'inc_styles.php'; ?>
  
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
  <div class="wrapper">
    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="<?= IMAGES;?>AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>
<?php
    include INCLUDES.'inc_nav.php';
    include INCLUDES.'inc_sidebar.php';
?>
<!-- ends inc_header.php -->