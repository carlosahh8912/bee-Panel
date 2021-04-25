<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="home" class="brand-link">
    <img src="<?= IMAGES.'AdminLTELogo.png'; ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Bee Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="<?= $_SESSION['user_session']['user']['avatar'] != null ? $_SESSION['user_session']['user']['avatar'] : 'https://ui-avatars.com/api/?name='.$_SESSION['user_session']['user']['nombre'].'+'.$_SESSION['user_session']['user']['apellido'].'&background=random&format=svg' ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
        <a href="users/profile" class="d-block"><?= $_SESSION['user_session']['user']['nombre'].' '.$_SESSION['user_session']['user']['apellido'];?></a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
            <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
            </button>
        </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-flat" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="home" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
                Dashboard
            </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="#" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
            </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="users" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Usuarios</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="roles" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Roles</p>
                </a>
            </li>
            </ul>
        </li>
        <li class="nav-item">
            <a href="logout" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
                Salir
            </p>
            </a>
        </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>