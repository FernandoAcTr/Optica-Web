<?php

include_once '../class/venta.class.php';
include_once '../class/cliente.class.php';
include_once '../class/producto.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$venta = new Venta(null, null, null, null, null);
$cliente = new Cliente(null, null, null, null, null, null, null, null);
$producto = new Producto();

switch ($action) {
  case 'new':
    $sistema->verificarPermiso('Escribir ventas');
    $venta->setIdVenta($_POST['id_venta']);
    $venta->setFecha($_POST['fecha']);
    $venta->setCliente($_POST['id_cliente']);
    $venta->setStatus('COMPLETED');
    $venta->setItems($_POST['productos']);
    $venta->createVentaManual();
    header('Location: venta.php?action=form');
    break;

  case 'modify':
    $sistema->verificarPermiso('Escribir ventas');
    $venta->setIdVenta($_POST['id_venta']);
    $venta->setFecha($_POST['fecha']);
    $venta->setCliente($_POST['id_cliente']);
    $venta->setStatus('COMPLETED');
    $venta->setItems($_POST['productos']);
    $venta->modifyVenta();
    header('Location: venta.php');
    break;

  case 'form':
    $sistema->verificarPermiso('Escribir ventas');

    $id_venta = isset($_GET['id_venta']) ? $_GET['id_venta'] : '';

    $data = [
      'id_venta' => $venta->generateId(),
      'fecha' => '',
      'id_cliente' => '',
      'status' => '',
    ];

    if (!empty($id_venta)) {
        $venta->setIdVenta($id_venta);
        $data = $venta->readOneVenta();
        $data['vendidos'] = $venta->readProductosVenta();
        $titulo = 'Modificar Venta';
        $script = 'venta.php?action=modify';
    } else {
        $titulo = 'Registrar Venta';
        $script = 'venta.php?action=new';
    }

    $data['clientes'] = $cliente->fetchAll();
    $data['productos'] = $producto->fetchAll();

    include 'views/form.php';

    break;

  case 'delete':
    $sistema->verificarPermiso('Eliminar ventas');

    $id_venta = isset($_GET['id_venta']) ? $_GET['id_venta'] : '';
    $venta->setIdVenta($id_venta);
    $venta->deleteVenta();
    header('Location: venta.php');
    break;

  default:
    $sistema->verificarPermiso('Leer ventas');
    $data = $venta->fetchAll();
    include 'views/table.php';
    break;
}
