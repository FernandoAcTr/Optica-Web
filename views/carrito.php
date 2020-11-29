<aside class="bg-light border-right carrito" id="sidebar-wrapper">
  <div class="sidebar-heading toggler">
    <i class="fas fa-arrow-left"></i>Carrito
  </div>

  <div class="contenido-carrito">

    <ul class="list-group list-unstyled">
      <?php for ($i = 0; $i < 4; ++$i):?>
      <li class="producto">
        <div class="row">
          <div class="col-7">
            <img src="assets/img/dummy/c1.jpg" alt="">
          </div>
          <div class="col-5">
            <p class="marca">Carrera</p>
            <p class="precio">$4250</p>
            <p class="cantidad">
              Cant: 1 
              <a><i class="fas fa-minus-circle"></i></a>
            </p>
          </div>
        </div>
      </li>
      <hr>
      <?php endfor; //Fin del ciclo foreach?>
    </ul>

  </div>

  <footer>
    <p>Subtotal</p>
    <p class="precio">$4250.00</p>
    <hr>
    <div class="d-flex justify-content-center">
      <a href="#" class="btn btn-primary w-75">Pagar</a>
    </div>
  </footer>


</aside>