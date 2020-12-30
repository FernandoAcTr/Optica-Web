<?php include '../views/header.php'; ?>
<?php include '../views/navbar.php'; ?>

<div class="wrapper">
  <!-- Content Wrapper. Contains page content -->
  <main class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="mb-4">Dashboard</h1>

            <!-- Small boxes -->
            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $productos; ?></h3>

                    <p>Productos distintos ofrecidos</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="../producto/producto.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $proveedores; ?></h3>

                    <p>Proveedores</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="../proveedor/proveedor.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php echo $marcas; ?></h3>

                    <p>Marcas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-social-markdown"></i>
                  </div>
                  <a href="../marca/marca.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $stock; ?></h3>

                    <p>Productos en stock</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-clipboard"></i>
                  </div>
                  <a href="../inventario/inventario.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>

            <div class="row">
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                  <div class="inner">
                    <h3><?php echo $ventasPaypal; ?></h3>

                    <p>Ventas completadas en la página</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="../venta/venta.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                  <div class="inner">
                    <h3><?php echo $ventasCanceladas; ?></h3>

                    <p>Ventas canceladas</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="../venta/venta.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                  <div class="inner">
                    <h3><?php echo $clientesPaypal; ?></h3>

                    <p>Clientes registrados en la página</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-social-markdown"></i>
                  </div>
                  <a href="../cliente/cliente.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3><?php echo $clientes; ?></h3>

                    <p>Clientes totales</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-android-clipboard"></i>
                  </div>
                  <a href="../inventario/inventario.php" class="small-box-footer">Más info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!--Fin Small boxes -->

            <!-- Calendario -->
            <div class="row justify-content-center">
              <div class="col-sm-6">
                <div class="card bg-gradient-success">
                  <div class="card-header border-0">

                    <h3 class="card-title">
                      <i class="far fa-calendar-alt"></i>
                      Calendario
                    </h3>
                    <!-- tools card -->
                    <div class="card-tools">
                      <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                    <!-- /. tools -->
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body pt-0">
                    <!--The calendar -->
                    <div id="calendar" style="width: 100%"></div>
                  </div>
                  <!-- /.card-body -->
                </div>
              </div>
              <!--Fin Calendario -->

              <!-- PRODUCT LIST -->
              <div class="col-sm-6">
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Productos Agregados recientemente</h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <ul class="products-list product-list-in-card pl-2 pr-2">

                      <?php foreach ($ultimosProductos as $producto):?>
                      <li class="item">
                        <div class="product-img">
                          <img src="../../img/productos/<?php echo $producto['foto']; ?>" alt="Product Image" class="img-size-50">
                        </div>
                        <div class="product-info">
                          <a href="javascript:void(0)" class="product-title"><?php echo $producto['marca']; ?>
                            <span class="badge badge-warning float-right">$<?php echo $producto['precio']; ?></span></a>
                          <span class="product-description">
                            <?php echo $producto['descripcion']; ?>
                          </span>
                        </div>
                      </li>
                      <?php endforeach; //Fin del ciclo foreach?>


                      <!-- /.item -->
                    </ul>
                  </div>
                </div>
              </div>
              <!-- FIN PRODUCT LIST -->

            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

  </main>
  <!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->

<?php include '../views/footer.php'; ?>