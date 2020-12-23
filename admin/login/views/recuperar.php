<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/css/admin.css">

    <title>Recuperar Contraseña</title>
  </head>

  <body>

    <div class="sidenav">
      <div class="login-main-text">
        <h2>Recuperar<br>Contraseña</h2>
        <p>Ingresa tu correo para recuperar tu contraseña</p>
      </div>
    </div>
    <div class="main">

      <div class="col-md-6 col-sm-12">
        <div class="login-form">
          <form action="login.php?action=correoRecueperacion" method="POST">
            <div class="form-group">
              <label>Correo Electronico</label>
              <input type="text" class="form-control" placeholder="Nombre de usuario" name="correo">
            </div>
            <button type="submit" class="btn btn-black">Enviar correo de recuperación</button>
          </form>
        </div>
      </div>
    </div>
  </body>

</html>