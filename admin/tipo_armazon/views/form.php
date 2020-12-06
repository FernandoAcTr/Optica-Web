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
                <h4 class="card-title">Llena los datos del tipo de armazon</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo $script; ?>" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="tipo_armazon">Tipo de Armazon</label>
                    <input type="text" class="form-control" id="tipo_armazon" name="tipo_armazon" value="<?php echo $data['tipo_armazon']; ?>" required>
                  </div>
                </div>
                <!-- /.card-body -->

                <?php if (is_numeric($id_tipo_armazon)): ?>
                <input type="hidden" value="<?php echo $data['id_tipo_armazon']; ?>" name="id_tipo_armazon">
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