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

//contar las ventas realizadas en la pagina
$sql = "SELECT COUNT(*) as ventas from venta where tipo like 'Paypal' and status like 'COMPLETED'";
$ventasPaypal = $database->execQuery($sql, null)[0];
$ventasPaypal = $ventasPaypal['ventas'];

//contar las ventas canceladas
$sql = "SELECT COUNT(*) as ventas_canceladas from venta where status like 'CANCELLED'";
$ventasCanceladas = $database->execQuery($sql, null)[0];
$ventasCanceladas = $ventasCanceladas['ventas_canceladas'];

//contar el numero de clientes de la pagina
$sql = "SELECT COUNT(*) as clientes from cliente where tipo like 'Paypal'";
$clientesPaypal = $database->execQuery($sql, null)[0];
$clientesPaypal = $clientesPaypal['clientes'];

//contar el numero de clientes totales
$sql = "SELECT COUNT(*) as clientes from cliente";
$clientes = $database->execQuery($sql, null)[0];
$clientes = $clientes['clientes'];

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
