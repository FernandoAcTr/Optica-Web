<?php

include_once '../class/forma.class.php';

$action = null;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

$forma = new Forma();

switch ($action) {
  case 'new':
    $data = [
      'forma' => $_POST['forma'],
    ];
    $forma->setForma($data['forma']);
    $forma->createForma();
    header('Location: forma.php');
    break;

  case 'modify':
    $data = [
      'forma' => $_POST['forma'],
      'id_forma' => $_POST['id_forma'],
    ];
    $forma->setIdForma($data['id_forma']);
    $forma->setForma($data['forma']);
    $forma->modifyForma();
    header('Location: forma.php');
    break;

  case 'form':
    $id_forma = isset($_GET['id_forma']) ? $_GET['id_forma'] : '';

    $data = [
      'forma' => '',
    ];
    if (is_numeric($id_forma)) {
        $forma->setIdForma($id_forma);
        $data = $forma->readOneForma();
        $titulo = 'Modificar Forma';
        $script = 'forma.php?action=modify';
    } else {
        //valores dinamicos para el formulario
        $titulo = 'Nueva Forma';
        $script = 'forma.php?action=new';
    }

    include 'views/form.php';
    break;

  case 'delete':
    $id_forma = $_GET['id_forma'];
    $forma->setIdForma($id_forma);
    $forma->deleteForma();
    header('Location: forma.php');

    break;

  default:
    $data = $forma->fetchAll();
    include 'views/table.php';
    break;
}
