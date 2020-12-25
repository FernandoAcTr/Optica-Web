<?php

include_once '../class/database.class.php';

$sistema->verificarPermiso('Dashboard');

$database = new Database();
$database->connect();

//contar el numero de proveedores
$sql = 'SELECT COUNT(*) as proveedores from proveedor';
$proveedores = $database->execQuery($sql, null)[0];
$proveedores = $proveedores['proveedores'];

//contar el numero de productos
$sql = 'SELECT COUNT(*) as productos from producto';
$productos = $database->execQuery($sql, null)[0];
$productos = $productos['productos'];

//contar el numero de marcas
$sql = 'SELECT COUNT(*) as marcas from marca';
$marcas = $database->execQuery($sql, null)[0];
$marcas = $marcas['marcas'];

//contar los productos en stock
$sql = 'SELECT sum(stock) as stock FROM inventario';
$stock = $database->execQuery($sql, null)[0];
$stock = $stock['stock'];

//Obtener los ultimos 4 productos agregados
$sql = "SELECT p.*, pd.color, pd.talla, pd.longitud_varilla, pd.ancho_puente, pd.ancho_total, pd.sku,  m.marca, c.categoria, f.forma, ta.tipo_armazon, COALESCE(pd.foto, 'no-foto.jpg') as foto  
from producto p
JOIN producto_detalle pd on p.id_producto = pd.id_producto
JOIN marca m on m.id_marca = p.id_marca
JOIN categoria c on c.id_categoria = p.id_categoria
JOIN forma f on f.id_forma = p.id_forma
JOIN tipo_armazon ta on ta.id_tipo_armazon = p.id_tipo_armazon
order by id_producto desc limit 4";
$ultimosProductos = $database->execQuery($sql, null);

$database->close();

include 'views/index.php';
