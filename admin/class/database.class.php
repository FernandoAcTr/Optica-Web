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
           $stmt = $this->conn->prepare($sql);

           $fila = null;
           if ($stmt->execute($params)) {
               $fila = $stmt->fetchAll(PDO::FETCH_ASSOC);
           } else {
               $this->close();
               throw new Exception('Error al ejecutar consulta. Checa la sintaxis SQL', 1);
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

           $stmt = $this->conn->prepare($sql);
           if (!$stmt->execute($params)) {
               $this->close();
               throw new Exception('Error al ejecutar el insert: execStmt', 1);
           }

           $this->close();
       }

       /**
        * execMultipleStmt.
        * Ejecuta multiples insercciones SQL dentro de una transaccion.
        *
        * @param	mixed	$arraySql Arreglo de insercciones con el formato+
        *	 $arraySql = [
        *       [
        *         'sql' => 'INSERT into A(a, b, c, d) values (?,?,?,?)',
        *         'params' => ['a', 'b', 'c','d'],
        *       ],
        *    ]
        *
        * @return	bool si se ejecutaron o no todas las insercciones
        */
       public function execMultipleStmt($arraySql)
       {
           $this->connect();
           $this->conn->beginTransaction();

           $rollback = false;

           try {
               foreach ($arraySql as $sql) {
                   $stmt = $this->conn->prepare($sql['sql']);

                   if (!$stmt->execute()) {
                       $rollback = true;
                       print_r($sql['params']);
                   }
               }
           } catch (\Throwable $th) {
               $rollback = true;
               print_r($th);
           }

           if ($rollback) {
               $this->conn->rollBack();
           } else {
               $this->conn->commit();
           }

           $this->close();

           return $rollback;
       }
   }