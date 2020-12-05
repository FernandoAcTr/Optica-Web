<?php

include_once '../class/proveedor.class.php';

$action = null;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

$proveedor = new Proveedor();

switch ($action) {
  case 'new':
    break;

  case 'modify':
    break;

  case 'delete':
    break;

  default:
    $data = $proveedor->fetchAll();
    include 'views/index.php';
    break;
}
