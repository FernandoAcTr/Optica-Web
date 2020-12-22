<?php

   include '../../class/usuario.class.php';
   $sistema->verificarPermiso('Cruge');

   $action = isset($_GET['action']) ? $_GET['action'] : null;

   $usuario = new Usuario();

   switch ($action) {
     case 'new':
      $usuario->setCorreo($_POST['correo']);
      $usuario->setContrasena($_POST['contrasena']);
      $usuario->setNombre($_POST['nombre']);
      $usuario->setFoto($_FILES['foto']);
      $usuario->createUsuario();
      header('Location: usuario.php');
     break;

     case 'modify':
      $datos = [
        'correo' => isset($_POST['correo']) ? $_POST['correo'] : '',
        'nombre' => isset($_POST['nombre']) ? $_POST['nombre'] : '',
        'contrasena' => isset($_POST['contrasena']) ? $_POST['contrasena'] : '',
        'id_usuario' => isset($_POST['id_usuario']) ? $_POST['id_usuario'] : '',
        'foto' => isset($_FILES['foto']) ? $_FILES['foto'] : null,
      ];
       $usuario->setCorreo($datos['correo']);
       $usuario->setNombre($datos['nombre']);
       $usuario->setContrasena($datos['contrasena']);
       $usuario->setIdUsuario($datos['id_usuario']);
       $usuario->setFoto($datos['foto']);
       $usuario->modifyUsuario();
      header('Location: usuario.php');

     break;

     case 'form':
      $data = [
        'correo' => '',
        'nombre' => '',
       ];
      $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
      if (is_numeric($id_usuario)) {
          $usuario->setIdUsuario($id_usuario);
          $data = $usuario->readOneUsuario();

          //Valores dinamicos para el formulario
          $script = 'usuario.php?action=modify';
          $title = 'Modificar Usuario';
          $boton = 'Modificar';

          include 'views/form.php';
      } else {
          $script = 'usuario.php?action=new';
          $title = 'Nuevo Usuario';
          $boton = 'Guardar';

          include 'views/form.php';
      }
     break;

     case 'delete':
      $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
      if (is_numeric($id_usuario)) {
          $usuario->setIdUsuario($id_usuario);
          $usuario->deleteUsuario();
      }
      header('Location: usuario.php');
     break;

     case 'show':
     default:
      $title = 'Usuarios';
      $data = $usuario->fetchAll();
      include 'views/table.php';
     break;
   }
