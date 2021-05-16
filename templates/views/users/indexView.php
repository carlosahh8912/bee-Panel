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
                    <li class="breadcrumb-item active">Usuarios</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
      
          <!-- Main content -->
          <section class="content">
      
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Usuarios</h3>
      
                <div class="card-tools">
                  <button type="button" class="btn btn-info btn-sm" onclick="openModal();" title="Nuevo Usuario">
                    <i class="fas fa-plus mr-2"></i> Nuevo Usario
                  </button>
                </div>
              </div>
              <div class="card-body">
                <table id="tableUsers" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>APELLIDO</th>
                    <th>CORREO</th>
                    <th>ROL</th>
                    <th>ESTATUS</th>
                    <th>ACCIONES</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
      
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->    
      <?php 
      require_once INCLUDES.'inc_footer.php'; 
      require_once 'modalView.php';
      ?>