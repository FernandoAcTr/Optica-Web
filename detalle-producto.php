<?php include 'views/header.php'; ?>

<!-- HEADER -->
<header class="head container-fluid">
  <div class="head-content d-flex justify-content-center align-items-center h-100">
    <h1 class="h2 separador">Detalle del Producto</h1>
  </div>
</header>
<!-- FIN HEADER -->

<main class="container">

  <div class="detalle">
    <div class="row">

      <div class="col-md-7">
        <img src="productos/carrera.jpg" alt="Imagen del producto">
      </div>

      <div class="col-md-5">
        <div class="detalles">
          <h2 class="marca">CARRERA</h2>
          <p class="sku">SKU: CARRERA 216/G/S J5GQT 51-20-145</p>
          <p class="precio">$3,970.00</p>
          <p class="cantidad">Cantidad</p>
          <input type="number" class="form-control" min="1" value="1">
          <a href="#" class="btn btn-primary">Agregar al carrito</a>
        </div>
      </div>

    </div>

    <div class="info">
      <p>Color</p>
      <p>Dorado</p>

      <p>Talla</p>
      <p>51</p>

      <p>Longitud de Varilla</p>
      <p>145</p>

      <p>Ancho de puente</p>
      <p>20</p>

      <p>Ancho total</p>
      <p>123</p>

      <p>Tipo de Armazon</p>
      <p>Ranurado</p>
    </div>

  </div>

</main>

<?php include 'views/footer.php'; ?>