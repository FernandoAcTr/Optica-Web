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
                <h4 class="card-title">Llena los datos de la venta</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo $script; ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label for="id_venta">ID de la venta</label>
                    <input type="text" class="form-control" id="id_venta" name="id_venta" value="<?php echo $data['id_venta']; ?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo substr($data['fecha'], 0, 10); ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control">
                      <?php foreach ($data['clientes'] as $cliente):?>
                      <option value="<?php echo $cliente['id_cliente']; ?>" <?php echo $cliente['id_cliente'] === $data['id_cliente'] ? 'selected' : ''; ?>>
                        <?php echo $cliente['nombre'].' '.$cliente['apellido']; ?></option>
                      <?php endforeach; //Fin del ciclo foreach?>
                    </select>
                  </div>

                  <fieldset>
                    <legend>Registrar producto</legend>

                    <div class="row justify-content-center">
                      <div class="col-sm-9">
                        <div class="form-group">
                          <label for="id_producto">Producto</label>
                          <select id="producto" class="form-control" onchange="obtenerProductoPrecio()">
                            <?php foreach ($data['productos'] as $producto):?>
                            <option value="<?php echo $producto['id_producto']; ?>">
                              <?php echo $producto['descripcion']; ?></option>
                            <?php endforeach; //Fin del ciclo foreach?>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-3">
                        <div class="form-group">
                          <label for="cantidad">Cantidad</label>
                          <input type="number" min="1" class="form-control" id="cantidad">
                        </div>
                      </div>

                      <p class="text-danger small d-none" id="advertencia">No hay suficientes unidades de este producto</p>

                      <input type="hidden" class="form-control" id="precio">

                    </div>

                    <div class="d-flex justify-content-end">
                      <button id="btn-registrar" class="btn btn-secondary">Registar Producto</button>
                    </div>
                  </fieldset>

                  <!-- Tabla de productos vendidos -->
                  <table class="table table-striped table-sm mt-3" id="table-purchase-products">
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
                      if (isset($data['vendidos'])):
                        $contador = 0;
                        foreach ($data['vendidos'] as $producto):?>
                      <tr>
                        <th scope="row"><?php echo ++$contador; ?></th>
                        <td><?php echo $producto['descripcion']; ?></td>
                        <input type="hidden" name="productos[<?php echo $producto['id_producto']; ?>][descripcion]"
                          value="<?php echo $producto['descripcion']; ?>">
                        <td><?php echo $producto['cantidad']; ?></td>
                        <input type="hidden" name="productos[<?php echo $producto['id_producto']; ?>][cantidad]" value="<?php echo $producto['cantidad']; ?>">
                        <td class="text-right"><?php echo $producto['precio']; ?></td>
                        <input type="hidden" name="productos[<?php echo $producto['id_producto']; ?>][precio]"
                          value="<?php echo $producto['precio']; ?>">
                        <td><button class='btn btn-sm btn-danger btn-eliminar' role='button'><i class="fas fa-trash-alt"></i></button></td>
                      </tr>
                      <?php
                        endforeach; //Fin del ciclo foreach
                      endif; //Fin del if?>
                    </tbody>
                  </table>

                  <!-- Resumen del total a pagar -->
                  <div class="d-flex justify-content-end mr-5">
                    <div class="mt-4 total-pago">
                      <div class="d-flex justify-content-between">
                        <p class="m-0">Subtotal: </p>
                        <p class="m-0" id="subtotal">$0.00</p>
                      </div>
                      <div class="d-flex justify-content-between">
                        <p class="m-0">IVA:</p>
                        <p class="m-0" id="IVA">$0.00</p>
                      </div>
                      <hr>
                      <div class="d-flex justify-content-between">
                        <p class="my-auto mr-3">Total a pagar: </p>
                        <p class="badge badge-info my-auto" id="total">$0.00</p>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <?php if (!empty($id_venta)): ?>
                <input type="hidden" value="<?php echo $data['id_venta']; ?>" name="id_venta">
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