<?php

include_once 'carrito.php';

if (isset($_GET['action'])) {
    $action = $_GET['action'];

    $carrito = new Carrito();

    switch ($action) {
      case 'show':
        show($carrito);
        break;

      case 'add':
        add($carrito);
        break;

      case 'remove':
        remove($carrito);
          break;
    }
} else {
    echo json_encode([
      'ok' => false,
      'error' => 'La accion es obligatoria',
    ]);
}

function add($carrito)
{
    if (isset($_GET['id'])) {
        $res = $carrito->add($_GET['id']);
        echo json_encode($res);
    } else {
        echo json_encode([
          'ok' => false,
          'error' => 'El id del producto es obligatorio',
        ]);
    }
}

function remove($carrito)
{
    if (isset($_GET['id'])) {
        $res = $carrito->remove($_GET['id']);
        echo json_encode($res);
    } else {
        echo json_encode([
            'ok' => false,
            'error' => 'El id del producto es obligatorio',
          ]);
    }
}
function show($carrito)
{
    //cargar el arreglo en la sesion que tenemos activa
    //consultar la base de datos para actualizar los valores de los productos

    $itemsCarrito = $carrito->load();
    $fullItems = [];
    $total = 0;
    $totalItems = 0;

    // print_r();

    //De cada item del carrito obtenemos su informacion y le adicionamos el subtotal y la cantidad.
    foreach ($itemsCarrito  as $item) {
        $response = file_get_contents('http://localhost/PrograWeb/Optica/api/productos/api-productos.php?action=oneProduct&id_producto='.$item['id']);
        $itemProducto = json_decode($response, true)['product'];
        $itemProducto['cantidad'] = $item['cantidad'];
        $itemProducto['subtotal'] = $itemProducto['cantidad'] * $itemProducto['precio'];

        $total += $itemProducto['subtotal'];
        $totalItems += $itemProducto['cantidad'];

        $fullItems[] = $itemProducto;
    }

    $resp = [
        'info' => [
          'count' => $totalItems,
          'total' => $total,
        ],
        'items' => $fullItems,
      ];

    echo json_encode($resp);
}
