<?php

include_once '../class/marca.class.php';
$sistema->verificarPermiso('Catalogos');

$action = isset($_GET['action']) ? $_GET['action'] : null;

$marca = new Marca();

switch ($action) {
  case 'new':
    $data = [
      'marca' => $_POST['marca'],
    ];
    $marca->setMarca($data['marca']);
    $marca->createMarca();
    header('Location: marca.php');
    break;

  case 'modify':
    $data = [
      'marca' => $_POST['marca'],
      'id_marca' => $_POST['id_marca'],
    ];
    $marca->setIdMarca($data['id_marca']);
    $marca->setMarca($data['marca']);
    $marca->modifyMarca();
    header('Location: marca.php');
    break;

  case 'form':
    $id_marca = isset($_GET['id_marca']) ? $_GET['id_marca'] : '';

    $data = [
      'marca' => '',
    ];
    if (is_numeric($id_marca)) {
        $marca->setIdMarca($id_marca);
        $data = $marca->readOneMarca();
        $titulo = 'Modificar Marca';
        $script = 'marca.php?action=modify';
    } else {
        //valores dinamicos para el formulario
        $titulo = 'Nueva Marca';
        $script = 'marca.php?action=new';
    }

    include 'views/form.php';
    break;

  case 'delete':
    $id_marca = $_GET['id_marca'];
    $marca->setIdMarca($id_marca);
    $marca->deleteMarca();
    header('Location: marca.php');

    break;

  default:
    $data = $marca->fetchAll();
    include 'views/table.php';
    break;
}
