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
               $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
               ];
               $this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->database, $this->user, $this->password, $options);

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

       /**
        * execQuery.
        * Ejecuta una consulta a la base de datos en forma de sentencia preparada.
        *
        * @param	mixed	$sql   	Consulta que se quiere ejecutar
        * @param	mixed	$params	Parametros si es que la consulta los lleva o null de lo contrario
        *
        * @return	mixed   $Array asociativo con todos los registros devueltos por una consulta
        */
       public function execQuery($sql, $params)
       {
           $this->connect();
           $fila = null;

           try {
               $stmt = $this->conn->prepare($sql);
               $stmt->execute($params);
               $fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
           } catch (\Throwable $th) {
               throw $th;
           }

           $this->close();

           return $fila;
       }

       /**
        * execStmt.
        * Ejecuta una sentencia sql con parametros en forma de sentencia preparada.
        *
        * @param	mixed	$sql La inserccion o modificacion a la base de datos
        * @param	mixed	$params Los parametros de la sentencia
        */
       public function execStmt($sql, $params)
       {
           $this->connect();

           try {
               $stmt = $this->conn->prepare($sql);
               $stmt->execute($params);
           } catch (\Throwable $th) {
               throw $th;
           }

           $this->close();
       }
   }
   include_once 'sistema.class.php';
