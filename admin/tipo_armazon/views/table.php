<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Tipos de Armazones</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás la informacón de los tipos de armazones</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>Tipo de Armazon</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data as $row):?>
                    <tr>
                      <td><?php echo $row['tipo_armazon']; ?></td>
                      <td class="text-center">
                        <a href="tipo_armazon.php?action=delete&id_tipo_armazon=<?php echo $row['id_tipo_armazon']; ?>" class='btn btn-danger' role='button'><i
                            class="fas fa-trash-alt"></i></a>
                        <a href="tipo_armazon.php?action=form&id_tipo_armazon=<?php echo $row['id_tipo_armazon']; ?>" class='btn btn-secondary' role='button'><i
                            class="far fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; //Fin del ciclo foreach?>


                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Tipo de Armazon</th>
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