<?php

   include_once 'database.class.php';

   class TipoArmazon extends Database
   {
       private $id_tipo_armazon;
       private $tipo_armazon;

       public function setIdTipoArmazon($id_tipo_armazon)
       {
           $this->id_tipo_armazon = $id_tipo_armazon;
       }

       public function setTipoArmazon($tipo_armazon)
       {
           $this->tipo_armazon = $tipo_armazon;
       }

       /**
        * fetchAll.
        * Regresa una lista de todos los tipos de armazones 
        */
       public function fetchAll()
       {
           $sql = 'SELECT * from tipo_armazon';
           $tipo_armazones = $this->execQuery($sql, null);

           return $tipo_armazones;
       }

       public function readOneTipoArmazon()
       {
           $sql = 'SELECT * from tipo_armazon where id_tipo_armazon = ?';
           $params = [$this->id_tipo_armazon];
           $result = $this->execQuery($sql, $params);

           return $result[0];
       }

       public function createTipoArmazon()
       {
           $sql = 'INSERT into tipo_armazon(tipo_armazon) values (?)';
           $params = [$this->tipo_armazon];
           $this->execStmt($sql, $params);
       }

       public function deleteTipoArmazon()
       {
           $sql = 'DELETE from tipo_armazon where id_tipo_armazon = ?';
           $params = [$this->id_tipo_armazon];
           $this->execStmt($sql, $params);
       }

       public function modifyTipoArmazon()
       {
           $sql = 'UPDATE tipo_armazon set tipo_armazon = ? where id_tipo_armazon = ?';
           $params = [$this->tipo_armazon, $this->id_tipo_armazon];
           $this->execStmt($sql, $params);
       }
   }
