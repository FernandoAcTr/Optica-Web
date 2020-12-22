<?php include '../../views/header.php'; ?>
<?php include '../../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Roles</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás la informacón de todos los roles que se pueden asignar a un usuario</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Rol</th>
                      <th scope="col">
                        <!--botones-->
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $resultado => $fila):?>
                    <tr>
                      <td><?php echo $fila['rol']; ?></td>
                      <td class="text-center">
                        <a href="rol.php?id_rol=<?php echo $fila['id_rol']; ?>&action=delete" class='btn btn-danger' role='button'><i
                            class="fas fa-trash-alt"></i></a>
                        <a href="rol.php?id_rol=<?php echo $fila['id_rol']; ?>&action=form" class='btn btn-secondary' role='button'><i
                            class="far fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php endforeach;
                    //Fin del ciclo foreach?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th scope="col">Rol</th>
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