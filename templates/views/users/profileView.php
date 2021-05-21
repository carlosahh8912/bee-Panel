<?php require_once INCLUDES.'inc_header.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= $d->title;?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Perfil de Usuario</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-success card-outline">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img border-success img-fluid img-circle"
                            src="<?= $_SESSION['user_session']['user']['avatar'] != null ? $_SESSION['user_session']['user']['avatar'] : 'https://ui-avatars.com/api/?name='.$_SESSION['user_session']['user']['name'].'+'.$_SESSION['user_session']['user']['lastname'].'&background=random&format=svg' ?>"
                            alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center"> <?= $_SESSION['user_session']['user']['name'].' '.$_SESSION['user_session']['user']['lastname'];?></h3>

                        <p class="text-muted text-center"><?= $_SESSION['user_session']['user']['nombrerol'];?></p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Clientes</b> <a class="float-right">0</a>
                            </li>
                            <li class="list-group-item">
                                <b>Pedidos</b> <a class="float-right">0</a>
                            </li>
                        </ul>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
            <div class="col-md-9">

                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Datos de Usuario</a></li>
                            <li class="nav-item"><a class="nav-link" href="#changePassword" data-toggle="tab">Contraseña</a></li>
                            <li class="nav-item"><a class="nav-link" href="#changeImgProfile" data-toggle="tab">Imagen de Perfil</a></li>
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Actividad</a></li>
                        </ul>
                    </div><!-- /.card-header -->

                    <div class="card-body">
                        <div class="tab-content">

                        <div class="active tab-pane" id="settings">
                            <form class="form-horizontal" novalidate>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Nombre</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName" value="<?= $_SESSION['user_session']['user']['name']?>" placeholder="Nombre" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Apellido</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputName2" value="<?= $_SESSION['user_session']['user']['lastname']?>" placeholder="Apellido" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                <input type="email" class="form-control" id="inputEmail" value="<?= $_SESSION['user_session']['user']['email']?>" placeholder="Email" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">Actualizar</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="activity">

                            <div class="row">

                            <?php 

                                $sessions = unique_multidim_array($_SESSION['sessions'], 'ip_address');

                                debug($sessions);

                            
                            
                                    
                            ?>
                                
                                <div class="col-md-3 col-sm-6 col-12">
                                    <div class="info-box shadow-lg">
                                    <span class="info-box-icon bg-warning"><i class="fas fa-desktop"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text"> <span class="ml-2 badge badge-success badge-pill"><small>Activo</small></span></span>
                                        <span class="info-box-number"></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                    </div>
                                    <!-- /.info-box -->
                                </div>
                                <!-- /.col -->
      
                            </div>

                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="changeImgProfile">


                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="changePassword">
                        <form class="form-horizontal" novalidate>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Contraseña</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputName"  placeholder="Contraseña" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputName2" class="col-sm-2 col-form-label">Nueva Contraseña</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputName2" placeholder="Nueva Contraseña" required>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Confirmar Contraseña</label>
                                <div class="col-sm-10">
                                <input type="password" class="form-control" id="inputEmail"  placeholder="Confirmar Contraseña" required>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <div class="offset-sm-2 col-sm-10">
                                <button type="submit" class="btn btn-success btn-block">Actualizar</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->


        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php 
    require_once INCLUDES.'inc_footer.php'; 
?>