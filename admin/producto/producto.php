<?php

include_once '../class/producto.class.php';
include_once '../class/marca.class.php';
include_once '../class/forma.class.php';
include_once '../class/categoria.class.php';
include_once '../class/tipo_armazon.class.php';
$sistema->verificarPermiso('Productos');

$action = isset($_GET['action']) ? $_GET['action'] : null;

$producto = new Producto();
$marca = new Marca();
$categoria = new Categoria();
$forma = new Forma();
$tipoArmazon = new TipoArmazon();

switch ($action) {
  case 'new':
    $producto->setDescripcion($_POST['descripcion']);
    $producto->setIdMarca($_POST['id_marca']);
    $producto->setIdCategoria($_POST['id_categoria']);
    $producto->setIdForma($_POST['id_forma']);
    $producto->setIdTipoArmazon($_POST['id_tipo_armazon']);
    $producto->setColor($_POST['color']);
    $producto->setTalla($_POST['talla']);
    $producto->setLongitudVarilla($_POST['longitud_varilla']);
    $producto->setAnchoPuente($_POST['ancho_puente']);
    $producto->setAnchoTotal($_POST['ancho_total']);
    $producto->setSku($_POST['sku']);
    $producto->setPrecio($_POST['precio']);
    $producto->setFoto($_FILES['foto']);
    $producto->createProducto();
    header('Location: producto.php?action=form');
    break;

  case 'modify':
    $producto->setIdProducto($_POST['id_producto']);
    $producto->setDescripcion($_POST['descripcion']);
    $producto->setIdMarca($_POST['id_marca']);
    $producto->setIdCategoria($_POST['id_categoria']);
    $producto->setIdForma($_POST['id_forma']);
    $producto->setIdTipoArmazon($_POST['id_tipo_armazon']);
    $producto->setColor($_POST['color']);
    $producto->setTalla($_POST['talla']);
    $producto->setLongitudVarilla($_POST['longitud_varilla']);
    $producto->setAnchoPuente($_POST['ancho_puente']);
    $producto->setAnchoTotal($_POST['ancho_total']);
    $producto->setSku($_POST['sku']);
    $producto->setPrecio($_POST['precio']);
    $producto->setFoto($_FILES['foto']);
    $producto->modifyProducto();
    header('Location: producto.php');
    break;

  case 'form':
    $id_producto = isset($_GET['id_producto']) ? $_GET['id_producto'] : '';

    $data = [
      'precio' => '',
      'descripcion' => '',
      'color' => '',
      'talla' => rand(53,58),
      'longitud_varilla' => rand(140,150),
      'ancho_puente' => rand(15,21),
      'ancho_total' => rand(120,140),
      'sku' => strtoupper(substr(md5(sha1('sku').rand(1, 10000)), 0, 8)),
      'foto' => '',
      'id_marca' => '',
      'id_categoria' => '',
      'id_forma' => '',
      'id_tipo_armazon' => '',
    ];
    if (is_numeric($id_producto)) {
        $producto->setIdProducto($id_producto);
        $data = $producto->readOneProducto();
        $titulo = 'Modificar Producto';
        $script = 'producto.php?action=modify';
    } else {
        //valores dinamicos para el formulario
        $titulo = 'Nuevo Producto';
        $script = 'producto.php?action=new';
    }

    $data['marcas'] = $marca->fetchAll();
    $data['formas'] = $forma->fetchAll();
    $data['tipos'] = $tipoArmazon->fetchAll();
    $data['categorias'] = $categoria->fetchAll();

    include 'views/form.php';

    break;

  case 'delete':
    $id_producto = isset($_GET['id_producto']) ? $_GET['id_producto'] : '';
    if (is_numeric($id_producto)) {
        $producto->setIdProducto($id_producto);
        $producto->deleteProducto();
        header('Location: producto.php');
    }
    break;

  default:
    $data = $producto->fetchAll();
    include 'views/table.php';
    break;
}
