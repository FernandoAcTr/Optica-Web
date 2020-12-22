<?php

include_once '../class/compra.class.php';
include_once '../class/proveedor.class.php';
include_once '../class/producto.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;

$proveedor = new Proveedor();
$producto = new Producto();
$compra = new Compra();

switch ($action) {
  case 'new':
    $sistema->verificarPermiso('Escribir compras');
    $compra->setFolio($_POST['folio']);
    $compra->setFecha($_POST['fecha']);
    $compra->setIdProveedor($_POST['id_proveedor']);
    $compra->setProductos($_POST['productos']);
    $compra->createCompra();
    header('Location: compra.php');
    break;

  case 'modify':
    $sistema->verificarPermiso('Escribir compras');
    $compra->setFolio($_POST['folio']);
    $compra->setFecha($_POST['fecha']);
    $compra->setIdProveedor($_POST['id_proveedor']);
    $compra->setProductos($_POST['productos']);
    $compra->setIdCompra($_POST['id_compra']);
    $compra->modifyCompra();
    header('Location: compra.php');
    break;

  case 'form':
    $sistema->verificarPermiso('Escribir compras');

    $id_compra = isset($_GET['id_compra']) ? $_GET['id_compra'] : '';

    $data = [
      'folio' => $compra->generateFolio(),
      'fecha' => '',
      'id_proveedor' => '',
    ];

    if (is_numeric($id_compra)) {
        $compra->setIdCompra($id_compra);
        $data = $compra->readOneCompra();
        $data['comprados'] = $compra->readProductosCompra();
        $titulo = 'Modificar Compra';
        $script = 'compra.php?action=modify';
    } else {
        $titulo = 'Registrar Compra';
        $script = 'compra.php?action=new';
    }

    $data['proveedores'] = $proveedor->fetchAll();
    $data['productos'] = $producto->fetchAll();

    include 'views/form.php';

    break;

  case 'delete':
    $sistema->verificarPermiso('Eliminar compras');

    $id_compra = isset($_GET['id_compra']) ? $_GET['id_compra'] : '';
    $compra->setIdCompra($id_compra);
    $compra->deleteCompra();
    header('Location: compra.php');
    break;

  default:
    $sistema->verificarPermiso('Leer compras');
    $data = $compra->fetchAll();
    include 'views/table.php';
    break;
}
