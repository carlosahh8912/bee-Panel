<?php require_once INCLUDES.'inc_header.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo $d->title; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="home">Home</a></li>
              <li class="breadcrumb-item active">Nuevo Controlador</li>
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
          <h3 class="card-title"><?php echo $d->title; ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <form action="creator/post_controller" method="post" novalidate>
              <?php echo insert_inputs(); ?>
              
              <div class="mb-3">
                <label for="filename">Nombre del controlador (sin "Controller.php")</label>
                <input type="text" class="form-control" id="filename" name="filename" placeholder="reports" required>
              </div>

              <button class="btn btn-primary btn-lg btn-block" type="submit">Crear ahora</button>
            </form>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <a class="btn btn-success" href="<?php echo 'creator/model' ?>">Nuevo modelo</a>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


<?php require_once INCLUDES.'inc_footer.php'; ?>

