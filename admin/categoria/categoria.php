<?php

include_once '../class/categoria.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$categoria = new Categoria();

switch ($action) {
  case 'new':
    $data = [
      'categoria' => $_POST['categoria'],
    ];
    $categoria->setCategoria($data['categoria']);
    $categoria->createCategoria();
    header('Location: categoria.php');
    break;

  case 'modify':
    $data = [
      'categoria' => $_POST['categoria'],
      'id_categoria' => $_POST['id_categoria'],
    ];
    $categoria->setIdCategoria($data['id_categoria']);
    $categoria->setCategoria($data['categoria']);
    $categoria->modifyCategoria();
    header('Location: categoria.php');
    break;

  case 'form':
    $id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : '';

    $data = [
      'categoria' => '',
    ];
    if (is_numeric($id_categoria)) {
        $categoria->setIdCategoria($id_categoria);
        $data = $categoria->readOneCategoria();
        $titulo = 'Modificar Categoria';
        $script = 'categoria.php?action=modify';
    } else {
        //valores dinamicos para el formulario
        $titulo = 'Nueva Categoria';
        $script = 'categoria.php?action=new';
    }

    include 'views/form.php';
    break;

  case 'delete':
    $id_categoria = $_GET['id_categoria'];
    $categoria->setIdCategoria($id_categoria);
    $categoria->deleteCategoria();
    header('Location: categoria.php');

    break;

  default:
    $data = $categoria->fetchAll();
    include 'views/table.php';
    break;
}
