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
                <h4 class="card-title">Elige el Rol y el Permiso que deseas asignarle a ese Rol</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action=<?php echo $script; ?> method="POST" enctype="multipart/form-data">

                <div class="card-body">
                  <div class="form-group">
                    <label for="rol">Rol</label>
                    <select name="id_rol" id="rol" class="form-control">
                      <?php foreach ($data['roles'] as $rol):?>
                      <option value="<?php echo $rol['id_rol']; ?>"><?php echo $rol['rol']; ?></option>
                      <?php endforeach; //Fin del ciclo foreach?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="permiso">Permiso a Asignar</label>
                    <select name="id_permiso" id="permiso" class="form-control">
                      <?php foreach ($data['permisos'] as $permiso):?>
                      <option value="<?php echo $permiso['id_permiso']; ?>"><?php echo $permiso['permiso']; ?></option>
                      <?php endforeach; //Fin del ciclo foreach?>
                    </select>
                  </div>

                  <button type="submit" class="btn btn-primary"><?php echo $boton; ?></button>
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

<?php include '../../views/footer.php'; ?>