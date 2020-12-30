<?php

   include_once 'database.class.php';

   class Cliente extends Database
   {
       private $id_cliente;
       private $email;
       private $nombre;
       private $apellido;
       private $calle;
       private $colonia;
       private $ciudad;
       private $cod_postal;

       public function __construct($id_cliente, $email, $nombre, $apellido, $calle, $colonia, $ciudad, $cod_postal)
       {
           $this->id_cliente = $id_cliente;
           $this->email = $email;
           $this->nombre = $nombre;
           $this->apellido = $apellido;
           $this->calle = $calle;
           $this->colonia = $colonia;
           $this->ciudad = $ciudad;
           $this->cod_postal = $cod_postal;
       }

       public function setIdCliente($id_cliente)
       {
           $this->id_cliente = $id_cliente;
       }

       public function setEmail($email)
       {
           $this->email = $email;
       }

       public function setNombre($nombre)
       {
           $this->nombre = $nombre;
       }

       public function setApellido($apellido)
       {
           $this->apellido = $apellido;
       }

       public function setCalle($calle)
       {
           $this->calle = $calle;
       }

       public function setColonia($colonia)
       {
           $this->colonia = $colonia;
       }

       public function setCiudad($ciudad)
       {
           $this->ciudad = $ciudad;
       }

       public function setCodPostal($cod_postal)
       {
           $this->cod_postal = $cod_postal;
       }

       public function getIdCliente()
       {
           return $this->id_cliente;
       }

       public function generateId()
       {
           $id = substr(md5(sha1('IdClienteAleatorio').rand(1, 10000)), 0, 13);

           return strtoupper($id);
       }

       /**
        * No se abre la conexion porque el cliente depende de una transaccion cuando compra.
        * Se inserta un cliente solamente al hacerse una venta y la conexion se abre desde el metodo de la clase venta.
        */
       public function createClientePaypal($conn)
       {
           $sql = 'INSERT INTO cliente(id_cliente, email, nombre, apellido, calle, colonia, ciudad, cod_postal, tipo) VALUES (?,?,?,?,?,?,?,?,?)';
           $stmt = $conn->prepare($sql);
           $stmt->execute([$this->id_cliente, $this->email, $this->nombre, $this->apellido, $this->calle, $this->colonia, $this->ciudad, $this->cod_postal, 'Paypal']);
       }

       public function createClienteManual()
       {
           $sql = 'INSERT INTO cliente(id_cliente, email, nombre, apellido, calle, colonia, ciudad, cod_postal, tipo) VALUES (?,?,?,?,?,?,?,?,?)';
           $this->execStmt($sql, [$this->id_cliente, $this->email, $this->nombre, $this->apellido, $this->calle, $this->colonia, $this->ciudad, $this->cod_postal, 'Manual']);
       }

       public function modifyCliente()
       {
           $sql = 'UPDATE cliente SET email = ?, nombre = ?, apellido = ?, calle = ?, colonia = ?, ciudad = ?, cod_postal = ?  WHERE id_cliente = ?';
           $this->execStmt($sql, [$this->email, $this->nombre, $this->apellido, $this->calle, $this->colonia, $this->ciudad, $this->cod_postal, $this->id_cliente]);
       }

       public function deleteCliente()
       {
           $sql = 'DELETE from cliente  WHERE id_cliente = ?';
           $this->execStmt($sql, [$this->id_cliente]);
       }

       public function existCliente($conn)
       {
           $sql = 'SELECT * from cliente where id_cliente = ?';
           $stmt = $conn->prepare($sql);
           $stmt->execute([$this->id_cliente]);

           $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

           return $cliente != null;
       }

       public function readOneCliente()
       {
           $sql = 'SELECT * from cliente where id_cliente = ?';

           return $this->execQuery($sql, [$this->id_cliente])[0];
       }

       public function fetchAll()
       {
           $sql = 'SELECT * from cliente';

           return $this->execQuery($sql, null);
       }
   }
