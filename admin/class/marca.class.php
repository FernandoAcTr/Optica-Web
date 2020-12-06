<?php

   include_once 'database.class.php';

   class Marca extends Database
   {
       private $id_marca;
       private $marca;

       public function setIdMarca($id_marca)
       {
           $this->id_marca = $id_marca;
       }

       public function setMarca($marca)
       {
           $this->marca = $marca;
       }

       /**
        * fetchAll.
        * Regresa una lista de todas las marcas 
        */
       public function fetchAll()
       {
           $sql = 'SELECT * from marca';
           $marcas = $this->execQuery($sql, null);

           return $marcas;
       }

       public function readOneMarca()
       {
           $sql = 'SELECT * from marca where id_marca = ?';
           $params = [$this->id_marca];
           $result = $this->execQuery($sql, $params);

           return $result[0];
       }

       public function createMarca()
       {
           $sql = 'INSERT into marca(marca) values (?)';
           $params = [$this->marca];
           $this->execStmt($sql, $params);
       }

       public function deleteMarca()
       {
           $sql = 'DELETE from marca where id_marca = ?';
           $params = [$this->id_marca];
           $this->execStmt($sql, $params);
       }

       public function modifyMarca()
       {
           $sql = 'UPDATE marca set marca = ? where id_marca = ?';
           $params = [$this->marca, $this->id_marca];
           $this->execStmt($sql, $params);
       }
   }
