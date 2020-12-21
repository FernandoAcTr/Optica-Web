<?php

include_once '../class/inventario.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$inventario = new Inventario();

switch ($action) {
  default:
    $data = $inventario->fetchAll();
    include 'views/table.php';
    break;
}
