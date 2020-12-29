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
           $sql = "SELECT p.id_producto, p.precio, p.descripcion, 
           pd.color, pd.talla, pd.longitud_varilla, pd.ancho_puente, pd.ancho_total, pd.sku,  
           m.marca, c.categoria, f.forma, ta.tipo_armazon, i.stock, COALESCE(pd.foto, 'no-foto.jpg') as foto  
           from producto p
           JOIN producto_detalle pd on p.id_producto = pd.id_producto
           JOIN marca m on m.id_marca = p.id_marca
           JOIN categoria c on c.id_categoria = p.id_categoria
           JOIN forma f on f.id_forma = p.id_forma
           JOIN tipo_armazon ta on ta.id_tipo_armazon = p.id_tipo_armazon
           JOIN inventario i on i.id_producto = p.id_producto
           WHERE p.id_producto = ?";
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

       //==================================================
       // Funciones para la API
       //==================================================

       /**
        * showPaginate.
        * Entrega un array con todos los productos de manera paginada.
        * Es posible clasificar los productos por categoria y ordenarlos
        * bajo ciertos criterios, si se pasa un codigo numerico a la funcion.
        *
        * @param	mixed	$page - La pagina que se desea consultar
        * @param	mixed	$orderBy - Valor numerico del 1 al 4 que representa un criterior de ordenacion
        * @param	mixed	$filter - Valor numerico que representa el id de la categoria o 0 para todos los productos
        *
        * @return	array   arreglo con todos los productos encontrados
        */
       public function showPaginate($page, $orderBy, $filter)
       {
           //datos de las paginas
           $pageSize = 9;
           $page = (int) (isset($page) ? $page : 1);
           $start = (int) (isset($page) ? ($page - 1) * $pageSize : 0);

           //criterio de ordenacion
           $orderBy = $this->mapOrderBy($orderBy);

           //filtro de categoria. Si no esta definido se pone en blanco
           $where = isset($filter) && $filter != 0 ? " where p.id_categoria = $filter " : '';

           $sql = "SELECT p.*, pd.color, pd.talla, pd.longitud_varilla, pd.ancho_puente, pd.ancho_total, pd.sku,  m.marca, c.categoria, f.forma, ta.tipo_armazon, COALESCE(pd.foto, 'no-foto.jpg') as foto  
           from producto p
           JOIN producto_detalle pd on p.id_producto = pd.id_producto
           JOIN marca m on m.id_marca = p.id_marca
           JOIN categoria c on c.id_categoria = p.id_categoria
           JOIN forma f on f.id_forma = p.id_forma
           JOIN tipo_armazon ta on ta.id_tipo_armazon = p.id_tipo_armazon
           $where
           $orderBy";

           //Encontrar el total de productos sin paginar la busqueda
           $totalProductos = $this->getNumProducts($sql);
           $totalPages = ceil($totalProductos / $pageSize);

           //paginar la busqueda
           $sql .= "LIMIT $start,$pageSize";

           $productos = $this->execQuery($sql, null);

           return [
               'page' => $page,
               'totalProducts' => $totalProductos,
               'totalPages' => $totalPages,
               'start' => ($start + 1),
               'end' => $start + $pageSize,
               'pageSize' => $pageSize,
               'items' => $productos,
           ];
       }

       private function getNumProducts($sql)
       {
           $total = $this->execQuery($sql, null);

           return count($total);
       }

       private function mapOrderBy($orderBy)
       {
           switch ($orderBy) {
            case 1:
              return ' order by precio asc ';

            case 2:
              return ' order by precio desc ';

            case 3:
              return ' order by marca asc ';

            case 4:
              return ' order by marca desc ';

            default:
              return ' order by id_producto ';
          }
       }

       public function getCategories()
       {
           $sql = 'SELECT * from categoria';
           $categorias = $this->execQuery($sql, null);
           $categorias[count($categorias)] = [
               'id_categoria' => '0',
               'categoria' => 'Todos',
           ];

           return $categorias;
       }

       public function getProductsPerFace($face)
       {
           $sql = 'SELECT p.id_producto, p.descripcion, m.marca, c.categoria, f.forma, ta.tipo_armazon, pd.foto 
           from producto p
           JOIN producto_detalle pd on p.id_producto = pd.id_producto
           JOIN marca m on m.id_marca = p.id_marca
           JOIN categoria c on c.id_categoria = p.id_categoria
           JOIN forma f on f.id_forma = p.id_forma
           JOIN tipo_armazon ta on ta.id_tipo_armazon = p.id_tipo_armazon ';

           switch ($face) {
                case 'cuadrada':
                $sql .= "WHERE f.forma in ('Redondo', 'Lagrima')";
                    break;
                case 'rectangular':
                    $sql .= "WHERE f.forma in ('Cuadrada', 'Lagrima', 'Aviador')";
                    break;

                case 'ovalada':
                    $sql .= "WHERE ta.tipo_armazon in ('Acetato', 'Metalico')";
                    break;

                case 'redonda':
                    $sql .= "WHERE f.forma in ('Cuadrada')";
                    break;

                case 'triangular':
                    $sql .= "WHERE ta.tipo_armazon in ('Ranurado', 'Volado')";
                    break;

                case 'diamante':
                    $sql .= "WHERE f.forma in ('Cuadrada')";
                    break;

                case 'corazon':
                    $sql .= "WHERE f.forma in ('Redondo')";
                    break;
            }

           $sql .= " and c.categoria not in ('Accesorios', 'Lentes de Seguridad') ORDER BY rand() LIMIT 4";
           $productos = $this->execQuery($sql, null);

           return $productos;
       }
   }
