<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/css/admin.css">

    <title>Login</title>
  </head>

  <body>
    <div class="sidenav">
      <div class="login-main-text">
        <h2>Aplicación<br>Inicio de Sesion</h2>
        <p>Inicia sesion para obtener acceso</p>
      </div>
    </div>
    <div class="main">

      <?php if (!empty($mensaje)): ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $mensaje; ?>
      </div>
      <?php endif; //Fin del if?>

      <div class="col-md-6 col-sm-12">
        <div class="login-form">
          <form action="login.php?action=login" method="POST">
            <div class="form-group">
              <label>Correo Electronico</label>
              <input type="text" class="form-control" placeholder="Nombre de usuario" name="correo">
            </div>
            <div class="form-group">
              <label>Contraseña</label>
              <input type="password" class="form-control" placeholder="Contraseña" name="contrasena">
            </div>
            <button type="submit" class="btn btn-black">Iniciar Sesión</button>
            <a class="btn" href="<?php echo HOST_BASE; ?>/admin/login/login.php?action=recuperar">Recuperar contraseña</a>
          </form>
        </div>
      </div>
    </div>
  </body>

</html>