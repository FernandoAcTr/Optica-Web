<!DOCTYPE html>
<html lang="es">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Optica Tovar | Los mejores precios | Lentes oftálmicos">

    <!-- bootstrap -->
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="plugins/bootstrap/bootstrap.css.map">

    <!-- Leaflet Mapa -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" />

    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/all.min.css">

    <!-- Preloader -->
    <link rel="stylesheet" href="css/preloader.css">

    <!-- Mia -->
    <link rel="stylesheet" href="css/styles.css">

    <!-- Scroll Reveal -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <title>Optica Tovar | Lic. Maricela Tovar Aboytes</title>

    <?php
       $archivo = basename($_SERVER['PHP_SELF']);
       $pagina = str_replace('.php', '', $archivo);
    ?>
  </head>

  <body class="<?php echo $pagina; ?>">
    <div class="d-flex" id="wrapper">

      <!-- Sidebar -->
      <?php include_once 'carrito.php'; ?>
      <!-- /#sidebar-wrapper -->

      <!-- Page Content -->
      <div id="page-content-wrapper">
        <!-- Page Loader -->
        <div id="page-loader"><span class="preloader-interior"></span></div>

        <!-- Barra de navegacion -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top">
          <a class="navbar-brand" href="index.php"><img src="assets/img/logo-ligth.png" alt="" width="70"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item <?php echo $pagina == 'index' ? 'active' : ''; ?>">
                <a class="nav-link" href="index.php">Inicio</a>
              </li>
              <li class="nav-item <?php echo $pagina == 'tienda' ? 'active' : ''; ?>">
                <a class="nav-link" href="tienda.php">Tienda</a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $pagina == 'contacto' ? 'active' : ''; ?>" href="contacto.php">Contacto</a>
              </li>

              <li class="nav-item dropdown">
                <a class="nav-link" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Ayuda
                </a>
                <div class="dropdown-menu transparent" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item transparent" href="padecimientos.php">Padecimientos</a>
                  <a class="dropdown-item transparent" href="forma-cara.php">Forma de Cara</a>
                  <a class="dropdown-item transparent" href="faqs.php">FAQ's</a>
                </div>
              </li>

              <li class="nav-item">
                <a class="nav-link toggler" href="contacto.php"><i class="fas fa-cart-plus mr-1"></i>(5)</a>
              </li>

            </ul>
          </div>
        </nav>