<?php

   include '../../class/rol_permiso.class.php';
   include '../../class/permiso.class.php';
   include '../../class/rol.class.php';
   $sistema->verificarPermiso('Cruge');

   $action = isset($_GET['action']) ? $_GET['action'] : null;

   $rolPermiso = new RolPermiso();
   $rol = new Rol();
   $permiso = new Permiso();

   switch ($action) {
     case 'new':
      $datos = [
       'id_permiso' => $_POST['id_permiso'],
       'id_rol' => $_POST['id_rol'],
      ];
      $rolPermiso->setIdRol($datos['id_rol']);
      $rolPermiso->setIdPermiso($datos['id_permiso']);
      $rolPermiso->asignarPermiso();
      header('Location: rol_permiso.php');
     break;

     case 'form':
      $data = [
        'permisos' => $permiso->fetchAll(),
        'roles' => $rol->fetchAll(),
       ];

      //Valores dinamicos para el formulario
      $script = 'rol_permiso.php?action=new';
      $title = 'Asignar un Permiso';
      $boton = 'Asignar';
      include 'views/form.php';

     break;

     case 'delete':
      $id_permiso = isset($_GET['id_permiso']) ? $_GET['id_permiso'] : null;
      $id_rol = isset($_GET['id_rol']) ? $_GET['id_rol'] : null;
      if (is_numeric($id_permiso) && is_numeric($id_rol)) {
          $rolPermiso->setIdPermiso($id_permiso);
          $rolPermiso->setIdRol($id_rol);
          $rolPermiso->quitarPermiso();
      }
      header('Location: rol_permiso.php');
     break;

     case 'show':
     default:
      $title = 'Asignacion de Permisos';
      $data = $rolPermiso->fetchAll();
      include 'views/table.php';
     break;
   }
