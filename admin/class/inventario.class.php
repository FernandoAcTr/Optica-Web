<?php

include_once 'database.class.php';
class Inventario extends Database
{
    public function fetchAll()
    {
        $sql = 'SELECT i.*, p.descripcion, pd.foto 
        FROM inventario i
        JOIN producto p on p.id_producto = i.id_producto
        JOIN producto_detalle pd on pd.id_producto = p.id_producto';

        return $this->execQuery($sql, null);
    }
}
