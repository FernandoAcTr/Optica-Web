<?php include '../../views/header.php'; ?>
<?php include '../../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Asignación de Permisos</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página podrás asignar y quitar permisos a un rol</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th scope="col">Rol</th>
                      <th scope="col">Permiso</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $resultado => $fila):?>
                    <tr>
                      <td><?php echo $fila['rol']; ?></td>
                      <td><?php echo $fila['permiso']; ?></td>
                      <td class="text-center"><a href="rol_permiso.php?id_permiso=<?php echo $fila['id_permiso']; ?>&id_rol=<?php echo $fila['id_rol']; ?>&action=delete"
                          class='btn btn-danger' role='button'><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                    <?php endforeach;
                    //Fin del ciclo while?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th scope="col">Rol</th>
                      <th scope="col">Permiso</th>
                      <th scope="col"></th>
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