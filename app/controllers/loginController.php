<?php 

class loginController extends Controller {
  function __construct()
  {
    if (Auth::validate()) {
      Flasher::new('Ya hay una sesión abierta.');
      Redirect::to('home/flash');
    }
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

    // Loggear al usuario
    Auth::login($user[0]['id'], $user);
    Redirect::to('home/flash');
  }

  function recovery_password($email=null, $token=null){

    if(!isset($email) && !isset($token) ){
      Flasher::new('Datos insuficientes.', 'danger');
      Redirect::to('login');
    }

    $data =
    [
      'title'   => 'Recuperar contraseña',
      'email' => $email,
      'token' => $token,
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