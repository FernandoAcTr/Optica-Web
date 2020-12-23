  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo HOST_BASE; ?>/index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?php echo HOST_BASE; ?>/admin/login/login.php?action=logout"class="nav-link">Salir</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
      <img src="<?php echo HOST_BASE; ?>/assets/img/logo.png" alt="Optica Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Optica</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo HOST_BASE; ?>/img/usuarios/<?php echo $_SESSION['foto'] ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION['nombre'] ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?php echo HOST_BASE; ?>/admin/dashboard/dashboard.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-friends"></i>
              <p>
                Proveedores
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/proveedor/proveedor.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todos</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/proveedor/proveedor.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tags"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/producto/producto.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todos</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/producto/producto.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill-wave"></i>
              <p>
                Compras
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/compra/compra.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todas</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/compra/compra.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Registrar Compra</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="<?php echo HOST_BASE; ?>/admin/inventario/inventario.php" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>
                Inventario
              </p>
            </a>
          </li>


          <li class="nav-header">Catálogos</li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fab fa-buffer"></i>
              <p>
                Marcas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/marca/marca.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todas</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/marca/marca.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-bahai"></i>
              <p>
                Categorias
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/categoria/categoria.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todas</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/categoria/categoria.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shapes"></i>
              <p>
                Formas
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/forma/forma.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todas</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/forma/forma.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-draw-polygon"></i>
              <p>
                Tipos de Armazones
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/tipo_armazon/tipo_armazon.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todos</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/tipo_armazon/tipo_armazon.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- Sistema CRUGE -->
          <li class="nav-header">Sistema de Usuarios</li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/usuario/usuario.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todos</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/usuario/usuario.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/rol/rol.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todos</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/rol/rol.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-lock"></i>
              <p>
                Permisos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/permiso/permiso.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todos</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/permiso/permiso.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Agregar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Asignación de Roles
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/usuario_rol/usuario_rol.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todos</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/usuario_rol/usuario_rol.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Asignar</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-slash"></i>
              <p>
                Asignación de permisos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/rol_permiso/rol_permiso.php" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Ver todos</p>
                </a>
                <a href="<?php echo HOST_BASE; ?>/admin/cruge/rol_permiso/rol_permiso.php?action=form" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Asignar</p>
                </a>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>