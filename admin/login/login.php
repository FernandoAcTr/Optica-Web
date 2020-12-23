<?php

include_once '../class/database.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

switch ($action) {
   case 'login':

      $correo = $_POST['correo'];
      $contrasena = $_POST['contrasena'];

      if ($sistema->validar($correo, $contrasena)) {
          header('Location: '.HOST_BASE.'/admin/dashboard/dashboard.php');
      } else {
          $sistema->logout();
          header('Location: login.php');
      }
    break;

    case 'logout':
      $sistema->logout();
      header('Location: login.php');

      break;

    case 'recuperar':
      include 'views/recuperar.php';
    break;

    case 'correoRecueperacion':
      $correo = $_POST['correo'];
      $existe = $sistema->verificarCorreo($correo);
      if (!$existe) {
          die('El correo electronico no existe');
      } else {
          $sistema->enviarCorreoRecuperacion($correo);
      }
    break;

    case 'reestablecer':
      $correo = $_GET['correo'];
      $token = $_GET['token'];

      if ($sistema->verificarToken($correo, $token)) {
          include 'views/reestablecer.php';
      } else {
          die('Este vínculo ya ha expirado. Solicita una nueva recuperación de contraseña');
      }
      break;

      case 'cambiarContra':
        $correo = $_POST['correo'];
        $token = $_POST['token'];
        $nuevaContra = $_POST['contrasena'];
        $sistema->cambiarContrasena($correo, $nuevaContra);
        $vinculo = HOST_BASE.'/admin/login/login.php';
        $mensaje = "<p>La contarseña ha sido cambiada. Presiona <a href='$vinculo'>aqui</a> para iniciar sesión</p>";
        print_r($mensaje);
      break;

   default:
      $sistema->verificarLogin();
      include 'views/index.php';
      break;
}
