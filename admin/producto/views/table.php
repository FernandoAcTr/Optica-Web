<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4">Productos</h3>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">En esta página encontrarás la informacón de todos los productos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabla" class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>
                        <!--foto-->
                      </th>
                      <th>Descripción</th>
                      <th>Tipo</th>
                      <th>Marca</th>
                      <th>Categoria</th>
                      <th>Forma</th>
                      <th>Precio</th>
                      <th>
                        <!--acciones-->
                      </th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php foreach ($data as $row):?>
                    <tr>
                      <td class="p-0 text-center"><img src="../../productos/<?php echo $row['foto']; ?>" alt="Imagen del producto" height="75"></td>
                      <td><?php echo $row['descripcion']; ?></td>
                      <td><?php echo $row['tipo_armazon']; ?></td>
                      <td><?php echo $row['marca']; ?></td>
                      <td><?php echo $row['categoria']; ?></td>
                      <td><?php echo $row['forma']; ?></td>
                      <td><?php echo $row['precio']; ?></td>
                      <td class="text-center">
                        <a href="producto.php?action=delete&id_producto=<?php echo $row['id_producto']; ?>" class='btn btn-danger' role='button'><i
                            class="fas fa-trash-alt"></i></a>
                        <a href="producto.php?action=form&id_producto=<?php echo $row['id_producto']; ?>" class='btn btn-secondary' role='button'><i
                            class="far fa-edit"></i></a>
                      </td>
                    </tr>
                    <?php endforeach; //Fin del ciclo foreach?>

                  </tbody>
                  <tfoot>
                    <tr>
                      <th>
                        <!--foto-->
                      </th>
                      <th>Descripción</th>
                      <th>Tipo</th>
                      <th>Marca</th>
                      <th>Categoria</th>
                      <th>Forma</th>
                      <th>Precio</th>
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