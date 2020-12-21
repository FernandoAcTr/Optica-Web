<?php

include 'database.class.php';
class Compra extends Database
{
    private $id_compra;
    private $folio;
    private $fecha;
    private $id_proveedor;
    private $productos;

    public function setIdCompra($id_compra)
    {
        $this->id_compra = $id_compra;
    }

    public function setFolio($folio)
    {
        $this->folio = $folio;
    }

    public function generateFolio()
    {
        $folio = substr(md5(sha1('cadenaAleatoria').rand(1, 10000)), 0, 16);

        return strtoupper($folio);
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function setIdProveedor($id_proveedor)
    {
        $this->id_proveedor = $id_proveedor;
    }

    public function setProductos($productos)
    {
        $this->productos = $productos;
    }

    public function createCompra()
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            //insertar una compra
            $sql = 'INSERT INTO compra(folio, fecha, id_proveedor) VALUES (?,?,?)';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->folio, $this->fecha, $this->id_proveedor]);

            //obtener el id de la compra generado
            $sql = 'SELECT id_compra from compra order by id_compra desc limit 1';
            $result = $this->conn->query($sql);
            $compra = $result->fetch();

            //insertar los detalles de la compra. 1 registro producto
            $sql = 'INSERT INTO compra_detalle(id_compra, id_producto, cantidad, precio_proveedor) VALUES (?,?,?,?)';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->productos as $id_producto => $producto) {
                $stmt->execute([$compra['id_compra'], $id_producto, $producto['cantidad'], $producto['precio']]);
            }

            //Modificar el inventario de cada producto
            $sql = 'UPDATE inventario set stock = stock + ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->productos as $id_producto => $producto) {
                $stmt->execute([$producto['cantidad'], $id_producto]);
            }

            $this->conn->commit();
        } catch (\Throwable $th) {
            $this->conn->rollback();
            throw $th;
        }
        $this->close();
    }

    public function modifyCompra()
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            //Modificar una compra
            $sql = 'UPDATE compra set fecha = ?, id_proveedor = ? where id_compra = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->fecha, $this->id_proveedor, $this->id_compra]);

            //Consultar cuales eran los productos que tenia esa compra
            $sql = 'SELECT id_producto, cantidad
            from compra_detalle cd
            WHERE id_compra = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_compra]);
            $productosAntiguos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //restar del inventario todos los productos viejos, porque se van a eliminar y volver a insertar los nuevos
            $sql = 'UPDATE inventario set stock = stock - ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($productosAntiguos as $producto) {
                $stmt->execute([$producto['cantidad'], $producto['id_producto']]);
            }

            //Borrar los productos de la compra
            $sql = 'DELETE from compra_detalle where id_compra = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_compra]);

            //volver a insertar los nuevos productos actualizados
            $sql = 'INSERT INTO compra_detalle(id_compra, id_producto, cantidad, precio_proveedor) VALUES (?,?,?,?)';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->productos as $id_producto => $producto) {
                $stmt->execute([$this->id_compra, $id_producto, $producto['cantidad'], $producto['precio']]);
            }

            //Modificar el inventario de cada producto y sumarle las nuevas cantidades
            $sql = 'UPDATE inventario set stock = stock + ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($this->productos as $id_producto => $producto) {
                $stmt->execute([$producto['cantidad'], $id_producto]);
            }

            $this->conn->commit();
        } catch (\Throwable $th) {
            $this->conn->rollback();
            throw $th;
        }
        $this->close();
    }

    public function deleteCompra()
    {
        $this->connect();
        $this->conn->beginTransaction();
        try {
            //Consultar cuales eran los productos que tenia esa compra
            $sql = 'SELECT id_producto, cantidad
            from compra_detalle cd
            WHERE id_compra = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_compra]);
            $productosAntiguos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            //restar del inventario todos los productos comprados
            $sql = 'UPDATE inventario set stock = stock - ? where id_producto = ?';
            $stmt = $this->conn->prepare($sql);
            foreach ($productosAntiguos as $producto) {
                $stmt->execute([$producto['cantidad'], $producto['id_producto']]);
            }

            //Borrar la compra
            $sql = 'DELETE from compra where id_compra = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$this->id_compra]);

            $this->conn->commit();
        } catch (\Throwable $th) {
            $this->conn->rollback();
            throw $th;
        }
        $this->close();
    }

    public function fetchAll()
    {
        $sql = 'SELECT c.*, p.razon_social 
        FROM compra c
        JOIN proveedor p USING(id_proveedor)';

        return $this->execQuery($sql, null);
    }

    public function readOneCompra()
    {
        $sql = 'SELECT * from compra where id_compra = ?';
        $compras = $this->execQuery($sql, [$this->id_compra]);

        return $compras[0];
    }

    public function readProductosCompra()
    {
        $sql = 'SELECT cd.id_producto, cd.cantidad, cd.precio_proveedor, p.descripcion
        from compra_detalle cd
        JOIN producto p USING (id_producto)
        WHERE id_compra = ?';
        $productos = $this->execQuery($sql, [$this->id_compra]);

        return $productos;
    }
}
