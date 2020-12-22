<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <h3 class="mb-4"><?php echo $titulo; ?></h3>

        <div class="row">
          <div class="col-md-12">
            <!-- Formulario de Proveedor -->
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">Llena los datos de la compra</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo $script; ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label for="folio">Folio</label>
                    <input type="text" class="form-control" id="folio" name="folio" value="<?php echo $data['folio']; ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $data['fecha']; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="id_proveedor">Proveedor</label>
                    <select name="id_proveedor" id="id_proveedor" class="form-control">
                      <?php foreach ($data['proveedores'] as $proveedor):?>
                      <option value="<?php echo $proveedor['id_proveedor']; ?>"
                        <?php echo $proveedor['id_proveedor'] === $data['id_proveedor'] ? 'selected' : ''; ?>>
                        <?php echo $proveedor['razon_social']; ?></option>
                      <?php endforeach; //Fin del ciclo foreach?>
                    </select>
                  </div>
                  <fieldset>
                    <legend>Registrar producto</legend>

                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="id_producto">Producto</label>
                          <select id="producto" class="form-control">
                            <?php foreach ($data['productos'] as $producto):?>
                            <option value="<?php echo $producto['id_producto']; ?>">
                              <?php echo $producto['descripcion']; ?></option>
                            <?php endforeach; //Fin del ciclo foreach?>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="cantidad">Cantidad</label>
                          <input type="number" min="1" class="form-control" id="cantidad">
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="precio">Precio de Proveedor (x pieza)</label>
                          <input type="text" class="form-control" id="precio">
                        </div>
                      </div>
                    </div>

                    <div class="d-flex justify-content-end">
                      <button id="btn-registrar" class="btn btn-secondary">Registar Producto</button>
                    </div>
                  </fieldset>

                  <!-- Tabla de productos comprados -->
                  <table class="table table-striped table-sm mt-3" id="table-products">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Precio Unitario</th>
                        <th scope="col">
                          <!--Boton-->
                        </th>
                      </tr>
                    </thead>
                    <tbody id="table-body">
                      <!-- Se insertan tr dinamicos con javascript -->
                      <?php
                      if (isset($data['comprados'])):
                        $contador = 0;
                        foreach ($data['comprados'] as $producto):?>
                        <tr>
                          <th scope="row"><?php echo ++$contador; ?></th>
                          <td><?php echo $producto['descripcion']; ?></td>
                          <input type="hidden" name="productos[<?php echo $producto['id_producto']; ?>][descripcion]" value="<?php echo $producto['descripcion']; ?>">
                          <td><?php echo $producto['cantidad']; ?></td>
                          <input type="hidden" name="productos[<?php echo $producto['id_producto']; ?>][cantidad]" value="<?php echo $producto['cantidad']; ?>">
                          <td><?php echo $producto['precio_proveedor']; ?></td>
                          <input type="hidden" name="productos[<?php echo $producto['id_producto']; ?>][precio]" value="<?php echo $producto['precio_proveedor']; ?>">
                          <td><button class='btn btn-sm btn-danger btn-eliminar' role='button'><i class="fas fa-trash-alt"></i></button></td>
                        </tr>
                        <?php
                        endforeach; //Fin del ciclo foreach
                      endif; //Fin del if?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->

                <?php if (is_numeric($id_compra)): ?>
                <input type="hidden" value="<?php echo $data['id_compra']; ?>" name="id_compra">
                <?php endif; //Fin del if?>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
              <!-- Form end -->

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