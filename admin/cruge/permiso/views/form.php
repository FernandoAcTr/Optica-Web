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
                <h4 class="card-title">Llena los datos del Permiso</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action=<?php echo $script; ?> method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="form-group">
                    <label for="permiso">Permiso</label>
                    <input type="text" class="form-control" id="permiso" name="permiso" value="<?php echo $data['permiso']; ?>">
                  </div>
                  <button type="submit" class="btn btn-primary"><?php echo $boton; ?></button>
                </div>

                <?php if (isset($id_permiso)): ?>
                <input type="hidden" name="id_permiso" value="<?php echo $id_permiso; ?>">
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