<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4"><?php echo $titulo; ?></h3>

        <div class="row">
          <div class="col-md-12">
            <!-- Formulario de Proveedor -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Llena los datos del cliente</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo $script; ?>" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="id_cliente">ID Cliente</label>
                    <input type="text" class="form-control" id="id_cliente" name="id_cliente" value="<?php echo $data['id_cliente']; ?>" readonly>
                  </div>
                  <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="apellido">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" maxlength="13" value="<?php echo $data['apellido']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="calle">Calle</label>
                    <input type="text" class="form-control" id="calle" name="calle" value="<?php echo $data['calle']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="colonia">Colonia</label>
                    <input type="text" class="form-control" id="colonia" name="colonia" value="<?php echo $data['colonia']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="ciudad">Ciudad</label>
                    <input type="text" class="form-control" id="ciudad" name="ciudad" value="<?php echo $data['ciudad']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="cod_postal">Código Postal</label>
                    <input type="text" class="form-control" id="cod_postal" name="cod_postal" value="<?php echo $data['cod_postal']; ?>" maxlength="6">
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $data['email']; ?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <?php if (!empty($id_cliente)): ?>
                <input type="hidden" value="<?php echo $data['id_cliente']; ?>" name="id_cliente">
                <?php endif; //Fin del if?>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
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

<?php include '../views/footer.php'; ?>