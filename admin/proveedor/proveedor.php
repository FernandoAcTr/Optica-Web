<?php

include_once '../class/proveedor.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$proveedor = new Proveedor();

switch ($action) {
  case 'new':
    $data = [
      'razon_social' => isset($_POST['razon_social']) ? $_POST['razon_social'] : '',
      'rfc' => isset($_POST['rfc']) ? $_POST['rfc'] : '',
      'domicilio' => isset($_POST['domicilio']) ? $_POST['domicilio'] : '',
      'telefono' => isset($_POST['telefono']) ? $_POST['telefono'] : '',
    ];
    $proveedor->setRazonSocial($data['razon_social']);
    $proveedor->setRfc($data['rfc']);
    $proveedor->setDomicilio($data['domicilio']);
    $proveedor->setTelefono($data['telefono']);
    $proveedor->createProveedor();
    header('Location: proveedor.php');
    break;

  case 'modify':
    $data = [
      'razon_social' => isset($_POST['razon_social']) ? $_POST['razon_social'] : '',
      'rfc' => isset($_POST['rfc']) ? $_POST['rfc'] : '',
      'domicilio' => isset($_POST['domicilio']) ? $_POST['domicilio'] : '',
      'telefono' => isset($_POST['telefono']) ? $_POST['telefono'] : '',
      'id_proveedor' => isset($_POST['id_proveedor']) ? $_POST['id_proveedor'] : '',
    ];
    $proveedor->setRazonSocial($data['razon_social']);
    $proveedor->setRfc($data['rfc']);
    $proveedor->setDomicilio($data['domicilio']);
    $proveedor->setTelefono($data['telefono']);
    $proveedor->setIdProveedor($data['id_proveedor']);
    $proveedor->modifyProveedor();
    header('Location: proveedor.php');
    break;

  case 'form':
    $id_proveedor = isset($_GET['id_proveedor']) ? $_GET['id_proveedor'] : '';

    $data = [
      'razon_social' => '',
      'rfc' => '',
      'domicilio' => '',
      'telefono' => '',
    ];
    if (is_numeric($id_proveedor)) {
        $proveedor->setIdProveedor($id_proveedor);
        $data = $proveedor->readOneProveedor();
        $titulo = 'Modificar Proveedor';
        $script = 'proveedor.php?action=modify';
    } else {
        //valores dinamicos para el formulario
        $titulo = 'Nuevo Proveedor';
        $script = 'proveedor.php?action=new';
    }

    include 'views/form.php';
    break;

  case 'delete':
    $id_proveedor = $_GET['id_proveedor'];
    $proveedor->setIdProveedor($id_proveedor);
    $proveedor->deleteProveedor();
    header('Location: proveedor.php');

    break;

  default:
    $data = $proveedor->fetchAll();
    include 'views/table.php';
    break;
}
