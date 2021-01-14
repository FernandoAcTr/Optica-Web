<?php
/**
 * Esta clase no tiene utilidad en el proyecto. Solamente es parte del proeycto final de la asignatura.
 * Servicio web para los productos.
 */
include '../../admin/class/producto.class.php';

$producto = new Producto();
header('Content-Type: application/json');

switch ($_SERVER['REQUEST_METHOD']) {
  case 'GET':
    $id_producto = isset($_GET['id_producto']) ? $_GET['id_producto'] : null;

    if ($id_producto) {
        $producto->setIdProducto($id_producto);
        $productos = $producto->readOneProducto();

        $resp = [
          'ok' => true,
          'total' => $productos ? 1 : 0,
          'product' => $productos,
         ];
    } else {
        $productos = $producto->fetchAll();
        $numProducts = $producto->getNumProducts('SELECT * from producto');
        $resp = [
         'ok' => true,
         'total' => $numProducts,
         'products' => $productos,
        ];
    }

    echo json_encode($resp);
    break;

  case 'POST':
    $action = isset($_GET['action']) ? $_GET['action'] : null;

    $datos = [
      'descripcion' => isset($_POST['descripcion']) ? $_POST['descripcion'] : null,
      'id_marca' => isset($_POST['id_marca']) ? $_POST['id_marca'] : null,
      'id_categoria' => isset($_POST['id_categoria']) ? $_POST['id_categoria'] : null,
      'id_forma' => isset($_POST['id_forma']) ? $_POST['id_forma'] : null,
      'id_tipo_armazon' => isset($_POST['id_tipo_armazon']) ? $_POST['id_tipo_armazon'] : null,
      'color' => isset($_POST['color']) ? $_POST['color'] : null,
      'talla' => isset($_POST['talla']) ? $_POST['talla'] : null,
      'longitud_varilla' => isset($_POST['longitud_varilla']) ? $_POST['longitud_varilla'] : null,
      'ancho_puente' => isset($_POST['ancho_puente']) ? $_POST['ancho_puente'] : null,
      'ancho_total' => isset($_POST['ancho_total']) ? $_POST['ancho_total'] : null,
      'sku' => isset($_POST['sku']) ? $_POST['sku'] : null,
      'precio' => isset($_POST['precio']) ? $_POST['precio'] : null,
      'foto' => isset($_FILES['foto']) ? $_FILES['foto'] : null,
    ];

    $producto->setDescripcion($datos['descripcion']);
    $producto->setIdMarca($datos['id_marca']);
    $producto->setIdCategoria($datos['id_categoria']);
    $producto->setIdForma($datos['id_forma']);
    $producto->setIdTipoArmazon($datos['id_tipo_armazon']);
    $producto->setColor($datos['color']);
    $producto->setTalla($datos['talla']);
    $producto->setLongitudVarilla($datos['longitud_varilla']);
    $producto->setAnchoPuente($datos['ancho_puente']);
    $producto->setAnchoTotal($datos['ancho_total']);
    $producto->setSku($datos['sku']);
    $producto->setPrecio($datos['precio']);
    $producto->setFoto($datos['foto']);

    try {
        if ($action != 'update') {
            $id_producto = $producto->createProducto();
            $producto->setIdProducto($id_producto);
            echo json_encode([
              'ok' => true,
              'message' => 'Producto creado satisfactoriamente',
              'product' => $producto->readOneProducto(),
            ]);
        } else {
            $datos['id_producto'] = isset($_POST['id_producto']) ? $_POST['id_producto'] : null;
            $producto->setIdProducto($datos['id_producto']);
            $exists = $producto->readOneProducto() != null;
            if (!$exists) {
                echo json_encode([
                  'ok' => false,
                  'message' => 'El producto que intentas modificar no existe',
                ]);
                die();
            }

            $producto->modifyProducto();
            echo json_encode([
              'ok' => true,
              'message' => 'Producto modificado satisfactoriamente',
              'product' => $producto->readOneProducto(),
            ]);
        }
    } catch (\Throwable $th) {
        echo json_encode([
          'ok' => false,
          'message' => $th->getMessage(),
        ]);
    }

    break;

  case 'DELETE':
    $data = file_get_contents('php://input');
    $data = json_decode($data, true);
    if (!$data || empty($data['id_producto'])) {
        echo json_encode([
          'ok' => false,
          'message' => 'Por favor envia el id del producto a eliminar como id_producto',
        ]);
        die();
    }

    $producto->setIdProducto($data['id_producto']);
    $exists = $producto->readOneProducto() != null;
    if (!$exists) {
        echo json_encode([
          'ok' => false,
          'message' => 'El producto que intentas eliminar no existe',
        ]);
        die();
    }

    try {
        $producto->deleteProducto();

        echo json_encode([
          'ok' => true,
          'message' => 'Producto eliminado satisfactoriamente',
        ]);
    } catch (\Throwable $th) {
        echo json_encode([
          'ok' => false,
          'message' => $th->getMessage(),
        ]);
    }

    break;

  default:
    break;
}
