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

       public function getIdCliente()
       {
           return $this->id_cliente;
       }

       /**
        * No se abre la conexion porque el cliente depende de una transaccion cuando compra.
        * Se inserta un cliente solamente al hacerse una venta y la conexion se abre desde el metodo de la clase venta.
        */
       public function createCliente($conn)
       {
           $sql = 'INSERT INTO cliente(id_cliente, email, nombre, apellido, calle, colonia, ciudad, cod_postal) VALUES (?,?,?,?,?,?,?,?)';
           $stmt = $conn->prepare($sql);
           $stmt->execute([$this->id_cliente, $this->email, $this->nombre, $this->apellido, $this->calle, $this->colonia, $this->ciudad, $this->cod_postal]);
       }

       public function existCliente($conn)
       {
           $sql = 'SELECT * from cliente where id_cliente = ?';
           $stmt = $conn->prepare($sql);
           $stmt->execute([$this->id_cliente]);

           $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

           return $cliente != null;
       }

       public function fetchAll()
       {
           $sql = 'SELECT * from cliente';

           return $this->execQuery($sql, null);
       }
   }
