<?php include '../../views/header.php'; ?>
<?php include '../../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Usuarios</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás la informacón de todos los usuarios del sistema</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th scope="col">
                        <!--foto-->
                      </th>
                      <th scope="col">Correo</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">
                        <!--Botones-->
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($data as $resultado => $fila):?>
                    <tr>
                      <td class="p-0 text-center"><img src="../../../img/usuarios/<?php echo $fila['foto']; ?>" alt="Imagen de perfil" height="100" class="rounded-circle"></td>
                      <td><?php echo $fila['correo']; ?></td>
                      <td><?php echo $fila['nombre']; ?></td>
                      <td class="text-center">
                        <a href="usuario.php?id_usuario=<?php echo $fila['id_usuario']; ?>&action=delete" class='btn btn-danger' role='button'><i
                            class="fas fa-trash-alt"></i></a>
                        <a href="usuario.php?id_usuario=<?php echo $fila['id_usuario']; ?>&action=form" class='btn btn-secondary' role='button'><i
                            class="far fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php endforeach;
         //Fin del ciclo foreach?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th scope="col">
                        <!--foto-->
                      </th>
                      <th scope="col">Correo</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">
                        <!--Botones-->
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