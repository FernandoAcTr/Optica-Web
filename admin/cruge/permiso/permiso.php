<?php

   include '../../class/permiso.class.php';
   $sistema->verificarPermiso('Cruge');

   $action = isset($_GET['action']) ? $_GET['action'] : null;

   $permiso = new Permiso();

   switch ($action) {
     case 'new':
      $datos = [
       'permiso' => isset($_POST['permiso']) ? $_POST['permiso'] : '',
      ];
      $permiso->setPermiso($datos['permiso']);
      $permiso->createPermiso();
      header('Location: permiso.php');
     break;

     case 'modify':
      $datos = [
        'permiso' => isset($_POST['permiso']) ? $_POST['permiso'] : '',
        'id_permiso' => isset($_POST['id_permiso']) ? $_POST['id_permiso'] : '',
      ];
       $permiso->setPermiso($datos['permiso']);
       $permiso->setIdPermiso($datos['id_permiso']);
       $permiso->modifyPermiso();
      header('Location: permiso.php');

     break;

     case 'form':
      $data = [
        'permiso' => '',
       ];
      $id_permiso = isset($_GET['id_permiso']) ? $_GET['id_permiso'] : null;
      if (is_numeric($id_permiso)) {
          $permiso->setIdPermiso($id_permiso);
          $data = $permiso->readOnePermiso();

          //Valores dinamicos para el formulario
          $script = 'permiso.php?action=modify';
          $title = 'Modificar Permiso';
          $boton = 'Modificar';

          include 'views/form.php';
      } else {
          $script = 'permiso.php?action=new';
          $title = 'Nuevo Permiso';
          $boton = 'Guardar';

          include 'views/form.php';
      }
     break;

     case 'delete':
      $id_permiso = isset($_GET['id_permiso']) ? $_GET['id_permiso'] : null;
      if (is_numeric($id_permiso)) {
          $permiso->setIdPermiso($id_permiso);
          $permiso->deletePermiso();
      }
      header('Location: permiso.php');
     break;

     case 'show':
     default:
      $title = 'Permisos';
      $data = $permiso->fetchAll();
      include 'views/table.php';
     break;
   }
