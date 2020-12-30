<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Ventas</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás la informacón de todas las ventas realizadas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID Venta</th>
                      <th>Fecha</th>
                      <th>Cliente</th>
                      <th>Status</th>
                      <th>Tipo</th>
                      <th>
                        <!--acciones-->
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data as $row):?>
                    <tr>
                      <td><?php echo $row['id_venta']; ?></td>
                      <td><?php echo $row['fecha']; ?></td>
                      <td>
                        <a href="../cliente/cliente.php?action=form&id_cliente=<?php echo $row['id_cliente'] ?>"><?php echo $row['cliente']; ?></a>
                      </td>
                      <td><?php echo $row['status']; ?></td>
                      <td><?php echo $row['tipo']; ?></td>
                      <td class="text-center">
                        <a href="venta.php?action=delete&id_venta=<?php echo $row['id_venta']; ?>" class='btn btn-danger' role='button'><i
                            class="fas fa-trash-alt"></i></a>
                        <a href="venta.php?action=form&id_venta=<?php echo $row['id_venta']; ?>" class='btn btn-secondary' role='button'><i
                            class="far fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; //Fin del ciclo foreach?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID Venta</th>
                      <th>Fecha</th>
                      <th>Cliente</th>
                      <th>Status</th>
                      <th>Tipo</th>
                      <th>
                        <!--acciones-->
                      </th>
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