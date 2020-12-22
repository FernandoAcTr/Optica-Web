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
   default:
      include 'views/index.php';
      break;
}
