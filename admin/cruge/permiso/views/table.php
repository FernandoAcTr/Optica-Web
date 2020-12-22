<?php include '../../views/header.php'; ?>
<?php include '../../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Permisos</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás la informacón de todos los permisos que se pueden asignar a un rol</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Permiso</th>
                      <th scope="col">
                        <!--botones-->
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $resultado => $fila):?>
                    <tr>
                      <td><?php echo $fila['permiso']; ?></td>
                      <td class="text-center">
                        <a href="permiso.php?id_permiso=<?php echo $fila['id_permiso']; ?>&action=delete" class='btn btn-danger' role='button'><i
                            class="fas fa-trash-alt"></i></a>
                        <a href="permiso.php?id_permiso=<?php echo $fila['id_permiso']; ?>&action=form" class='btn btn-secondary' role='button'><i
                            class="far fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php endforeach;
                    //Fin del ciclo while?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th scope="col">Permiso</th>
                      <th scope="col">
                        <!--botones-->
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

<?php include '../../views/footer.php'; ?>