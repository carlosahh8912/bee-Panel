<?php

class rolesController extends Controller {

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

  function verRoles(){

    try {
      $arrData = rolesModel::list_active('roles' ,['estatus' => 0]);

        for ($i = 0; $i < count($arrData); $i++) {  
          if ($arrData[$i]['estatus'] == 1) {
            $arrData[$i]['estatus'] = '<span class="badge badge-success p-2">Activo</span>';
          }else{
            $arrData[$i]['estatus'] = '<span class="badge badge-danger p-2">Inactivo</span>';
          }

          $arrData[$i]['opciones'] = '
            <div class="text-center">
              <button class="btn btn-sm btn-primary btnEditRol" title="Editar" onClick="fntEditRol('.$arrData[$i]['id'].')"><i class="fas fa-pencil-alt"></i></button>
              <button class="btn btn-sm btn-secondary btnPermisosRol" title="Permisos" onClick="fntPermisos('.$arrData[$i]['id'].')"><i class="fas fa-key"></i></button>
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

  function ver($id = null)
  {
    try {

      if ($id == null) {
        json_output(json_build(400, null, 'No hay datos para mostrar, ingrese un ID valido.'));
      }
      json_output(json_build(201, Model::list('roles', ['id' => $id], 1)));
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function post_agregar()
  {

    foreach ($this->required_params as $param) {
      if(!isset($_POST[$param])) {
        json_output(json_build(403));
      }
    }

    if(!in_array($_POST['action'], $this->accepted_actions)) {
      json_output(json_build(403));
    }

    try {

      $data = [
        'nombre' =>clean($_POST['txtNombreRol']),
        'descripcion' => clean($_POST['txtDescripcionRol']),
        'estatus' => intval($_POST['estatusRol'])
      ];

      
      if(intval(clean($_POST['idRol']))  == 0){
        if(Model::list('roles', ['nombre' => clean($_POST['txtNombreRol'])]) != null){
          json_output(json_build(400, null, 'El Rol ya existe.'));
        }
        if(!$id = Model::add('roles', $data)) {
          json_output(json_build(400, null, 'Hubo error al guardar el registro'));
        }
        // se guardó con éxito
        json_output(json_build(201, Model::list('roles', ['id' => $id], 1), 'Movimiento agregado con éxito'));
      }else{

        if(empty(rolesModel::one_dif(clean($_POST['txtNombreRol']), intval(clean($_POST['idRol']))))){

          if(!$id = Model::update('roles', ['id' => intval(clean($_POST['idRol']))] ,$data)) {
            json_output(json_build(400, null, 'Hubo error al actualizar el registro'));
          }
          json_output(json_build(201, Model::list('roles', ['id' => $id], 1), 'Rol actualizado con éxito'));

        }else{

          json_output(json_build(400, null, 'El Rol ya existe.'));
        }

      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function borrar()
  {
    try {

      if(isset($_POST['idRol']) != null){

        $id = intval(clean(($_POST['idRol'])));

        $data = [
          'estatus' => 0
        ];

        if(!$response = Model::update('roles', ['id' => $id] ,$data)) {

          json_output(json_build(400, null, 'Hubo error al borrar el registro.'));
        }

        json_output(json_build(201, null, 'El Rol ha sido eliminado.'));

      }else{

        json_output(json_build(400, null, 'Argumentos insuficientes.'));
      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function get_roles(){

    foreach ($this->required_params as $param) {
      if(!isset($_POST[$param])) {
        json_output(json_build(403));
      }
    }

    if(!in_array($_POST['action'], $this->accepted_actions)) {
      json_output(json_build(403));
    }

    try {
      $htmlOptions ="";
      $arrData = Model::list('roles' ,['estatus' => 1]);
      if (count($arrData) > 0) {
        for ($i = 0; $i < count($arrData); $i++) {
          if ($arrData[$i]['estatus'] == 1){
            $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['nombre'].'</option>';
          }
        }
      }
      json_output(json_build(200, $htmlOptions));
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }
}