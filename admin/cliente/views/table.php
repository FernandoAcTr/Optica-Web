<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Clientes registrados</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás todos los clientes que se han registrado al hacer una compra</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>ID del Cliente</th>
                      <th>Nombre</th>
                      <th>Calle</th>
                      <th>Colonia</th>
                      <th>Ciudad</th>
                      <th>Codigo Postal</th>
                      <th>Email</th>
                      <th>Tipo</th>
                      <th><!--Botones--></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data as $row):?>
                    <tr>
                      <td><?php echo $row['id_cliente']; ?></td>
                      <td><?php echo $row['nombre'].' '.$row['apellido']; ?></td>
                      <td><?php echo $row['calle']; ?></td>
                      <td><?php echo $row['colonia']; ?></td>
                      <td><?php echo $row['ciudad']; ?></td>
                      <td><?php echo $row['cod_postal']; ?></td>
                      <td><?php echo $row['email']; ?></td>
                      <td><?php echo $row['tipo']; ?></td>
                      <td class="text-center">
                        <a href="cliente.php?action=delete&id_cliente=<?php echo $row['id_cliente']; ?>" class='btn btn-danger' role='button'><i
                            class="fas fa-trash-alt"></i></a>
                        <a href="cliente.php?action=form&id_cliente=<?php echo $row['id_cliente']; ?>" class='btn btn-secondary' role='button'><i
                            class="far fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; //Fin del ciclo foreach?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>ID del Cliente</th>
                      <th>Nombre</th>
                      <th>Calle</th>
                      <th>Colonia</th>
                      <th>Ciudad</th>
                      <th>Codigo Postal</th>
                      <th>Email</th>
                      <th>Tipo</th>
                      <th><!--Botones--></th>
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