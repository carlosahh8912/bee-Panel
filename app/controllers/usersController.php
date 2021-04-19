<?php

/**
 * Plantilla general de controladores
 * Versión 1.0.2
 *
 * Controlador de users
 */
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
    $data = 
    [
      'title' => 'Usuarios',
      'functions' => 'functions_users.js'
    ];
    
    // Descomentar vista si requerida
    View::render('index', $data);
  }

  function verTodos()
  {
    try {
      $arrData = usersModel::all();

        for ($i = 0; $i < count($arrData); $i++) {  
          if ($arrData[$i]['estatus'] == 1) {
            $arrData[$i]['estatus'] = '<span class="badge badge-success p-2">Activo</span>';
          }else{
            $arrData[$i]['estatus'] = '<span class="badge badge-danger p-2">Inactivo</span>';
          }

          $arrData[$i]['opciones'] = 'acciones';
          $arrData[$i]['opciones'] = '
            <div class="text-center">
              <button class="btn btn-sm btn-info btnPermisosRol" title="Permisos" onClick="fntView('.$arrData[$i]['id'].')"><i class="fas fa-eye"></i></button>
              <button class="btn btn-sm btn-primary btnEditRol" title="Editar" onClick="fntEditRol('.$arrData[$i]['id'].')"><i class="fas fa-pencil-alt"></i></button>
              <button class="btn btn-sm btn-danger btnDelRol" title="Eliminar" onClick="fntDelRol('.$arrData[$i]['id'].')"><i class="fas fa-trash"></i></button>
            </div>
          ';          
      }
      json_output($arrData);
      die;
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function verapi($table){
    Api::index($table);
  }

  function ver($table, $id)
  {
    Api::show($table,$id);
  }

  function agregar()
  {
    View::render('agregar');
  }

  function post_agregar()
  {

  }

  function editar($id)
  {
    View::render('editar');
  }

  function post_editar()
  {

  }

  function borrar($id)
  {
    // Proceso de borrado
  }
}