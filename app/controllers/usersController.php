<?php
class usersController extends Controller {

  private $accepted_actions = ['add', 'get', 'load', 'update', 'delete'];
  private $required_params  = ['hook', 'action'];

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

  function verTodos()
  {
    try {
      $arrData = usersModel::all();

        for ($i = 0; $i < count($arrData); $i++) {  
          if ($arrData[$i]['estatus'] == 1) {
            $arrData[$i]['estatus'] = '<span class="badge badge-success py-2 px-3">Activo</span>';
          }else{
            $arrData[$i]['estatus'] = '<span class="badge badge-danger py-2 px-3">Inactivo</span>';
          }

          $arrData[$i]['opciones'] = 'acciones';
          $arrData[$i]['opciones'] = '
            <div class="text-center">
              <button class="btn btn-sm bg-gradient-info btnPermisosRol" title="Detalles" onClick="fntView('.$arrData[$i]['id'].')"><i class="fas fa-eye"></i></button>
              <button class="btn btn-sm bg-gradient-primary btnEditRol" title="Editar" onClick="fntEditRol('.$arrData[$i]['id'].')"><i class="fas fa-pencil-alt"></i></button>
              <button class="btn btn-sm bg-gradient-danger btnDelRol" title="Eliminar" onClick="fntDelRol('.$arrData[$i]['id'].')"><i class="fas fa-trash"></i></button>
            </div>
          ';          
      }
      json_output($arrData);
      die;
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function get_user($id = null){

    foreach ($this->required_params as $param) {
      if(!isset($_POST[$param])) {
        json_output(json_build(403));
      }
    }

    if(!in_array($_POST['action'], $this->accepted_actions)) {
      json_output(json_build(403));
    }

    try {

      if ($id == null) {
        json_output(json_build(400, null, 'No hay datos para mostrar, ingrese un ID valido.'));
      }
      json_output(json_build(201, usersModel::by_id($id)));
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function post_agregar()
  {
    
  }
}