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
      $email   = 'jslocal2@localhost.com';
      $subject = 'El asunto del correo';
      $body    = 'El cuerpo del mensaje, puede ser html o texto plano.';
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