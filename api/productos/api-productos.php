<?php

include '../../admin/class/producto.class.php';

$action = isset($_GET['action']) ? $_GET['action'] : null;
$producto = new Producto();

switch ($action) {
  case 'categories':
    categories($producto);
    break;

  case 'oneProduct':
    oneProduct($producto);
    break;

  case 'face':
    getProductsPerFace($producto);
    break;

  default:
    showAll($producto);
    break;
}

function categories($producto)
{
    $categories = $producto->getCategories();
    $resp = [
      'ok' => true,
      'categories' => $categories,
    ];
    echo json_encode($resp);
}

function showAll($producto)
{
    //obtener la pagina
    $page = isset($_GET['page']) ? $_GET['page'] : null;
    //obtener si hay un filtro
    $filter = isset($_GET['filter']) && is_numeric($_GET['filter']) ? $_GET['filter'] : null;
    //Obtener si hay una ordenacion
    $orderBy = isset($_GET['orderBy']) && is_numeric($_GET['orderBy']) ? $_GET['orderBy'] : null;

    $productos = $producto->showPaginate($page, $orderBy, $filter);
    $resp = [
      'ok' => true,
      'products' => $productos,
    ];
    echo json_encode($resp);
}

function oneProduct($producto)
{
    $id_producto = $_GET['id_producto'];
    $producto->setIdProducto($id_producto);
    $product = $producto->readOneProducto();
    $resp = [
      'ok' => true,
      'product' => $product,
    ];

    echo json_encode($resp);
}

function getProductsPerFace($producto)
{
    $face = $_GET['face'];
    $products = $producto->getProductsPerFace($face);
    $resp = [
      'ok' => true,
      'products' => $products,
    ];

    echo json_encode($resp);
}
