<?php include 'views/header.php'; ?>

<!-- HEADER -->
<header class="head container-fluid">
  <div class="head-content d-flex justify-content-center align-items-center h-100">
    <h1 class="h2 separador">¡A solo un paso!</h1>
  </div>
</header>
<!-- FIN HEADER -->

<main class="container my-5">

  <div class="row justify-content-around">

    <!-- Lista de productos -->
    <div class="col-md-8" id="list-items">

      <!-- <hr>
      <div class="item row">
        <div class="col-4">
          <img src="img/productos/5fe2d1f2c402e.jpeg" alt="">
        </div>

        <div class="col-8">
          <div class="titulo d-flex justify-content-between">
            <p class="my-auto"><b>Carrera</b></p>
            <p class="badge badge-warning my-auto">$423</p>
          </div>
          <p class="mt-1 text-muted">Producto maravilloso</p>
          <p class="small">Cantidad: 5</p>
        </div>
      </div> -->

    </div>
    <!-- Fin Lista de productos -->


    <!-- Detalles del pago -->
    <aside class="col-md-3 card h-100">
      <div class="card-body">
        <p class="font-weight-bold text-center">Detalles del pago</p>
        <div class="mb-4" id="detalles">
          <!-- <div class="d-flex justify-content-between">
            <p class="m-0">Subtotal: </p>
            <p class="m-0">$4200</p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="m-0">IVA:</p>
            <p class="m-0">$800</p>
          </div>
          <hr>
          <div class="d-flex justify-content-between">
            <p class="my-auto">Total a pagar:</p>
            <p class="badge badge-info my-auto">$5000</p>
          </div> -->
        </div>
        <div id="paypal-button-container"></div>
      </div>
    </aside>
    <!-- Fin detalles del pago -->

  </div>

</main>

<?php include 'views/footer.php'; ?>