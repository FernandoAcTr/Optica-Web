<?php

  include_once 'database.class.php';

   class Permiso extends Database
   {
       private $id_permiso;
       private $permiso;

       //geters
       public function getIdPermiso()
       {
           return $this->id_permiso;
       }

       public function getNombre()
       {
           return $this->$nombre;
       }

       //seters
       public function setIdPermiso($id_permiso)
       {
           $this->id_permiso = $id_permiso;
       }

       public function setPermiso($permiso)
       {
           $this->permiso = $permiso;
       }

       /*
       Crear un permiso
       */
       public function createPermiso()
       {
           $this->connect();
           try {
               $sql = 'INSERT into permiso(permiso) values (?)';
               $stmt = $this->conn->prepare($sql);
               $stmt->bindParam(1, $this->permiso);
               $stmt->execute();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }

       /*
        Obtener un arreglo con todos los permisos
       */
       public function fetchAll()
       {
           $this->connect();
           $datos = null;

           try {
               $sql = 'SELECT * FROM permiso';
               $resultado = $this->conn->query($sql);
               $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();

           return $datos;
       }

       /** Eliminar un permiso  */
       public function deletePermiso()
       {
           $this->connect();
           try {
               $sql = 'DELETE from permiso where id_permiso = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->id_permiso]);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }

       /*Modifica un permiso */
       public function modifyPermiso()
       {
           $this->connect();
           try {
               $sql = 'UPDATE permiso set permiso = ? where id_permiso = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->bindParam(1, $this->permiso);
               $stmt->bindParam(2, $this->id_permiso);
               $stmt->execute();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }

       public function readOnePermiso()
       {
           $this->connect();
           $fila = null;

           try {
               $sql = 'SELECT * from permiso where id_permiso = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->id_permiso]);
               $fila = $stmt->fetch();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();

           return $fila;
       }
   }
