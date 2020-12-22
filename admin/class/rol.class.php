<?php

  include_once 'database.class.php';

   class Rol extends Database
   {
       private $id_rol;
       private $rol;

       //seters
       public function setIdRol($id_rol)
       {
           $this->id_rol = $id_rol;
       }

       public function setRol($rol)
       {
           $this->rol = $rol;
       }

       /*
       Crear un rol
       */
       public function createRol()
       {
           $this->connect();
           try {
               $sql = 'INSERT into rol(rol) values (?)';
               $stmt = $this->conn->prepare($sql);
               $stmt->bindParam(1, $this->rol);
               $stmt->execute();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }
           $this->close();
       }

       /*
        Obtener un arreglo con todos los roles
       */
       public function fetchAll()
       {
           $this->connect();
           $datos = null;

           try {
               $sql = 'SELECT * FROM rol';
               $resultado = $this->conn->query($sql);
               $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();

           return $datos;
       }

       /** Eliminar un rol  */
       public function deleteRol()
       {
           $this->connect();
           try {
               $sql = 'DELETE from rol where id_rol = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->id_rol]);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }

       /*Modifica un rol */
       public function modifyRol()
       {
           $this->connect();
           try {
               $sql = 'UPDATE rol set rol = ? where id_rol = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->bindParam(1, $this->rol);
               $stmt->bindParam(2, $this->id_rol);
               $stmt->execute();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }
           $this->close();
       }

       public function readOneRol()
       {
           $this->connect();
           $fila = null;

           try {
               $sql = 'SELECT * from rol where id_rol = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->id_rol]);
               $fila = $stmt->fetch();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }
           $this->close();

           return $fila;
       }
   }
