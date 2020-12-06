<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Proveedores</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás la informacón de todos los proveedores</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Razon Social</th>
                      <th>RFC</th>
                      <th>Domicilio</th>
                      <th>Teléfono</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data as $row):?>
                    <tr>
                      <td><?php echo $row['razon_social']; ?></td>
                      <td><?php echo $row['rfc']; ?></td>
                      <td><?php echo $row['domicilio']; ?></td>
                      <td><?php echo $row['telefono']; ?></td>
                      <td class="text-center">
                        <a href="proveedor.php?action=delete&id_proveedor=<?php echo $row['id_proveedor']; ?>" class='btn btn-danger' role='button'><i
                            class="fas fa-trash-alt"></i></a>
                        <a href="proveedor.php?action=form&id_proveedor=<?php echo $row['id_proveedor']; ?>" class='btn btn-secondary' role='button'><i
                            class="far fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; //Fin del ciclo foreach?>


                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Razon Social</th>
                      <th>RFC</th>
                      <th>Domicilio</th>
                      <th>Teléfono</th>
                      <th></th>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
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