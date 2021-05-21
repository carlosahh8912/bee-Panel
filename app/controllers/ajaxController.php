<?php 

class ajaxController extends Controller {
  
  private $accepted_actions = ['add', 'get', 'load', 'update', 'delete'];
  private $required_params  = ['hook', 'action'];

  function __construct()
  {
    foreach ($this->required_params as $param) {
      if(!isset($_POST[$param])) {
        json_output(json_build(403));
      }
    }

    if(!in_array($_POST['action'], $this->accepted_actions)) {
      json_output(json_build(403));
    }
  }

  function index()
  {
    /**
    200 OK
    201 Created
    300 Multiple Choices
    301 Moved Permanently
    302 Found
    304 Not Modified
    307 Temporary Redirect
    400 Bad Request
    401 Unauthorized
    403 Forbidden
    404 Not Found
    410 Gone
    500 Internal Server Error
    501 Not Implemented
    503 Service Unavailable
    550 Permission denied
    */
    json_output(json_build(403));
  }

// 
//  AJAX MODULES 
// 
  function get_modules(){
    try {
      $data = modulesModel::all();

        for ($i = 0; $i < count($data); $i++) {  
          if ($data[$i]['status'] == 'active') {
            $data[$i]['status'] = '<span class="badge badge-pill badge-success py-2 px-3">Activo</span>';
          }else{
            $data[$i]['status'] = '<span class="badge badge-pill badge-danger py-2 px-3">Inactivo</span>';
          }

          $data[$i]['icon'] = '<i class="'.$data[$i]['icon'].'"></i>';

          $data[$i]['options'] = '
            <div class="text-center">
              <button class="btn btn-sm btn-primary" title="Editar" onClick="fntEditModule('.$data[$i]['id'].')"><i class="fas fa-pencil-alt"></i></button>
              <button class="btn btn-sm btn-danger" title="Eliminar" onClick="fntDelModule('.$data[$i]['id'].')"><i class="fas fa-trash"></i></button>
            </div>
          ';          
      }
      json_output(json_build(201, $data, 'Datos cargados con exito.'));
      die;
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function get_links()
  {
    try {
      $data = Model::list('modules', ['status' => 'active']);

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

  function add_module(){
    try {

      $data = [
        'name' =>clean($_POST['nameModule']),
        'icon' =>clean($_POST['iconModule']),
        'url' =>clean($_POST['urlModule']),
        'url_name' =>clean($_POST['activeModule']),
        'treeview' =>clean($_POST['selectTypeModule']),
        'status' => clean($_POST['selectStatusModule'])
      ];

      
      if(intval(clean($_POST['idModule']))  == 0){
        //validar que no se repita el registro
        if(Model::list('modules', ['name' => clean($_POST['nameModule'])]) != null){
          json_output(json_build(400, null, 'El Modulo ya existe.'));
        }

        //Agregando registro nuevo
        if(!$id = Model::add('modules', $data)) {
          json_output(json_build(400, null, 'Hubo error al guardar el registro'));
        }
        // se guardó con éxito
        json_output(json_build(201, Model::list('modules', ['id' => $id], 1), 'Movimiento agregado con éxito'));
      }else{

        if(empty(modulesModel::norepeat(clean($_POST['nameModule']), intval(clean($_POST['idModule']))))){

          if(!$id = Model::update('modules', ['id' => intval(clean($_POST['idModule']))] ,$data)) {
            json_output(json_build(400, null, 'Hubo error al actualizar el registro'));
          }
          json_output(json_build(201, Model::list('modules', ['id' => $id], 1), 'Registro actualizado con éxito'));

        }else{

          json_output(json_build(400, null, 'El Modulo ya existe.'));
        }

      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function show_module(){
    try {

      $id = intval(clean($_POST['idModule']));
      if(!$view = Model::list('modules', ['id' => $id], 1)) {
        json_output(json_build(400, null, 'Hubo error al guardar el registro'));
      }
  
      // se guardó con éxito
      $id = $id;
      json_output(json_build(201, Model::list('modules', ['id' => $id], 1), 'Datos cargados con éxito'));
      
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function delete_module(){
    try {
      $id = intval(clean($_POST['idModule']));

      if(!$delete = Model::update('modules', ['id' => $id],  ['status' => 'deleted'])) {
        json_output(json_build(400, null, 'Hubo error al borrar el registro'));
      }

      json_output(json_build(200, null, 'Movimiento borrado con éxito'));
      
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

//
// AJAX ROLES
// 

  function get_roles(){

    try {
      $arrData = rolesModel::all('roles' ,['status' => 'deleted']);

        for ($i = 0; $i < count($arrData); $i++) {  
          if ($arrData[$i]['status'] == 'active') {
            $arrData[$i]['status'] = '<span class="badge badge-pill badge-success py-2 px-3">Activo</span>';
          }else{
            $arrData[$i]['status'] = '<span class="badge badge-pill badge-danger py-2 px-3">Inactivo</span>';
          }

          $arrData[$i]['options'] = '
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

  function show_role()
  {
    try {
      $id = intval(clean($_POST['idRole']));

      if ($id == null) {
        json_output(json_build(400, null, 'No hay datos para mostrar, ingrese un ID valido.'));
      }
      json_output(json_build(201, Model::list('roles', ['id' => $id], 1)));
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function add_role()
  {
    try {

      $data = [
        'name' =>clean($_POST['nameRole']),
        'description' => clean($_POST['descriptionRole']),
        'status' => clean($_POST['selectStatusRole'])
      ];

      
      if(intval(clean($_POST['idRole']))  == 0){
        if(Model::list('roles', ['name' => clean($_POST['nameRole'])]) != null){
          json_output(json_build(400, null, 'El Rol ya existe.'));
        }
        if(!$id = Model::add('roles', $data)) {
          json_output(json_build(400, null, 'Hubo error al guardar el registro'));
        }
        // se guardó con éxito
        json_output(json_build(201, Model::list('roles', ['id' => $id], 1), 'Movimiento agregado con éxito'));
      }else{

        if(empty(rolesModel::one_dif(clean($_POST['nameRole']), intval(clean($_POST['idRole']))))){

          if(!$id = Model::update('roles', ['id' => intval(clean($_POST['idRole']))] ,$data)) {
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

  function delete_role()
  {
    try {

      if(isset($_POST['idRole']) != null){

        $id = intval(clean(($_POST['idRole'])));

        $data = [
          'status' => 'deleted'
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

  function get_user_roles(){

    try {
      $htmlOptions ="";
      $arrData = Model::list('roles' ,['status' => 'active']);
      if (count($arrData) > 0) {
        for ($i = 0; $i < count($arrData); $i++) {
          if ($arrData[$i]['status'] == 'active'){
            $htmlOptions .= '<option value="'.$arrData[$i]['id'].'">'.$arrData[$i]['name'].'</option>';
          }
        }
      }
      json_output(json_build(200, $htmlOptions));
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function get_permissions_role(){

    try {
      $idRole = intval(clean($_POST['idRole']));
      if ($idRole > 0) {
        $modulos = Model::list('modules', ['status' => 'active']);
        $permisosRol = Model::list('permissions', ['id_role' => $idRole]);
        $permisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
        $permisoRol = array('id_role' => $idRole);

        if(empty($permisosRol))
        {
          for ($i=0; $i < count($modulos) ; $i++) { 

            $modulos[$i]['permisos'] = $permisos;
          }
        }else{
          for ($i=0; $i < count($modulos); $i++) {
            $permisos = array('r' => 0, 'w' => 0, 'u' => 0, 'd' => 0);
            if(isset($permisosRol[$i])){
              $permisos = array(
                          'r' => $permisosRol[$i]['r'], 
                          'w' => $permisosRol[$i]['w'], 
                          'u' => $permisosRol[$i]['u'], 
                          'd' => $permisosRol[$i]['d'] 
                        );
            }
            $modulos[$i]['permisos'] = $permisos;
          }
        }
        $permisoRol['modulos'] = $modulos;
        // $html = getModal("modalPermisos",$permisoRol);
        $data = get_module('permissions', $permisoRol);
        json_output(json_build(200, $data));

      }

      json_output(json_build(400, null, 'Argumentos insuficientes.'));

    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
    
  }

  function add_permissions(){
    try {
      if($_POST)
			{
				$idRole = intval($_POST['idRole']);
				$modulos = $_POST['modulos'];

				Model::remove('permissions', ['id_role' => $idRole],null);
				foreach ($modulos as $modulo) {
          $data = [
              'id_role' => $idRole,
              'id_module' => $modulo['id'],
              'r' => empty($modulo['r']) ? 0 : 1,
              'w' => empty($modulo['w']) ? 0 : 1,
              'u' => empty($modulo['u']) ? 0 : 1,
              'd' => empty($modulo['d']) ? 0 : 1,
          ];
				
					$requestPermiso = Model::add('permissions', $data);
				}
				if($requestPermiso > 0)
				{
					json_output(json_build(201, null, 'Movimiento agregado con éxito'));
				}else{
					json_output(json_build(400, null, 'Hubo error al guardar el registro'));
				}
			}

			json_output(json_build(400, null, 'Argumentos insuficientes.'));

    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

//   
// AJAX USERS
// 
  function get_users()
  {
    try {
      $arrData = usersModel::all();

        for ($i = 0; $i < count($arrData); $i++) {  
          if ($arrData[$i]['status'] == 'active') {
            $arrData[$i]['status'] = '<span class="badge badge-pill badge-success py-2 px-3">Activo</span>';
          }else{
            $arrData[$i]['status'] = '<span class="badge badge-pill badge-danger py-2 px-3">Inactivo</span>';
          }

          $arrData[$i]['options'] = '
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

  function get_user(){
    try {
      $id = clean(intval($_POST['idUser']));
      if ($id == null) {
        json_output(json_build(400, null, 'No hay datos para mostrar, ingrese un ID valido.'));
      }
      json_output(json_build(201, usersModel::by_id($id)));
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function add_user()
  {
    try {

      if(empty($_POST['nameUser']) || empty($_POST['lastnameUser']) || empty($_POST['emailUser']) || empty($_POST['selectRoleUser']) || empty($_POST['selectStatusUser'])){
        json_output(json_build(400, null, 'Datos incorrectos, intentelo nuevamente.'));
      }else{

        if(intval(clean($_POST['idUser'])) == 0){
          $password = empty($_POST['passwordUser']) ? password_hash(random_password().AUTH_SALT, PASSWORD_DEFAULT, ['cost' => 10]) : password_hash($_POST['passwordUser'].AUTH_SALT, PASSWORD_DEFAULT, ['cost' => 10]);
          $data = [
            'name' => ucwords(clean($_POST['nameUser'])),
            'lastname' => ucwords(clean($_POST['lastnameUser'])),
            'email' => strtolower(clean($_POST['emailUser'])),
            'password' => $password,
            'clave' => clean($_POST['claveUser']),
            'id_rol' => (int) clean($_POST['selectRoleUser']),
            'status' => clean($_POST['selectStatusUser']),
          ];
          //Comprobar si ya exste el email
          if(Model::list('users', ['email' => strtolower(clean($_POST['emailUser']))]) != null){
            json_output(json_build(400, null, 'El email ya fue registrado antes por favor ingrese otro.'));
          }
          //Enviar datos al Modelo
          if(!$id = Model::add('users', $data)) {
            json_output(json_build(400, null, 'Hubo error al guardar el registro'));
          }
          // se guardó con éxito
          json_output(json_build(201, Model::list('users', ['id' => $id], 1), 'Movimiento agregado con éxito'));
        }else{
          $password = empty($_POST['passwordUser']) ? "" : password_hash($_POST['passwordUser'].AUTH_SALT, PASSWORD_DEFAULT, ['cost' => 10]);
          //Comprobar si ya exste el email
          if(usersModel::userUnique(clean($_POST['idUser']), strtolower(clean($_POST['emailUser']))) != null){

            json_output(json_build(400, null, 'El email ya fue registrado antes por favor ingrese otro.'));
            
          }else{
            if($password != ""){
              $data = [
                'name' => ucwords(clean($_POST['nameUser'])),
                'lastname' => ucwords(clean($_POST['lastnameUser'])),
                'email' => strtolower(clean($_POST['emailUser'])),
                'password' => $password,
                'clave' => clean($_POST['claveUser']),
                'id_rol' => (int) clean($_POST['selectRoleUser']),
                'status' => clean($_POST['selectStatusUser']),
              ];
            }else{
              $data = [
                'name' => ucwords(clean($_POST['nameUser'])),
                'lastname' => ucwords(clean($_POST['lastnameUser'])),
                'email' => strtolower(clean($_POST['emailUser'])),
                'clave' => clean($_POST['claveUser']),
                'id_rol' => (int) clean($_POST['selectRoleUser']),
                'status' => clean($_POST['selectStatusUser']),
              ];
            }
            //Enviar datos al Modelo
            if(!$id = Model::update('users', ['id' => clean($_POST['idUser'])] ,$data)) {
              json_output(json_build(400, null, 'Hubo error al guardar el registro'));
            }
            // se guardó con éxito
            json_output(json_build(201, Model::list('users', ['id' => $id], 1), 'Usuario actualizado con éxito'));
          }
        }
      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function delete_user(){

    try {

      if(isset($_POST['idUser']) != null){

        $id = intval(clean(($_POST['idUser'])));

        $data = [
          'status' => 'deleted'
        ];

        if(!$response = Model::update('users', ['id' => $id] ,$data)) {

          json_output(json_build(400, null, 'Hubo error al borrar el registro.'));
        }

        json_output(json_build(201, null, 'El Usuario ha sido eliminado.'));

      }else{

        json_output(json_build(400, null, 'Argumentos insuficientes.'));
      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function forgot_password(){
    if (!Csrf::validate($_POST['csrf']) || !check_posted_data(['emailUser','csrf'], $_POST)) {
      Flasher::new('Acceso no autorizado.', 'danger');
      Redirect::back();
    }

    try {

      if($_POST['emailUser'] != null){

        $email =strtolower(clean($_POST['emailUser']));

        if(!$user = Model::list('users', ['email' => $email, 'status' => 'active'] , 1)) {
          json_output(json_build(400, null, 'El usuario no existe.'));
        }

        Model::update('users', ['id' => $user['id'], 'status' => 'active'], ['token' => generate_token()]);


        $recovery = Model::list('users', ['email' => $email, 'status' => 'active'] , 1);

        $data= [
          'email' => $recovery['email'],
          'name' => $recovery['name'],
          'url' => URL.'login/recovery-password/'.$recovery['email'].'/'.$recovery['token']
        ];

        $email = new ajaxController;

        $email->email_recovery($data);

        Flasher::new('Se envío un email a tu correo para continuar con el proceso.', 'success');
        json_output(json_build(201, null, 'Se ha enviado un correo con los datos de recuperación.'));
        
      }else{

        json_output(json_build(400, null, 'Argumentos insuficientes.'));
      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function email_recovery($data=[])
  {
    try {
      $email   = $data['email'];
      $subject = sprintf('[%s] Recuperación de contraseña.', get_sitename());
      $body    = '
          <div class="card">
            <div class="card-header">
              Recuperación de contraseña
            </div>
            <div class="card-body">
              <h5 class="card-title text-info">¡Hola '.$data['name'].'!</h5>
              <p class="card-text">Se ha solicitado la recuperación de tu cuenta <span class="text-success">'.$data['email'].'</span>.</p>
              <p class="card-text">Para continuar con la recuperación haz click en el botton reestablecer contraseña.</p>
              <a href="'.$data['url'].'" class="btn btn-primary">Reestablecer contraseña</a>
            </div>
            <div class="card-footer">
              <p class="card-text"><small>Si no funciona el botón puedes copiar y pegar en tu explorador el siguiente enlace: <br> <span class="text-success">'.$data['url'].'</span></small></p>
            </div>
          </div>
      ';
      $alt     = 'Recuperación de contraseña Bee Panel.';
      send_email(get_siteemail(), $email, $subject, $body, $alt);
      return true;
    } catch (Exception $e) {
      echo $e->getMessage();
    }
  }

  function recovery_password(){
    if (!Csrf::validate($_POST['csrf']) || !check_posted_data(['emailUser','csrf','tokenUser','newPassword','retypePassword'], $_POST)) {
      // Flasher::new('Acceso no autorizado.', 'danger');
      // Redirect::back();
      json_output(json_build(400, null, 'Acceso no autorizado.'));
    }

    try {

      if($_POST['emailUser'] != null){

        $email =strtolower(clean($_POST['emailUser']));
        $token = clean($_POST['tokenUser']);
        $newPassword = clean($_POST['newPassword']);
        $retypePassword= clean($_POST['retypePassword']);

        if(!$user = Model::list('users', ['email' => $email, 'status' => 'active', 'token' => $token] , 1)) {
          json_output(json_build(400, null, 'Datos incorrectos.'));
        }

        if($newPassword != $retypePassword){
          json_output(json_build(400, null, 'Las contraseñas no coinsiden.'));
        }

        $password = password_hash($newPassword.AUTH_SALT, PASSWORD_DEFAULT, ['cost' => 10]);

        Model::update('users', ['id' => $user['id'], 'status' => 'active'], ['token' => '', 'password' => $password]);

        Flasher::new('Contraseña actualizada correctamente.', 'success');
        json_output(json_build(201, null, 'La contraseña se actualizo.'));
        
      }else{

        json_output(json_build(400, null, 'Argumentos insuficientes.'));
      }
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }

  }



//   
// 
// AJAX 
//  
// 
























































  function bee_add_movement()
  {
    try {
      $mov              = new movementModel();
      $mov->type        = $_POST['type'];
      $mov->description = $_POST['description'];
      $mov->amount      = (float) $_POST['amount'];
      if(!$id = $mov->addMov()) {
        json_output(json_build(400, null, 'Hubo error al guardar el registro'));
      }
  
      // se guardó con éxito
      $mov->id = $id;
      json_output(json_build(201, $mov->one(), 'Movimiento agregado con éxito'));
      
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function bee_get_movements()
  {
    try {
      $movements          = new movementModel;
      $movs               = $movements->all_by_date();

      $taxes              = (float) get_option('taxes') < 0 ? 16 : get_option('taxes');
      $use_taxes          = get_option('use_taxes') === 'Si' ? true : false;
      
      $total_movements    = $movs[0]['total'];
      $total              = $movs[0]['total_incomes'] - $movs[0]['total_expenses'];
      $subtotal           = $use_taxes ? $total / (1.0 + ($taxes / 100)) : $total;
      $taxes              = $subtotal * ($taxes / 100);
      
      $calculations       = [
        'total_movements' => $total_movements,
        'subtotal'        => $subtotal,
        'taxes'           => $taxes,
        'total'           => $total
      ];

      $data = get_module('movements', ['movements' => $movs, 'cal' => $calculations]);
      json_output(json_build(200, $data));
    } catch(Exception $e) {
      json_output(json_build(400, $e->getMessage()));
    }

  }

  function bee_delete_movement()
  {
    try {
      $mov     = new movementModel();
      $mov->id = $_POST['id'];

      if(!$mov->delete()) {
        json_output(json_build(400, null, 'Hubo error al borrar el registro'));
      }

      json_output(json_build(200, null, 'Movimiento borrado con éxito'));
      
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function bee_update_movement()
  {
    try {
      $movement     = new movementModel;
      $movement->id = $_POST['id'];
      $mov          = $movement->one();

      if(!$mov) {
        json_output(json_build(400, null, 'No existe el movimiento'));
      }

      $data = get_module('updateForm', $mov);
      json_output(json_build(200, $data));
    } catch(Exception $e) {
      json_output(json_build(400, $e->getMessage()));
    }
  }

  function bee_save_movement()
  {
    try {
      $mov              = new movementModel();
      $mov->id          = $_POST['id'];
      $mov->type        = $_POST['type'];
      $mov->description = $_POST['description'];
      $mov->amount      = (float) $_POST['amount'];
      if(!$mov->updateMov()) {
        json_output(json_build(400, null, 'Hubo error al guardar los cambios'));
      }
  
      // se guardó con éxito
      json_output(json_build(200, $mov->one(), 'Movimiento actualizado con éxito'));
      
    } catch (Exception $e) {
      json_output(json_build(400, null, $e->getMessage()));
    }
  }

  function bee_save_options()
  {
    $options =
    [
      'use_taxes' => $_POST['use_taxes'],
      'taxes'     => (float) $_POST['taxes'],
      'coin'      => $_POST['coin']
    ];

    foreach ($options as $k => $option) {
      try {
        if(!$id = optionModel::save($k, $option)) {
          json_output(json_build(400, null, sprintf('Hubo error al guardar la opción %s', $k)));
        }
    
        
      } catch (Exception $e) {
        json_output(json_build(400, null, $e->getMessage()));
      }
    }

    // se guardó con éxito
    json_output(json_build(200, null, 'Opciones actualizadas con éxito'));
  }
}