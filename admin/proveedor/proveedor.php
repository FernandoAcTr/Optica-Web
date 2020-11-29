<?php

$action = null;
if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

switch ($action) {
  case 'new':
    break;

  case 'modify':
    break;

  case 'delete':
    break;

  default:
    include 'views/index.php';
    break;
}
