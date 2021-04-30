<?php

/**
 * Plantilla general de controladores
 * Versión 1.0.2
 *
 * Controlador de modules
 */
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
    $data = 
    [
      'title' => 'Reemplezar título',
      'msg'   => 'Bienvenido al controlador de "modules", se ha creado con éxito si ves este mensaje.'
    ];
    
    // Descomentar vista si requerida
    View::render('index', $data);
  }

  function get_links()
  {
    try {
      $data = Model::list('modulos', ['estatus' => 1]);

      foreach ($data as $key => $value) {
        
        $nombre = $value['url'];
        
        $link[$nombre] = $value;
      }

      $module = get_module('sidebar', $link);
      json_output(json_build(200, $module));
    } catch (Exception $e) {
      json_output(json_build(400, $e->getMessage()));
    }
   
  }

}