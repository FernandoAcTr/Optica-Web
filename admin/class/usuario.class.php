<?php

  include_once 'database.class.php';

   class Usuario extends Database
   {
       private $id_usuario;
       private $correo;
       private $nombre;
       private $foto;
       private $contrasena;

       //seters
       public function setIdUsuario($id_usuario)
       {
           $this->id_usuario = $id_usuario;
       }

       public function setCorreo($correo)
       {
           $this->correo = $correo;
       }

       public function setNombre($nombre)
       {
           $this->nombre = $nombre;
       }

       public function setFoto($foto)
       {
           $this->foto = $foto;
       }

       public function setContrasena($contrasena)
       {
           $this->contrasena = $contrasena;
       }

       private function encriptarContrasena()
       {
           $this->contrasena = $this->contrasena ? md5($this->contrasena) : '';
       }

       /*
       Crear un usuario
       */
       public function createUsuario()
       {
           $plainTextPassword = $this->contrasena;
           $this->encriptarContrasena();

           $this->connect();
           $this->conn->beginTransaction();
           try {
               //insertar el nuevo usuario
               $nombreFoto = $this->uploadPicture();
               if ($nombreFoto) {
                   $sql = 'INSERT into usuario(correo, nombre, contrasena, foto) values (?,?,?,?)';
                   $stmt = $this->conn->prepare($sql);
                   $stmt->execute([$this->correo, $this->nombre, $this->contrasena, $nombreFoto]);
               } else {
                   $sql = 'INSERT into usuario(correo, nombre, contrasena) values (?,?,?)';
                   $stmt = $this->conn->prepare($sql);
                   $stmt->execute([$this->correo, $this->nombre, $this->contrasena]);
               }

               //obtener el id del usuario que se inserto
               $sql = 'SELECT id_usuario from usuario where correo = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->correo]);
               $usuario = $stmt->fetch();

               //darle el rol de empleado que tiene permiso de index
               $sql = 'INSERT into usuario_rol(id_usuario, id_rol) values (?,?)';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$usuario['id_usuario'], 4]);

               //enviar correo con sus credenciales
               $mensaje = "
               <h1>Activación de Cuenta</h1>
               <h2>Estimado $this->nombre:</h2> 
               <p>Se ha activado su cuenta para el sistema <strong>Optica Tovar</strong>. 
               Presione la siguiente imagen para ir al panel de administración</p>
               <div align='center'>
                 <a href='".HOST_BASE."/admin/login/login.php'>
                    <img src='".HOST_BASE."/assets/img/logo.png' height='100'>
                 </a>
               </div>
               <p>Sus credenciales de acceso son:</p>
               <p><b>Usuario:</b> $this->correo </p>
               <p><b>Contraseña:</b> $plainTextPassword </p>";

               $sistema = new Sistema();
               $sistema->envioCorreo($this->correo, $this->nombre, 'Se ha creado una nueva cuenta para usted', $mensaje);
               $this->conn->commit();
           } catch (\Throwable $th) {
               $this->conn->rollback();
               echo $th;
               die();
           }

           $this->close();
       }

       /** Eliminar un usuario  */
       public function deleteUsuario()
       {
           $usuario = $this->readOneUsuario();
           $this->connect();
           try {
               $sql = 'DELETE from usuario where id_usuario = ?';
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->id_usuario]);

               if (strcmp($usuario['foto'], 'no-foto.jpg') != 0) {
                   $this->deletePicture($usuario['foto']);
               }
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }

       /*Modifica un uaurio */
       public function modifyUsuario()
       {
           $this->connect();
           try {
               $this->encriptarContrasena();
               $nombreFoto = $this->uploadPicture();
               if ($this->contrasena) {
                   if ($nombreFoto) {
                       $sql = 'UPDATE usuario set correo = ?, contrasena = ?, nombre = ?, foto = ? where id_usuario = ?';
                       $stmt = $this->conn->prepare($sql);
                       $stmt->bindParam(1, $this->correo);
                       $stmt->bindParam(2, $this->contrasena);
                       $stmt->bindParam(3, $this->nombre);
                       $stmt->bindParam(4, $nombreFoto);
                       $stmt->bindParam(5, $this->id_usuario);
                   } else {
                       $sql = 'UPDATE usuario set correo = ?, contrasena = ?, nombre = ? where id_usuario = ?';
                       $stmt = $this->conn->prepare($sql);
                       $stmt->bindParam(1, $this->correo);
                       $stmt->bindParam(2, $this->contrasena);
                       $stmt->bindParam(3, $this->nombre);
                       $stmt->bindParam(4, $this->id_usuario);
                   }
               } else {
                   if ($nombreFoto) {
                       $sql = 'UPDATE usuario set correo = ?, nombre = ?, foto = ?  where id_usuario = ?';
                       $stmt = $this->conn->prepare($sql);
                       $stmt->bindParam(1, $this->correo);
                       $stmt->bindParam(2, $this->nombre);
                       $stmt->bindParam(3, $nombreFoto);
                       $stmt->bindParam(4, $this->id_usuario);
                   } else {
                       $sql = 'UPDATE usuario set correo = ?, nombre = ?  where id_usuario = ?';
                       $stmt = $this->conn->prepare($sql);
                       $stmt->bindParam(1, $this->correo);
                       $stmt->bindParam(2, $this->nombre);
                       $stmt->bindParam(3, $this->id_usuario);
                   }
               }
               $stmt->execute();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();
       }

       /*
       Obtener un arreglo con todos los usuarios
       */
       public function fetchAll()
       {
           $this->connect();
           $datos = null;
           try {
               $sql = "SELECT id_usuario, correo, nombre, COALESCE(foto, 'no-foto.jpg') as foto FROM usuario";
               $resultado = $this->conn->query($sql);
               $datos = $resultado->fetchAll(PDO::FETCH_ASSOC);
           } catch (\Throwable $th) {
               echo $th;
               die();
           }
           $this->close();

           return $datos;
       }

       public function readOneUsuario()
       {
           $this->connect();
           $fila = null;

           try {
               $sql = "SELECT id_usuario, correo, nombre, COALESCE(foto, 'no-foto.jpg') as foto FROM usuario where id_usuario = ?";
               $stmt = $this->conn->prepare($sql);
               $stmt->execute([$this->id_usuario]);
               $fila = $stmt->fetch();
           } catch (\Throwable $th) {
               echo $th;
               die();
           }

           $this->close();

           return $fila;
       }

       private function uploadPicture()
       {
           if ($this->foto['name']) {
               $type = explode('/', $this->foto['type'])[1];
               $permitidos = ['jpg', 'png', 'jpeg'];

               if (!in_array($type, $permitidos)) {
                   return null;
               }

               $nombreLimpio = uniqid().'.'.$type;

               if (move_uploaded_file($this->foto['tmp_name'], __DIR__.'/../../img/usuarios/'.$nombreLimpio)) {
                   return $nombreLimpio;
               }
           }

           return null;
       }

       private function deletePicture($name)
       {
           try {
               unlink(__DIR__.'/../../img/usuarios/'.$name);
           } catch (\Throwable $th) {
           }
       }
   }