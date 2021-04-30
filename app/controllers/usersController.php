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
              <button class="btn btn-sm bg-gradient-primary btnEditRol" title="Editar" onClick="fntEditUser('.$arrData[$i]['id'].')"><i class="fas fa-pencil-alt"></i></button>
              <button class="btn btn-sm bg-gradient-danger btnDelRol" title="Eliminar" onClick="fntDelUser('.$arrData[$i]['id'].')"><i class="fas fa-trash"></i></button>
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
    foreach ($this->required_params as $param) {
      if(!isset($_POST[$param])) {
        json_output(json_build(403));
      }
    }

    if(!in_array($_POST['action'], $this->accepted_actions)) {
      json_output(json_build(403));
    }

    try {

      if(empty($_POST['txtNombreUser']) || empty($_POST['txtApellidoUser']) || empty($_POST['txtEmailUser']) || empty($_POST['selectTipoUser']) || empty($_POST['selectEstatusUser'])){
        json_output(json_build(400, null, 'Datos incorrectos, intentelo nuevamente.'));
      }else{
  
        if(intval(clean($_POST['idUser'])) == 0){
          $password = empty($_POST['txtPasswordUser']) ? password_hash(random_password().AUTH_SALT, PASSWORD_DEFAULT, ['cost' => 10]) : password_hash($_POST['txtPasswordUser'].AUTH_SALT, PASSWORD_DEFAULT, ['cost' => 10]);
          $data = [
            'nombre' => ucwords(clean($_POST['txtNombreUser'])),
            'apellido' => ucwords(clean($_POST['txtApellidoUser'])),
            'correo' => strtolower(clean($_POST['txtEmailUser'])),
            'password' => $password,
            'clave' => clean($_POST['txtClaveUser']),
            'idrol' => (int) clean($_POST['selectTipoUser']),
            'estatus' => (int) clean($_POST['selectEstatusUser']),
          ];
          //Comprobar si ya exste el correo
          if(Model::list('usuarios', ['correo' => strtolower(clean($_POST['txtEmailUser']))]) != null){
            json_output(json_build(400, null, 'El correo ya fue registrado antes por favor ingrese otro.'));
          }
          //Enviar datos al Modelo
          if(!$id = Model::add('usuarios', $data)) {
            json_output(json_build(400, null, 'Hubo error al guardar el registro'));
          }
          // se guardó con éxito
          json_output(json_build(201, Model::list('usuarios', ['id' => $id], 1), 'Movimiento agregado con éxito'));
        }else{
          $password = empty($_POST['txtPasswordUser']) ? "" : password_hash($_POST['txtPasswordUser'].AUTH_SALT, PASSWORD_DEFAULT, ['cost' => 10]);
          //Comprobar si ya exste el correo
          if(usersModel::userUnique(clean($_POST['idUser']), strtolower(clean($_POST['txtEmailUser']))) != null){

            json_output(json_build(400, null, 'El correo ya fue registrado antes por favor ingrese otro.'));
            
          }else{
            if($password != ""){
              $data = [
                'nombre' => ucwords(clean($_POST['txtNombreUser'])),
                'apellido' => ucwords(clean($_POST['txtApellidoUser'])),
                'correo' => strtolower(clean($_POST['txtEmailUser'])),
                'password' => $password,
                'clave' => clean($_POST['txtClaveUser']),
                'idrol' => (int) clean($_POST['selectTipoUser']),
                'estatus' => (int) clean($_POST['selectEstatusUser']),
              ];
            }else{
              $data = [
                'nombre' => ucwords(clean($_POST['txtNombreUser'])),
                'apellido' => ucwords(clean($_POST['txtApellidoUser'])),
                'correo' => strtolower(clean($_POST['txtEmailUser'])),
                'clave' => clean($_POST['txtClaveUser']),
                'idrol' => (int) clean($_POST['selectTipoUser']),
                'estatus' => (int) clean($_POST['selectEstatusUser']),
              ];
            }
             //Enviar datos al Modelo
            if(!$id = Model::update('usuarios', ['id' => clean($_POST['idUser'])] ,$data)) {
              json_output(json_build(400, null, 'Hubo error al guardar el registro'));
            }
            // se guardó con éxito
            json_output(json_build(201, Model::list('usuarios', ['id' => $id], 1), 'Usuario actualizado con éxito'));
          }
        }
      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function delete_user(){

    foreach ($this->required_params as $param) {
      if(!isset($_POST[$param])) {
        json_output(json_build(403));
      }
    }

    if(!in_array($_POST['action'], $this->accepted_actions)) {
      json_output(json_build(403));
    }

    try {

      if(isset($_POST['idUser']) != null){

        $id = intval(clean(($_POST['idUser'])));

        $data = [
          'estatus' => 0
        ];

        if(!$response = Model::update('usuarios', ['id' => $id] ,$data)) {

          json_output(json_build(400, null, 'Hubo error al borrar el registro.'));
        }

        json_output(json_build(201, null, 'El Usuarios ha sido eliminado.'));

      }else{

        json_output(json_build(400, null, 'Argumentos insuficientes.'));
      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }
}