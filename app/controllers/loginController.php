<?php 

class loginController extends Controller {
  function __construct()
  {
    if (Auth::validate()) {
      Flasher::new('Ya hay una sesión abierta.');
      Redirect::to('home/flash');
    }
    register_scripts([JS.'functions_login.js'], 'Archivo con las funciones de la página login');
  }

  function index()
  {
    $data =
    [
      'title'   => 'Ingresar a tu cuenta'
    ];

    View::render('index', $data);
  }

  function post_login()
  {
    if (!Csrf::validate($_POST['csrf']) || !check_posted_data(['user','csrf','password'], $_POST)) {
      Flasher::new('Acceso no autorizado.', 'danger');
      Redirect::back();
    }

    // Data pasada del formulario
    $usuario  = strtolower(clean($_POST['user']));
    $password = clean($_POST['password']);

    // Información del usuario loggeado, simplemente se puede reemplazar aquí con un query a la base de datos
    // para cargar la información del usuario si es existente

    $user = usersModel::userLogin($usuario);

    if ($usuario !== $user['email'] || !password_verify($password.AUTH_SALT, $user['password'])) {
      Flasher::new('Las credenciales no son correctas.', 'danger');
      Redirect::back();
    }

    if ($user['status'] == 'inactive') {
      Flasher::new('El usuario se encuentra inactivo, contactar al administrador.', 'danger');
      Redirect::back();
    }

    //Obtine los inicios de session anteriores
    $last_login = Model::list('sessions', ['id_user' => $user['id']]);
    set_session('sessions', $last_login);

    //Guarda el Login en bitacora
    $session = [
      'id_user' => $user['id'],
      'ip_address' => $_SERVER['REMOTE_ADDR'],
      'os_user' => get_user_os(),
      'browser_user' => get_user_browser(),
      'date_login' => now()
    ];
    Model::add('sessions', $session);

    // Loggear al usuario
    Auth::login($user[0]['id'], $user);
    if (empty($last_login)) {
      Redirect::to('users/profile');
    }else{
      Redirect::to('home');
    }
    
  }

  function recovery_password($email=null, $token=null){

    if($email === null || $token === null ){
      Flasher::new('Datos insuficientes.', 'danger');
      Redirect::to('login');
    }

    $data =
    [
      'title'   => 'Recuperar contraseña',
      'email' => clean(strtolower($email)),
      'token' => clean($token),
    ];

    View::render('recovery', $data);
  }

  function forgot_password(){
    $data =
    [
      'title'   => 'Olvide mi contraseña',
    ];

    View::render('forgot', $data);
  }

}