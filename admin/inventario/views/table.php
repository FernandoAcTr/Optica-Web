<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Inventario</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás el inventario de todos los productos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>
                        <!--Foto-->
                      </th>
                      <th>Producto</th>
                      <th>Stock</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data as $row):?>
                    <tr>
                      <td class="p-0 text-center w-25"><img src="../../img/productos/<?php echo $row['foto']; ?>" alt="Imagen del producto" height="75"></td>
                      <td><?php echo $row['descripcion']; ?></td>
                      <td><?php echo $row['stock']; ?></td>
                    </tr>
                    <?php endforeach; //Fin del ciclo foreach?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>
                        <!--Foto-->
                      </th>
                      <th>Producto</th>
                      <th>Stock</th>
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