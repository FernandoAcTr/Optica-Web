<?php

   include_once '../../admin/class/venta.class.php';
   include_once '../../admin/class/cliente.class.php';
   include_once '../../admin/class/database.class.php';

   $action = isset($_GET['action']) ? $_GET['action'] : null;

  switch ($action) {
    case 'salesPerPlace':
      salesPerPlace();
      break;
    case 'salesPerMonth':
      salesPerMonth();
      break;
    case 'createVenta':
    createVenta();
      break;
  }

  function createVenta()
  {
      $data = json_decode($_POST['data'], true);

      $id_cliente = isset($data['id_cliente']) ? $data['id_cliente'] : null;
      $email = isset($data['email']) ? $data['email'] : '';
      $nombre = isset($data['nombre']) ? $data['nombre'] : '';
      $apellido = isset($data['apellido']) ? $data['apellido'] : '';
      $calle = isset($data['calle']) ? $data['calle'] : '';
      $colonia = isset($data['colonia']) ? $data['colonia'] : '';
      $ciudad = isset($data['ciudad']) ? $data['ciudad'] : '';
      $cod_postal = isset($data['cod_postal']) ? $data['cod_postal'] : '';

      $cliente = new Cliente($id_cliente, $email, $nombre, $apellido, $calle, $colonia, $ciudad, $cod_postal);

      $id_venta = $data['id_venta'];
      $fecha = isset($data['fecha']) ? $data['fecha'] : null;
      $status = $data['status'];
      $items = isset($data['items']) ? $data['items'] : [];

      $venta = new Venta($id_venta, $fecha, $cliente, $status, $items);

      if ($venta->createVentaPaypal()) {
          $resp = [
            'ok' => true,
            'message' => 'La venta se ha registrado con exito',
          ];
      } else {
          $resp = [
            'ok' => false,
            'message' => 'Ha habido un error al registrar la venta',
          ];
      }

      echo json_encode($resp);
  }

  function salesPerPlace()
  {
      $database = new Database();
      $database->connect();

      //contar las ventas realizadas en la pagina
      $sql = "SELECT COUNT(*) as ventas from venta where tipo like 'Paypal' and status like 'COMPLETED'";
      $ventasPaypal = $database->execQuery($sql, null)[0];
      $ventasPaypal = $ventasPaypal['ventas'];

      //contar las ventas realizadas en la tienda
      $sql = "SELECT COUNT(*) as ventas from venta where tipo like 'Manual' and status like 'COMPLETED'";
      $ventasTienda = $database->execQuery($sql, null)[0];
      $ventasTienda = $ventasTienda['ventas'];

      $resp = [
        'ok' => true,
        'sales_store' => $ventasTienda,
        'sales_page' => $ventasPaypal,
      ];

      $database->close();

      echo json_encode($resp);
  }

  function salesPerMonth()
  {
      $database = new Database();
      $database->connect();

      //contar las ventas realizadas en la pagina
      $sql = 'SELECT
        month(fecha) AS mes,
        COUNT(*) AS ventas
        FROM venta
        WHERE YEAR(fecha) = 2020
        GROUP BY month(fecha)
        ORDER BY month(fecha)';
      $ventasPorMes = $database->execQuery($sql, null);

      $resp = [
        'ok' => true,
        'sales' => $ventasPorMes,
      ];

      $database->close();

      echo json_encode($resp);
  }
