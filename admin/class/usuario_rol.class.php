<?php

  include_once 'database.class.php';

   class UsuarioRol extends Database
   {
       private $id_usuario;
       private $id_rol;

       //seters
       public function setIdUsuario($id_usuario)
       {
           $this->id_usuario = $id_usuario;
       }

       public function setIdRol($id_rol)
       {
           $this->id_rol = $id_rol;
       }

       /*
       Asigna un rol a un usuario
       */
       public function asignarRol()
       {
           $this->connect();
           try {
               $sql = 'INSERT into usuario_rol(id_usuario, id_rol) values (?,?)';
               $stmt = $this->conn->prepare($sql);
               $stmt->bindParam(1, $this->id_usuario);
               $stmt->bindParam(2, $this->id_rol);
               $stmt->execute();
           } catch (\Throwable $th) {
               throw $th;
           }

           $this->close();
       }

       /*
        Obtener un arreglo con todos los roles asignados a los usuarios
       */
       public function fetchAll()
       {
           $this->connect();
           $datos = null;

           try {
               $sql = 'SELECT ur.id_usuario, ur.id_rol, u.correo as usuario, r.rol FROM usuario_rol ur 
            JOIN usuario u on u.id_usuario = ur.id_usuario 
            JOIN rol r on r.id_rol = ur.id_rol 
            order by ur.id_usuario, ur.id_rol';
               $resultado = $this->conn->query($sql);
               $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }
           $this->close();

           return $datos;
       }

       /** Quitar rol a un usuario */
       public function quitarRol()
       {
           $this->connect();
           try {
               $sql = 'DELETE from usuario_rol where id_usuario = ? and id_rol = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->id_usuario, $this->id_rol]);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }
   }
