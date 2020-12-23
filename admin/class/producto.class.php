<?php

   include_once 'database.class.php';

   class Producto extends Database
   {
       private $id_producto;
       private $id_tipo_armazon;
       private $id_marca;
       private $id_categoria;
       private $id_forma;
       private $precio;
       private $descripcion;
       private $color;
       private $talla;
       private $longitud_varilla;
       private $ancho_puente;
       private $ancho_total;
       private $sku;
       private $foto;

       public function setIdProducto($id_producto)
       {
           $this->id_producto = $id_producto;
       }

       public function setIdTipoArmazon($id_tipo_armazon)
       {
           $this->id_tipo_armazon = $id_tipo_armazon;
       }

       public function setIdMarca($id_marca)
       {
           $this->id_marca = $id_marca;
       }

       public function setIdCategoria($id_categoria)
       {
           $this->id_categoria = $id_categoria;
       }

       public function setIdForma($id_forma)
       {
           $this->id_forma = $id_forma;
       }

       public function setPrecio($precio)
       {
           $this->precio = $precio;
       }

       public function setDescripcion($descripcion)
       {
           $this->descripcion = $descripcion;
       }

       public function setColor($color)
       {
           $this->color = $color;
       }

       public function setTalla($talla)
       {
           $this->talla = $talla;
       }

       public function setLongitudVarilla($longitud_varilla)
       {
           $this->longitud_varilla = $longitud_varilla;
       }

       public function setAnchoPuente($ancho_puente)
       {
           $this->ancho_puente = $ancho_puente;
       }

       public function setAnchoTotal($ancho_total)
       {
           $this->ancho_total = $ancho_total;
       }

       public function setSku($sku)
       {
           $this->sku = $sku;
       }

       public function setFoto($foto)
       {
           $this->foto = $foto;
       }

       public function createProducto()
       {
           $this->connect();
           $this->conn->beginTransaction();

           try {
               //insertar en la tabla de productos
               $sql = 'INSERT INTO producto(precio, descripcion, id_tipo_armazon, id_marca, id_categoria, id_forma) 
                VALUES (?,?,?,?,?,?)';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->precio, $this->descripcion, $this->id_tipo_armazon, $this->id_marca, $this->id_categoria, $this->id_forma]);

               //obtener el ID del producto insertado
               $sql = 'SELECT id_producto from producto
                ORDER by id_producto desc
                limit 1';
               $result = $this->conn->query($sql);
               $producto = $result->fetch();

               //insertar en la tabla de detalle del producto
               $nombreFoto = $this->uploadPicture();
               if ($nombreFoto) {
                   $sql = 'INSERT INTO producto_detalle(id_producto, color, talla, longitud_varilla, ancho_puente, ancho_total, sku, foto) 
                    VALUES (?,?,?,?,?,?,?,?)';
                   $stmt = $this->conn->prepare($sql);
                   $stmt->execute([$producto['id_producto'], $this->color, $this->talla, $this->longitud_varilla, $this->ancho_puente, $this->ancho_total, $this->sku, $nombreFoto]);
               } else {
                   $sql = 'INSERT INTO producto_detalle(id_producto, color, talla, longitud_varilla, ancho_puente, ancho_total, sku) 
                    VALUES (?,?,?,?,?,?,?)';
                   $stmt = $this->conn->prepare($sql);
                   $stmt->execute([$producto['id_producto'], $this->color, $this->talla, $this->longitud_varilla, $this->ancho_puente, $this->ancho_total, $this->sku]);
               }

               //insertar en inventario 0 unidades
               $sql = 'INSERT INTO inventario(id_producto, stock) VALUES (?,?)';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$producto['id_producto'], 0]);

               //commit a todas las operaciones
               $this->conn->commit();
           } catch (\Throwable $th) {
               $this->conn->rollback();
               throw $th;
           }
           $this->close();
       }

       public function modifyProducto()
       {
           $antiguo = $this->readOneProducto();
           $this->connect();
           $this->conn->beginTransaction();
           try {
               //modificar en la tabla de productos
               $sql = 'UPDATE producto SET precio = ?,descripcion = ?,id_tipo_armazon = ?,id_marca = ?,id_categoria = ?,id_forma = ? WHERE id_producto = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->precio, $this->descripcion, $this->id_tipo_armazon, $this->id_marca, $this->id_categoria, $this->id_forma, $this->id_producto]);

               //modificar en la tabla de detalle del producto
               $nombreFoto = $this->uploadPicture();
               if ($nombreFoto) {
                   $sql = 'UPDATE producto_detalle SET color=?, talla=?, longitud_varilla=?, ancho_puente=?, ancho_total=?, sku=?, foto = ? WHERE id_producto = ?';
                   $stmt = $this->conn->prepare($sql);
                   $stmt->execute([$this->color, $this->talla, $this->longitud_varilla, $this->ancho_puente, $this->ancho_total, $this->sku, $nombreFoto, $this->id_producto]);
               } else {
                   $sql = 'UPDATE producto_detalle SET color=?, talla=?, longitud_varilla=?, ancho_puente=?, ancho_total=?, sku=? WHERE id_producto = ?';
                   $stmt = $this->conn->prepare($sql);
                   $stmt->execute([$this->color, $this->talla, $this->longitud_varilla, $this->ancho_puente, $this->ancho_total, $this->sku, $this->id_producto]);
               }
               $this->deletePicture($antiguo['foto']);
               $this->conn->commit();
           } catch (\Throwable $th) {
               $this->conn->rollback();
               throw $th;
           }
           $this->close();
       }

       public function deleteProducto()
       {
           $producto = $this->readOneProducto();
           try {
               $sql = 'DELETE from producto where id_producto = ?';
               $params = [$this->id_producto];
               $this->execStmt($sql, $params);

               $this->deletePicture($producto['foto']);
           } catch (\Throwable $th) {
               $mensaje = 'No puedes eliminar un producto que ya se ha comprado antes. Elimina todas las compras en donde se encuentre registrado';
               die($mensaje);
           }
       }

       public function fetchAll()
       {
           $sql = "SELECT p.*, pd.color, pd.talla, pd.longitud_varilla, pd.ancho_puente, pd.ancho_total, pd.sku,  m.marca, c.categoria, f.forma, ta.tipo_armazon, COALESCE(pd.foto, 'no-foto.jpg') as foto  
           from producto p
           JOIN producto_detalle pd on p.id_producto = pd.id_producto
           JOIN marca m on m.id_marca = p.id_marca
           JOIN categoria c on c.id_categoria = p.id_categoria
           JOIN forma f on f.id_forma = p.id_forma
           JOIN tipo_armazon ta on ta.id_tipo_armazon = p.id_tipo_armazon";
           $productos = $this->execQuery($sql, null);

           return $productos;
       }

       public function readOneProducto()
       {
           $sql = "SELECT p.*, pd.color, pd.talla, pd.longitud_varilla, pd.ancho_puente, pd.ancho_total, pd.sku, COALESCE(pd.foto, 'no-foto.jpg') as foto
            from producto p
            JOIN producto_detalle pd using(id_producto)
            WHERE id_producto = ?";
           $productos = $this->execQuery($sql, [$this->id_producto]);

           return $productos[0];
       }

       private function uploadPicture()
       {
           if ($this->foto['name']) {
               $type = explode('/', $this->foto['type'])[1];
               $permitidos = ['jpg', 'png', 'jpeg'];

               if (!in_array($type, $permitidos)) {
                   return null;
               }

               $nombreLimpio = uniqid().'.'.$type;

               if (move_uploaded_file($this->foto['tmp_name'], '../../img/productos/'.$nombreLimpio)) {
                   return $nombreLimpio;
               }
           }

           return null;
       }

       private function deletePicture($name)
       {
           try {
               if (strcmp($name, 'no-foto.jpg') != 0) {
                   unlink('../../img/productos/'.$name);
               }
           } catch (\Throwable $th) {
           }
       }
   }
