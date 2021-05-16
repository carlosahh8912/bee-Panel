<?php
class modulesController extends Controller {
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
    register_scripts([JS.'functions_modules.js'], 'Archivo con las funciones de la página Modulos');
    $data = 
    [
      'title' => 'Modulos',
    ];
    
    // Descomentar vista si requerida
    View::render('index', $data);
  }

}