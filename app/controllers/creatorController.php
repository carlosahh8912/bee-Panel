<?php 

/**
 * Controlador para generar modelos y controladores de forma dinámica
 */
class creatorController extends Controller {
  function __construct()
  {
  }
  
  function index() {
    View::render('index', ['title' => 'Crea un nuevo archivo']);
  }

  function controller()
  {
    View::render('controller', ['title' => 'Nuevo controlador']);
  }

  function model()
  {
    View::render('model', ['title' => 'Nuevo modelo']);
  }

  function post_controller()
  {
    if (!Csrf::validate($_POST['csrf'])) {
      Flasher::new('Acceso no autorizado.', 'danger');
      Redirect::back();
    }

    // Validar nombre de archivo
    $filename = clean($_POST['filename']);
    $filename = strtolower($filename);
    $filename = str_replace(' ', '_', $filename);
    $filename = str_replace('.php', '', $filename);
    $keyword  = 'Controller';
    $template = MODULES.'controllerTemplate.txt';

    // Validar la existencia del controlador para prevenir remover un archivo existente
    if (is_file(CONTROLLERS.$filename.$keyword.'.php')) {
      Flasher::new(sprintf('Ya existe el controladores %s.', $filename.$keyword), 'danger');
      Redirect::back();
    }

    // Validar la existencia de la plantilla .txt para crear el controlador
    if (!is_file($template)) {
      Flasher::new(sprintf('No existe la plantilla %s.', $template), 'danger');
      Redirect::back();
    }
    
    // Cargar contenido del archivo
    $php = @file_get_contents($template);
    $php = str_replace('[[REPLACE]]', $filename, $php);
    if (file_put_contents(CONTROLLERS.$filename.$keyword.'.php', $php) === false)  {
      Flasher::new(sprintf('Ocurrió un problema al crear el controlador %s.', $template), 'danger');
      Redirect::back();
    }

    // Crear el folder en carpeta vistas
    if (!is_dir(VIEWS.$filename)) {
      mkdir(VIEWS.$filename);

      $body = 
      '<?php require_once INCLUDES.\'inc_header.php\'; ?>
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
                    <li class="breadcrumb-item active">Blank Page</li>
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
                <h3 class="card-title">Title</h3>
      
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
                <?php echo $d->msg; ?>
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
                Footer
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
      
          </section>
          <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->    
      <?php require_once INCLUDES.\'inc_footer.php\'; ?>';
      
      @file_put_contents(VIEWS.$filename.DS.'indexView.php', $body);
    }

    // Crear una vista por defecto
    Redirect::to($filename);
  }

  function post_model()
  {
    if (!Csrf::validate($_POST['csrf'])) {
      Flasher::new('Acceso no autorizado.', 'danger');
      Redirect::back();
    }

    // Validar nombre de archivo
    $filename = clean($_POST['filename']);
    $filename = strtolower($filename);
    $filename = str_replace(' ', '_', $filename);
    $filename = str_replace('.php', '', $filename);
    $keyword  = 'Model';
    $template = MODULES.'modelTemplate.txt';

    if (is_file(CONTROLLERS.$filename.$keyword.'.php')) {
      Flasher::new(sprintf('Ya existe el modelo %s.', $filename.$keyword), 'danger');
      Redirect::back();
    }

    if (!is_file($template)) {
      Flasher::new(sprintf('No existe la plantilla %s.', $template), 'danger');
      Redirect::back();
    }
    
    // Cargar contenido del archivo
    $php = @file_get_contents($template);
    $php = str_replace('[[REPLACE]]', $filename, $php);
    if (file_put_contents(MODELS.$filename.$keyword.'.php', $php) === false)  {
      Flasher::new(sprintf('Ocurrió un problema al crear el modelo %s.', $template), 'danger');
      Redirect::back();
    }

    Flasher::new(sprintf('Modelo %s creado con éxito.', $filename.$keyword));
    Redirect::back();
  }
}