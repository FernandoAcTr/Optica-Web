<?php

define('HOST_BASE', 'http://localhost/PrograWeb/Optica');

class Sistema extends Database
{
    public function verificarPermiso($permiso)
    {
        if (!isset($_SESSION['validado'])) {
            header('Location: '.HOST_BASE.'/admin/login/login.php');
        }

        $hasPermission = false;
        if ($_SESSION['validado']) {
            foreach ($_SESSION['permiso'] as $p) {
                if ($p['permiso'] == $permiso) {
                    $hasPermission = true;
                }
            }
        }

        if (!$hasPermission) {
            header('Location: '.HOST_BASE.'/admin/forbidden/forbidden.php');
            die();
        }
    }

    public function validar($correo, $contrasena)
    {
        $contrasena = md5($contrasena);
        $this->connect();
        $_SESSION['validado'] = false;

        $sql = 'SELECT id_usuario, correo, nombre, foto from usuario where correo = ? and contrasena = ?';
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$correo, $contrasena]);
        $fila = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($fila != null) {
            $_SESSION['validado'] = true;
            $_SESSION['id_usuario'] = $fila['id_usuario'];
            $_SESSION['correo'] = $fila['correo'];
            $_SESSION['nombre'] = $fila['nombre'];
            $_SESSION['foto'] = $fila['foto'];

            //obtener todos los roles del usuario
            $sql = 'SELECT r.id_rol, r.rol FROM rol r 
                JOIN usuario_rol ur on ur.id_rol = r.id_rol
                WHERE ur.id_usuario = ?;';

            $roles = $this->getUserAtributes($sql, $fila['id_usuario']);
            $_SESSION['rol'] = $roles;

            //obtener todos los permisos del usuario, con base en sus roles
            $sql = 'SELECT p.permiso, p.id_permiso
                FROM permiso p
                JOIN rol_permiso rp on rp.id_permiso = p.id_permiso
                JOIN rol r on r.id_rol = rp.id_rol
                JOIN usuario_rol ur on r.id_rol = ur.id_rol
                WHERE ur.id_usuario = ?';

            $permisos = $this->getUserAtributes($sql, $fila['id_usuario']);
            $_SESSION['permiso'] = $permisos;

            return true;
        }

        $this->close();

        return false;
    }

    /**
     * Obtiene los roles o permisos de un usuario, dependiendo la consulta que se le mande.
     * Este es un metodo interno de la clase.
     */
    private function getUserAtributes($sql, $id_usuario)
    {
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(1, $id_usuario);
        $stmt->execute();
        $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $registros;
    }

    /**
     * Verifica que exista un correo registrado en la base de datos.
     */
    public function verificarCorreo($correo)
    {
        $this->connect();
        $sql = 'SELECT * from usuario where correo = ?';
        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$correo]);
        $datos = $stmt->fetch();

        $this->close();

        return $datos != null;
    }

    public function logout()
    {
        session_destroy();
    }
}
$sistema = new Sistema();
