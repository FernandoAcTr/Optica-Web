<?php

include_once '../class/tipo_armazon.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$tipo_armazon = new TipoArmazon();

switch ($action) {
  case 'new':
    $data = [
      'tipo_armazon' => $_POST['tipo_armazon'],
    ];
    $tipo_armazon->setTipoArmazon($data['tipo_armazon']);
    $tipo_armazon->createTipoArmazon();
    header('Location: tipo_armazon.php');
    break;

  case 'modify':
    $data = [
      'tipo_armazon' => $_POST['tipo_armazon'],
      'id_tipo_armazon' => $_POST['id_tipo_armazon'],
    ];
    $tipo_armazon->setIdTipoArmazon($data['id_tipo_armazon']);
    $tipo_armazon->setTipoArmazon($data['tipo_armazon']);
    $tipo_armazon->modifyTipoArmazon();
    header('Location: tipo_armazon.php');
    break;

  case 'form':
    $id_tipo_armazon = isset($_GET['id_tipo_armazon']) ? $_GET['id_tipo_armazon'] : '';

    $data = [
      'tipo_armazon' => '',
    ];
    if (is_numeric($id_tipo_armazon)) {
        $tipo_armazon->setIdTipoArmazon($id_tipo_armazon);
        $data = $tipo_armazon->readOneTipoArmazon();
        $titulo = 'Modificar Tipo de Armazon';
        $script = 'tipo_armazon.php?action=modify';
    } else {
        //valores dinamicos para el formulario
        $titulo = 'Nuevo Tipo de Armazon';
        $script = 'tipo_armazon.php?action=new';
    }

    include 'views/form.php';
    break;

  case 'delete':
    $id_tipo_armazon = $_GET['id_tipo_armazon'];
    $tipo_armazon->setIdTipoArmazon($id_tipo_armazon);
    $tipo_armazon->deleteTipoArmazon();
    header('Location: tipo_armazon.php');

    break;

  default:
    $data = $tipo_armazon->fetchAll();
    include 'views/table.php';
    break;
}
