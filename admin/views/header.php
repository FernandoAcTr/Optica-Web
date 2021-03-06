<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/plugins/fontawesome-free/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/plugins/adminlte/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/plugins/overlayScrollbars/OverlayScrollbars.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- CSS propio -->
    <link rel="stylesheet" href="<?php echo HOST_BASE; ?>/css/admin.css">

    <?php
       $archivo = basename($_SERVER['PHP_SELF']);
       $pagina = str_replace('.php', '', $archivo);
    ?>
  </head>

  <body class="hold-transition sidebar-mini layout-fixed" id="<?php echo $pagina; ?>">