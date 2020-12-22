<?php

   include '../../class/rol.class.php';
   $sistema->verificarPermiso('Cruge');

   $action = isset($_GET['action']) ? $_GET['action'] : null;

   $rol = new Rol();
   
   switch ($action) {
     case 'new':
      $datos = [
       'rol' => isset($_POST['rol']) ? $_POST['rol'] : '',
      ];
      $rol->setRol($datos['rol']);
      $rol->createRol();
      header('Location: rol.php');
     break;

     case 'modify':
      $datos = [
        'rol' => isset($_POST['rol']) ? $_POST['rol'] : '',
        'id_rol' => isset($_POST['id_rol']) ? $_POST['id_rol'] : '',
      ];
       $rol->setRol($datos['rol']);
       $rol->setIdRol($datos['id_rol']);
       $rol->modifyRol();
      header('Location: rol.php');

     break;

     case 'form':
      $data = [
        'rol' => '',
       ];
      $id_rol = isset($_GET['id_rol']) ? $_GET['id_rol'] : null;
      if (is_numeric($id_rol)) {
          $rol->setIdRol($id_rol);
          $data = $rol->readOneRol();

          //Valores dinamicos para el formulario
          $script = 'rol.php?action=modify';
          $title = 'Modificar Rol';
          $boton = 'Modificar';

          include 'views/form.php';
      } else {
          $script = 'rol.php?action=new';
          $title = 'Nuevo Rol';
          $boton = 'Guardar';

          include 'views/form.php';
      }
     break;

     case 'delete':
      $id_rol = isset($_GET['id_rol']) ? $_GET['id_rol'] : null;
      if (is_numeric($id_rol)) {
          $rol->setIdRol($id_rol);
          $rol->deleteRol();
      }
      header('Location: rol.php');
     break;

     case 'show':
     default:
      $title = 'Roles';
      $data = $rol->fetchAll();
      include 'views/table.php';
     break;
   }
