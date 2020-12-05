<?php

    session_start();
   class Database
   {
       public $host;
       public $port;
       public $database;
       public $user;
       public $password;
       public $conn;

       public function connect()
       {
           $this->host = 'localhost';
           $this->port = '3306';
           $this->database = 'optica';
           $this->user = 'empleado';
           $this->password = '123456';

           try {
               $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->password);

               $this->conn->exec('set names utf8');
               setlocale(LC_ALL, 'es_ES.UTF-8');
           } catch (PDOException $e) {
               echo '¡Error al conectar a la BD!: '.$e->getMessage().'<br/>';
               die();
           }
       }

       public function close()
       {
           $this->conn = null;
       }

       public function execQuery($sql, $params)
       {
           $this->connect();
           $stmt = $this->conn->prepare($sql);

           $fila = null;
           if ($stmt->execute($params)) {
               $fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
           } else {
               throw new Exception('Error al ejecutar consulta. Checa la sintaxis SQL', 1);
           }
           $this->close();

           return $fila;
       }
   }
