<?php

   include_once '../../admin/class/venta.class.php';
   include_once '../../admin/class/cliente.class.php';

   $action = isset($_GET['action']) ? $_GET['action'] : null;

  switch ($action) {
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

      if ($venta->createVenta()) {
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
