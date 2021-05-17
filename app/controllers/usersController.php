<?php
class usersController extends Controller {

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
    register_scripts([JS.'functions_users.js'], 'Archivo con las funciones de la página Usuarios');

    $data = 
    [
      'title' => 'Usuarios',
    ];
    
    // Descomentar vista si requerida
    View::render('index', $data);
  }
}