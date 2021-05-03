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

  function get_modules(){
    try {
      $data = Model::list('modulos' ,['estatus' => 1]);

        for ($i = 0; $i < count($data); $i++) {  
          if ($data[$i]['estatus'] == 1) {
            $data[$i]['estatus'] = '<span class="badge badge-pill badge-success py-2 px-3">Activo</span>';
          }else{
            $data[$i]['estatus'] = '<span class="badge badge-pill badge-danger py-2 px-3">Inactivo</span>';
          }

          $data[$i]['icon'] = '<i class="'.$data[$i]['icono'].'"></i>';

          $data[$i]['opciones'] = '
            <div class="text-center">
              <button class="btn btn-sm btn-primary btnEditRol" title="Editar" onClick="fntEditModule('.$data[$i]['id'].')"><i class="fas fa-pencil-alt"></i></button>
              <button class="btn btn-sm btn-danger btnDelRol" title="Eliminar" onClick="fntDelModule('.$data[$i]['id'].')"><i class="fas fa-trash"></i></button>
            </div>
          ';          
      }
      json_output($data);
      die;
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
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