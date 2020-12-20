<?php

   include_once 'database.class.php';

   class Categoria extends Database
   {
       private $id_categoria;
       private $categoria;

       public function setIdCategoria($id_categoria)
       {
           $this->id_categoria = $id_categoria;
       }

       public function setCategoria($categoria)
       {
           $this->categoria = $categoria;
       }

       /**
        * fetchAll.
        * Regresa una lista de todas las categorias
        */
       public function fetchAll()
       {
           $sql = 'SELECT * from categoria';
           $categorias = $this->execQuery($sql, null);

           return $categorias;
       }

       public function readOneCategoria()
       {
           $sql = 'SELECT * from categoria where id_categoria = ?';
           $params = [$this->id_categoria];
           $result = $this->execQuery($sql, $params);

           return $result[0];
       }

       public function createCategoria()
       {
           $sql = 'INSERT into categoria(categoria) values (?)';
           $params = [$this->categoria];
           $this->execStmt($sql, $params);
       }

       public function deleteCategoria()
       {
           $sql = 'DELETE from categoria where id_categoria = ?';
           $params = [$this->id_categoria];
           $this->execStmt($sql, $params);
       }

       public function modifyCategoria()
       {
           $sql = 'UPDATE categoria set categoria = ? where id_categoria = ?';
           $params = [$this->categoria, $this->id_categoria];
           $this->execStmt($sql, $params);
       }
   }
