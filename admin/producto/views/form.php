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
                <h4 class="card-title">Llena los datos del producto</h4>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="<?php echo $script; ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">

                  <div class="form-group">
                    <label for="descripcion">Descripcion</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $data['descripcion']; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="id_marca">Marca</label>
                    <select name="id_marca" id="id_marca" class="form-control">
                      <?php foreach ($data['marcas'] as $marca):?>
                      <option value="<?php echo $marca['id_marca']; ?>" <?php echo $marca['id_marca'] === $data['id_marca'] ? 'selected' : ''; ?>>
                        <?php echo $marca['marca']; ?></option>
                      <?php endforeach; //Fin del ciclo foreach?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="id_categoria">Categoria</label>
                    <select name="id_categoria" id="id_categoria" class="form-control">
                      <?php foreach ($data['categorias'] as $categoria):?>
                      <option value="<?php echo $categoria['id_categoria']; ?>"
                        <?php echo $categoria['id_categoria'] === $data['id_categoria'] ? 'selected' : ''; ?>>
                        <?php echo $categoria['categoria']; ?></option>
                      <?php endforeach; //Fin del ciclo foreach?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="id_forma">Forma</label>
                    <select name="id_forma" id="id_forma" class="form-control">
                      <?php foreach ($data['formas'] as $forma):?>
                      <option value="<?php echo $forma['id_forma']; ?>" <?php echo $forma['id_forma'] === $data['id_forma'] ? 'selected' : ''; ?>>
                        <?php echo $forma['forma']; ?></option>
                      <?php endforeach; //Fin del ciclo foreach?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="id_tipo_armazon">Tipo</label>
                    <select name="id_tipo_armazon" id="id_tipo_armazon" class="form-control">
                      <?php foreach ($data['tipos'] as $tipo):?>
                      <option value="<?php echo $tipo['id_tipo_armazon']; ?>"
                        <?php echo $tipo['id_tipo_armazon'] === $data['id_tipo_armazon'] ? 'selected' : ''; ?>>
                        <?php echo $tipo['tipo_armazon']; ?></option>
                      <?php endforeach; //Fin del ciclo foreach?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="color">Color</label>
                    <input type="text" class="form-control" id="color" name="color" value="<?php echo $data['color']; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="talla">Talla</label>
                    <input type="number" min="0" class="form-control w-25" id="talla" name="talla" value="<?php echo $data['talla']; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="longitud_varilla">Longitud de la Varilla</label>
                    <input type="number" min="0" class="form-control w-25" id="longitud_varilla" name="longitud_varilla"
                      value="<?php echo $data['longitud_varilla']; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="ancho_puente">Ancho del Puente</label>
                    <input type="number" min="0" class="form-control w-25" id="ancho_puente" name="ancho_puente" value="<?php echo $data['ancho_puente']; ?>"
                      required>
                  </div>

                  <div class="form-group">
                    <label for="ancho_total">Ancho Total</label>
                    <input type="number" min="0" class="form-control w-25" id="ancho_total" name="ancho_total" value="<?php echo $data['ancho_total']; ?>"
                      required>
                  </div>

                  <div class="form-group">
                    <label for="sku">SKU</label>
                    <input type="text" class="form-control" id="sku" name="sku" value="<?php echo $data['sku']; ?>" required>
                  </div>

                  <div class="form-group">
                    <label for="precio">Precio de Venta</label>
                    <input type="text" class="form-control" id="precio" name="precio" value="<?php echo $data['precio']; ?>" required>
                  </div>

                  <?php if (is_numeric($id_producto)): ?>
                  <img src="../../img/productos/<?php echo $data['foto']; ?>" alt="Imagen del producto" height="100">
                  <?php endif; //Fin del if?>

                  <div class="form-group">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control" id="foto" name="foto">
                  </div>

                </div>

                <!-- /.card-body -->

                <?php if (is_numeric($id_producto)): ?>
                <input type="hidden" value="<?php echo $data['id_producto']; ?>" name="id_producto">
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