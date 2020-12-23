<?php

define('HOST_BASE', 'http://localhost/PrograWeb/Optica');
require_once __DIR__.'/../password.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

    public function verificarLogin()
    {
        if (isset($_SESSION['validado'])) {
            header('Location: '.HOST_BASE.'/admin/dashboard/dashboard.php');
        }
    }

    /**
     * Hace una consulta a la base de datos para buscar las credenciales del usuario
     * Inicia una session.
     */
    public function validar($correo, $contrasena)
    {
        $contrasena = md5($contrasena);
        $this->connect();
        $_SESSION['validado'] = false;

        $sql = "SELECT id_usuario, correo, nombre, COALESCE(foto, 'no-foto.jpg') as foto from usuario where correo = ? and contrasena = ?";
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
        $stmt->execute([$id_usuario]);
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

    public function verificarToken($correo, $token)
    {
        if ($this->verificarCorreo($correo) && $token) {
            $this->connect();
            $sql = 'SELECT * from usuario where correo = ? and token = ?';

            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$correo, $token]);
            $datos = $stmt->fetch();

            $this->close();

            return $datos != null;
        }

        return false;
    }

    public function enviarCorreoRecuperacion($correo)
    {
        $token = $this->generateToken(16, $correo);
        $this->connect();

        try {
            //asignamos un token al usuario
            $sql = 'UPDATE usuario set token = ? where correo = ?';
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$token, $correo]);

            $sql = 'SELECT nombre from usuario where correo = ?';
            $usuario = $this->getUserAtributes($sql, $correo);
            $usuario = $usuario[0];
            $nombre = $usuario['nombre'];

            //Le mandamos el token por correo
            $vinculo = HOST_BASE."/admin/login/login.php?action=reestablecer&correo=$correo&token=$token";
            $mensaje = "
               <h1>Recuperación de contraseña</h1>
               <h2>Estimado $nombre:</h2> 
               <p>Se ha solicitado una recuperación de contraseña para su cuenta en Óptica Tovar</strong>. 
               Presione el siguiente vínculo para reestablecer una nueva contraseña:</p>
               <div align='center'>
                 <a href='$vinculo'>Reestablecer mi contraseña</a>
               </div>
               <p>Si usted no ha solicitado esta acción ignore este mensaje.</p>";

            $enviado = $this->envioCorreo($correo, $nombre, 'Recuperacion de contraseña', $mensaje);
            echo $enviado ? 'Se ha enviado un correo de recuperación. Por favor revisa tu correo. Puedes cerrar esta pestaña'
            : 'Upps tenemos problemas. Intentalo más tarde';
        } catch (\Throwable $th) {
            echo $th;
            die();
        }

        $this->close();
    }

    public function cambiarContrasena($correo, $nuevaContra)
    {
        $nuevaContra = md5($nuevaContra);
        $this->connect();
        $sql = 'UPDATE usuario SET contrasena = ?, token = null WHERE correo = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$nuevaContra, $correo]);
        $this->close();
    }

    public function envioCorreo($destino, $nombreDestino, $asunto, $mensaje)
    {
        require __DIR__.'/../../vendor/autoload.php';
        $mail = new PHPMailer();

        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->CharSet = PHPMailer::CHARSET_UTF8;
        $mail->Encoding = PHPMailer::ENCODING_QUOTED_PRINTABLE;

        $mail->Username = '17030801@itcelaya.edu.mx';
        $mail->Password = PASSWORD;
        $mail->setFrom('17030801@itcelaya.edu.mx', 'Fernando Acosta');

        $mail->addAddress($destino, $nombreDestino);

        $mail->Subject = $asunto;

        $mail->msgHTML($mensaje);

        return $mail->send();
    }

    public function logout()
    {
        session_destroy();
    }

    /**
     * generateToken.
     * Recibe una cadena y genera un token aleatorio de $longitud digitos a partir de ella.
     */
    private function generateToken($longitud, $cadena)
    {
        if ($longitud < 4) {
            $longitud = 4;
        }

        return substr(md5($cadena.sha1($cadena.'llavePrivada').rand(1, 10000)), 0, $longitud);
    }
}
$sistema = new Sistema();
