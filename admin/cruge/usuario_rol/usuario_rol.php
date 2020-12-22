<?php

   include '../../class/usuario_rol.class.php';
   include '../../class/usuario.class.php';
   include '../../class/rol.class.php';
   $sistema->verificarPermiso('Cruge');

   $action = isset($_GET['action']) ? $_GET['action'] : null;

   $usuarioRol = new UsuarioRol();
   $usuario = new Usuario();
   $rol = new Rol();

   switch ($action) {
     case 'new':
      $datos = [
       'id_usuario' => $_POST['id_usuario'],
       'id_rol' => $_POST['id_rol'],
      ];
      $usuarioRol->setIdUsuario($datos['id_usuario']);
      $usuarioRol->setIdRol($datos['id_rol']);
      $usuarioRol->asignarRol();
      header('Location: usuario_rol.php');
     break;

     case 'form':
      $data = [
        'usuarios' => $usuario->fetchAll(),
        'roles' => $rol->fetchAll(),
       ];

      //  print_r($data);
      //Valores dinamicos para el formulario
      $script = 'usuario_rol.php?action=new';
      $title = 'Asignar un Rol';
      $boton = 'Asignar';
      include 'views/form.php';

     break;

     case 'delete':
      $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : null;
      $id_rol = isset($_GET['id_rol']) ? $_GET['id_rol'] : null;
      if (is_numeric($id_usuario) && is_numeric($id_rol)) {
         
          $usuarioRol->setIdUsuario($id_usuario);
          $usuarioRol->setIdRol($id_rol);
          $usuarioRol->quitarRol();
      }
      header('Location: usuario_rol.php');
     break;

     case 'show':
     default:
      $title = 'Asignacion de Roles';
      $data = $usuarioRol->fetchAll();
      include 'views/table.php';
     break;
   }
