<?php include '../../views/header.php'; ?>
<?php include '../../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4"><?php echo $title; ?></h3>

        <div class="row">
          <div class="col-md-12">
            <!-- Formulario de Proveedor -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Llena los datos del Usuario</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action=<?php echo $script; ?> method="POST" enctype="multipart/form-data">

                <div class="card-body">
                  <div class="form-group m-0">
                    <label for="correo">Correo</label>
                    <input required type="text" class="form-control" id="correo" name="correo" value="<?php echo $data['correo']; ?>">
                  </div>
                  <small id="email_help" class="form-text text-red mt-0 mb-3"></small>

                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input required type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>">
                  </div>

                  <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input type="password" class="form-control" id="contrasena" name="contrasena" <?php echo isset($id_usuario) ? '' : 'required'; ?>>
                  </div>

                  <div class="form-group m-0">
                    <label for="rep_contrasena">Repetir Contraseña</label>
                    <input type="password" class="form-control" id="rep_contrasena" name="rep_contrasena" <?php echo isset($id_usuario) ? '' : 'required'; ?>>
                  </div>
                  <small id="password_help" class="form-text text-red mt-0 mb-3"></small>

                  <div class="form-group">
                    <label for="foto">Fotografia</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                  </div>

                  <button type="submit" class="btn btn-primary" id="guardar"><?php echo $boton; ?></button>
                </div>

                <?php if (isset($id_usuario)): ?>
                <input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
                <?php endif; //Fin del if?>

              </form>
              <!-- Form end -->
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </main>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<?php include '../../views/footer.php'; ?>