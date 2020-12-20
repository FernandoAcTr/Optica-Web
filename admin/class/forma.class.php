<?php

   include_once 'database.class.php';

   class Forma extends Database
   {
       private $id_forma;
       private $forma;

       public function setIdForma($id_forma)
       {
           $this->id_forma = $id_forma;
       }

       public function setForma($forma)
       {
           $this->forma = $forma;
       }

       /**
        * fetchAll.
        * Regresa una lista de todas las formas 
        */
       public function fetchAll()
       {
           $sql = 'SELECT * from forma';
           $formas = $this->execQuery($sql, null);

           return $formas;
       }

       public function readOneForma()
       {
           $sql = 'SELECT * from forma where id_forma = ?';
           $params = [$this->id_forma];
           $result = $this->execQuery($sql, $params);

           return $result[0];
       }

       public function createForma()
       {
           $sql = 'INSERT into forma(forma) values (?)';
           $params = [$this->forma];
           $this->execStmt($sql, $params);
       }

       public function deleteForma()
       {
           $sql = 'DELETE from forma where id_forma = ?';
           $params = [$this->id_forma];
           $this->execStmt($sql, $params);
       }

       public function modifyForma()
       {
           $sql = 'UPDATE forma set forma = ? where id_forma = ?';
           $params = [$this->forma, $this->id_forma];
           $this->execStmt($sql, $params);
       }
   }
