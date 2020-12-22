<?php

  include_once 'database.class.php';

   class RolPermiso extends Database
   {
       private $id_permiso;
       private $id_rol;

       //seters
       public function setIdPermiso($id_permiso)
       {
           $this->id_permiso = $id_permiso;
       }

       public function setIdRol($id_rol)
       {
           $this->id_rol = $id_rol;
       }

       /*
       Asigna un permiso a un rol
       */
       public function asignarPermiso()
       {
           $this->connect();
           try {
               $sql = 'INSERT into rol_permiso(id_rol, id_permiso) values (?,?)';
               $stmt = $this->conn->prepare($sql);

               $stmt->bindParam(1, $this->id_rol);
               $stmt->bindParam(2, $this->id_permiso);

               $stmt->execute();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }

       /*
        Obtener un arreglo con todos los permisos asignados a los roles
       */
       public function fetchAll()
       {
           $this->connect();
           $datos = null;

           try {
               $sql = 'SELECT rp.id_permiso, rp.id_rol, r.rol, p.permiso   FROM rol_permiso rp 
            JOIN rol r on r.id_rol = rp.id_rol 
            JOIN permiso p on p.id_permiso = rp.id_permiso
            ORDER by rp.id_rol, rp.id_permiso';

               $resultado = $this->conn->query($sql);
               $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();

           return $datos;
       }

       /** Quitar permiso a un rol */
       public function quitarPermiso()
       {
           $this->connect();
           try {
               $sql = 'DELETE from rol_permiso where id_permiso = ? and id_rol = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->id_permiso, $this->id_rol]);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }
   }
