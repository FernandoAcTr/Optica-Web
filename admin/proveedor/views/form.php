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
                <h4 class="card-title">Llena los datos del proveedor</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo $script; ?>" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="razon_social">Razon Social</label>
                    <input type="text" class="form-control" id="razon_social" name="razon_social" value="<?php echo $data['razon_social']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="rfc">RFC</label>
                    <input type="text" class="form-control" id="rfc" name="rfc" maxlength="13" value="<?php echo $data['rfc']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="domicilio">Domicilio</label>
                    <input type="text" class="form-control" id="domicilio" name="domicilio" value="<?php echo $data['domicilio']; ?>" required>
                  </div>
                  <div class="form-group">
                    <label for="domicilio">Telefono</label>
                    <input type="tel" class="form-control" id="domicilio" name="telefono" value="<?php echo $data['telefono']; ?>" maxlength="10">
                  </div>
                </div>
                <!-- /.card-body -->

                <?php if (is_numeric($id_proveedor)): ?>
                <input type="hidden" value="<?php echo $data['id_proveedor']; ?>" name="id_proveedor">
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