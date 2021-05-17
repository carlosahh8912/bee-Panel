<?php

class rolesController extends Controller {

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

    register_styles([PLUGINS.'bootstrap-toggle/css/bootstrap-toggle.min.css'], 'Bootstrap Toggle');
    register_scripts([PLUGINS.'bootstrap-toggle/js/bootstrap-toggle.min.js'], 'Bootstrap Toggle');
    register_scripts([JS.'functions_roles.js'], 'Archivo con las funciones de la página roles');

    $data = 
    [
      'title' => 'Roles del sistema',
    ];
    
    // Descomentar vista si requerida
    View::render('index', $data);
  }

  
}