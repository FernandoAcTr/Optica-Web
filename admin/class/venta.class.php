<?php

include_once 'database.class.php';
include_once 'cliente.class.php';
class Venta extends Database
{
    private $id_venta;
    private $fecha;
    private $cliente;
    private $status;
    private $items;

    public function __construct($id_venta, $fecha, $cliente, $status, $items)
    {
        $this->id_venta = $id_venta;
        $this->fecha = $fecha;
        $this->cliente = $cliente;
        $this->status = $status;
        $this->items = $items;
    }

    public function createVenta()
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            //crear un cliente si no existe
            $existCliente = $this->cliente->existCliente($this->conn);
            if (!empty($this->cliente->getIdCliente()) && !$existCliente) {
                $this->cliente->createCliente($this->conn);
            }

            //insertar una venta
            $sql = 'INSERT INTO venta(id_venta, fecha, id_cliente, status) VALUES (?,?,?,?)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_venta, $this->fecha, $this->cliente->getIdCliente(), $this->status]);

            //disminuir inventario de los productos vendidos
            $sql = 'UPDATE inventario set stock = stock - ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->items as $item) {
                $stmt->execute([$item['cantidad'], $item['id_producto']]);
            }

            //insertar en una tabla los productos vendidos en una venta
            $sql = 'INSERT INTO venta_detalle(id_venta, id_producto, cantidad) VALUES (?,?,?)';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->items as $item) {
                $stmt->execute([$this->id_venta, $item['id_producto'], $item['cantidad']]);
            }

            $this->conn->commit();

            return true;
        } catch (\Throwable $th) {
            $this->conn->rollback();
            print_r($th);
            die();
        }
        $this->close();

        return false;
    }
}
