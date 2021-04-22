<?php 

class homeController extends Controller {
  function __construct()
  {
    // Validación de sesión de usuario, descomentar si requerida

    if (!Auth::validate()) {
      Flasher::new('Debes iniciar sesión primero.', 'danger');
      Redirect::to('login');
    }
  }

  function index()
  {
    $data =
    [
      'title' => 'Dashboard',
    ];

    View::render('bee', $data);
  }

  
  function email()
  {
    try {
      $email   = 'mktgava@gmail.com';
      $subject = sprintf('[%s] Correo de prueba.', get_sitename());
      $body    = '
        <div class="card">
          <div class="card-body">
            Detalles del Usuario loggeado.
          </div>
        </div>
        <table class="table table-bordered table-hover table-responsive">
          <thead class="" >
            <tr class="">
              <th>ID</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Estatus</th>
            </tr>
          </thead>
          <tbody class="">
            <tr class="">
              <td>1386</td>
              <td class="text-success">'.$_SESSION['user_session']['user']['name'].'</td>
              <td class="text-warning">carlos@gmail.com</td>
              <td><span class="badge bg-success py-2 px-3">Activo</span></td>
            </tr>
          </tbody>
        </table>

      ';
      $alt     = 'El texto corto del correo, preview del contenido.';
      send_email(get_siteemail(), $email, $subject, $body, $alt);
      echo sprintf('Correo electrónico enviado con éxito a %s', $email);
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  function flash()
  {
    if (!Auth::validate()) {
      Flasher::new('Debes iniciar sesión primero.', 'danger');
      Redirect::to('login');
    }

    View::render('flash', ['title' => 'Flash', 'user' => User::profile()]);
  }

}