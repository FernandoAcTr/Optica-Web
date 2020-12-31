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

    public function setIdVenta($id_venta)
    {
        $this->id_venta = $id_venta;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public function generateId()
    {
        $id = substr(md5(sha1('IdVentaAleatoria').rand(1, 10000)), 0, 17);

        return strtoupper($id);
    }

    public function createVentaPaypal()
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            //crear un cliente si no existe
            $existCliente = $this->cliente->existCliente($this->conn);
            if (!empty($this->cliente->getIdCliente()) && !$existCliente) {
                $this->cliente->createClientePaypal($this->conn);
            }

            //insertar una venta
            $sql = 'INSERT INTO venta(id_venta, fecha, id_cliente, status, tipo) VALUES (?,?,?,?,?)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_venta, $this->fecha, $this->cliente->getIdCliente(), $this->status, 'Paypal']);

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

    public function createVentaManual()
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            //insertar una venta
            $sql = 'INSERT INTO venta(id_venta, fecha, id_cliente, status, tipo) VALUES (?,?,?,?,?)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_venta, $this->fecha, $this->cliente, $this->status, 'Manual']);

            //disminuir inventario de los productos vendidos
            $sql = 'UPDATE inventario set stock = stock - ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->items as $key => $item) {
                $stmt->execute([$item['cantidad'], $key]);
            }

            //insertar en una tabla los productos vendidos
            $sql = 'INSERT INTO venta_detalle(id_venta, id_producto, cantidad) VALUES (?,?,?)';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->items as $key => $item) {
                $stmt->execute([$this->id_venta, $key, $item['cantidad']]);
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

    public function modifyVenta()
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            //Modificar una venta
            $sql = 'UPDATE venta set fecha = ?, id_cliente = ? where id_venta = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->fecha, $this->cliente, $this->id_venta]);

            //Consultar cuales eran los productos que tenia esa venta
            $sql = 'SELECT id_producto, cantidad
            from venta_detalle vd
            WHERE id_venta = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_venta]);
            $productosAntiguos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //sumar del inventario todos los productos viejos, porque se van a eliminar y volver a insertar los nuevos
            $sql = 'UPDATE inventario set stock = stock + ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($productosAntiguos as $producto) {
                $stmt->execute([$producto['cantidad'], $producto['id_producto']]);
            }

            //Borrar los productos de la venta
            $sql = 'DELETE from venta_detalle where id_venta = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_venta]);

            //volver a insertar los nuevos productos actualizados
            $sql = 'INSERT INTO venta_detalle(id_venta, id_producto, cantidad) VALUES (?,?,?)';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->items as $key => $item) {
                $stmt->execute([$this->id_venta, $key, $item['cantidad']]);
            }

            //Modificar el inventario de cada producto y restarle las nuevas cantidades
            $sql = 'UPDATE inventario set stock = stock - ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->items as $key => $item) {
                $stmt->execute([$item['cantidad'], $key]);
            }

            $this->conn->commit();
        } catch (\Throwable $th) {
            $this->conn->rollback();
            throw $th;
        }
        $this->close();
    }

    public function deleteVenta()
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            //Consultar cuales eran los productos que tenia esa venta
            $sql = 'SELECT id_producto, cantidad
            from venta_detalle vd
            WHERE id_venta = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_venta]);
            $productosAntiguos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //sumar del inventario todos los productos viejos
            $sql = 'UPDATE inventario set stock = stock + ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($productosAntiguos as $producto) {
                $stmt->execute([$producto['cantidad'], $producto['id_producto']]);
            }

            //Borrar la venta
            $sql = 'DELETE from venta where id_venta = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_venta]);

            $this->conn->commit();
        } catch (\Throwable $th) {
            $this->conn->rollback();
            throw $th;
        }
        $this->close();
    }

    public function fetchAll()
    {
        $sql = "SELECT v.*, concat(c.nombre, ' ', c.apellido) as cliente  
        from venta v
        LEFT JOIN cliente c on c.id_cliente = v.id_cliente";

        return $this->execQuery($sql, null);
    }

    public function readOneVenta()
    {
        $sql = 'SELECT * from venta where id_venta = ?';
        $ventas = $this->execQuery($sql, [$this->id_venta]);

        return $ventas[0];
    }

    public function readProductosVenta()
    {
        $sql = 'SELECT vd.id_producto, vd.cantidad, p.precio, p.descripcion
        from venta_detalle vd
        JOIN producto p USING (id_producto)
        WHERE id_venta = ?';
        $productos = $this->execQuery($sql, [$this->id_venta]);

        return $productos;
    }
}
