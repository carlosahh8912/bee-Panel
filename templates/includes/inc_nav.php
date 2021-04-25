<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="home" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="frame" class="nav-link">Multi ventana</a>
        </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    

    <li class="nav-item">
        <a class="nav-link">
        <div class="form-group">
            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
            <input type="checkbox" class="custom-control-input" id="customSwitch3">
            <label class="custom-control-label text-warning" for="customSwitch3"><i id="dm-icon" class="far fa-sun"></i></label>
            </div>
        </div>
        </a>
    </li>

    
    <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
        <img src="<?= $_SESSION['user_session']['user']['avatar'] != null ? $_SESSION['user_session']['user']['avatar'] : 'https://ui-avatars.com/api/?name='.$_SESSION['user_session']['user']['nombre'].'+'.$_SESSION['user_session']['user']['apellido'].'&background=random&format=svg' ?>" class="user-image img-circle elevation-2" alt="User Image">
        <span class="d-none d-md-inline"><?= $_SESSION['user_session']['user']['nombre'].' '.$_SESSION['user_session']['user']['apellido'];?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <!-- User image -->
        <li class="user-header bg-primary">
            <img src="<?= $_SESSION['user_session']['user']['avatar'] != null ? $_SESSION['user_session']['user']['avatar'] : 'https://ui-avatars.com/api/?name='.$_SESSION['user_session']['user']['nombre'].'+'.$_SESSION['user_session']['user']['apellido'].'&background=random&format=svg' ?>" class="img-circle elevation-2" alt="User Image">

            <p>
            <?= $_SESSION['user_session']['user']['nombre'].' '.$_SESSION['user_session']['user']['apellido'];?>
            <small><?= $_SESSION['user_session']['user']['nombrerol'];?></small>
            </p>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="row">
            </div>
            <!-- /.row -->
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <a href="users/profile" class="btn btn-default btn-flat">Perfil</a>
            <a href="logout" class="btn btn-default btn-flat float-right">Salir</a>
        </li>
        </ul>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
        <i class="fas fa-expand-arrows-alt"></i>
        </a>
    </li>
    </ul>
</nav>
<!-- /.navbar -->
