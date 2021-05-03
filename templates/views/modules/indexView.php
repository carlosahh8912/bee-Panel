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
              <li class="breadcrumb-item active">Modulos</li>
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
          <h3 class="card-title">Lista de Modulos</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-primary" onclick="openModal();" title="Nuevo Usuario">
              <i class="fas fa-plus mr-2"></i> Nuevo Modulo
            </button>
          </div>
        </div>
        <div class="card-body">
          <table id="tableModules" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>ID</th>
              <th>NOMBRE</th>
              <th>ICONO</th>
              <th>URL</th>
              <th>URL SELECCIÓN</th>
              <th>MODULOS HIJOS</th>
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