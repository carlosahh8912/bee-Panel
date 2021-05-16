<?php 
require_once INCLUDES.'inc_header.php'; 
?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1 class=""><?php echo $d->title; ?></h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="home">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                  </ol>
                </div>
              </div>
            </div><!-- /.container-fluid -->
          </section>
      
          <!-- Main content -->
          <section class="content">
            <div class="col-12">
              <?php echo Flasher::flash(); ?>
            </div>
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista de Roles</h3>
      
                <div class="card-tools">
                  <button type="button" class="btn btn-info btn-sm" onclick="openModal();" title="Nuevo Rol">
                    <i class="fas fa-plus mr-2"></i> Nuevo Rol
                  </button>
                </div>
              </div>
              <div class="card-body">
              <table id="tableRoles" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>NOMBRE ROL</th>
                    <th>DESCRIPCIÓN</th>
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