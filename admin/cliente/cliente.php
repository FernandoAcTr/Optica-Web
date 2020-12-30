<?php

include_once '../class/cliente.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$cliente = new Cliente(null, null, null, null, null, null, null, null);

switch ($action) {
  case 'new':
    $sistema->verificarPermiso('Escribir clientes');
    $cliente->setIdCliente($_POST['id_cliente']);
    $cliente->setEmail($_POST['email']);
    $cliente->setNombre($_POST['nombre']);
    $cliente->setApellido($_POST['apellido']);
    $cliente->setCalle($_POST['calle']);
    $cliente->setColonia($_POST['colonia']);
    $cliente->setCiudad($_POST['ciudad']);
    $cliente->setCodPostal($_POST['cod_postal']);
    $cliente->createClienteManual();
    header('Location: cliente.php');
  break;
  case 'modify':
    $sistema->verificarPermiso('Escribir clientes');
    $cliente->setIdCliente($_POST['id_cliente']);
    $cliente->setEmail($_POST['email']);
    $cliente->setNombre($_POST['nombre']);
    $cliente->setApellido($_POST['apellido']);
    $cliente->setCalle($_POST['calle']);
    $cliente->setColonia($_POST['colonia']);
    $cliente->setCiudad($_POST['ciudad']);
    $cliente->setCodPostal($_POST['cod_postal']);
    $cliente->modifyCliente();
    header('Location: cliente.php');
  break;

  case 'delete':
    $sistema->verificarPermiso('Eliminar clientes');
    $id_cliente = $_GET['id_cliente'];
    $cliente->setIdCliente($id_cliente);
    $cliente->deleteCliente();
    header('Location: cliente.php');

    break;

  case 'form':
    $sistema->verificarPermiso('Escribir clientes');
    $id_cliente = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : '';

    $data = [
      'id_cliente' => $cliente->generateId(),
      'email' => '',
      'nombre' => '',
      'apellido' => '',
      'calle' => '',
      'colonia' => '',
      'ciudad' => '',
      'cod_postal' => '',
    ];

    if (!empty($id_cliente)) {
        $cliente->setIdCliente($id_cliente);
        $data = $cliente->readOneCliente();
        $titulo = 'Modificar Cliente';
        $script = 'cliente.php?action=modify';
    } else {
        //valores dinamicos para el formulario
        $titulo = 'Nuevo Cliente';
        $script = 'cliente.php?action=new';
    }

    include 'views/form.php';
    break;

  default:
    $sistema->verificarPermiso('Leer clientes');
    $data = $cliente->fetchAll();
    include 'views/table.php';
    break;
}
