<?php include 'views/header.php'; ?>

<!-- HEADER -->
<header class="head container-fluid">
  <div class="head-content d-flex justify-content-center align-items-center h-100">
    <div class="content">
      <p class="m-0">¡Hola! Bienvenido a </p>
      <h1><span id="typed"></span></h1>
    </div>
  </div>
</header>
<!-- FIN HEADER -->

<main class="container my-5">
  <h2 class="text-center separador">¡Encuentra lo que estas buscando!</h2>

  <div class="row">
    <aside class="col-md-3">
      <p class="h3">Filtrar por</p>
      <hr>
      <div class="filtro">
        <div class="d-flex justify-content-between titulo-filtro">
          <p>Categoria</p>
          <i class="fas fa-plus small"></i>
        </div>
        <ul class="categorias list-group">
          <li class="list-group-item"><a href="#" class="">Todos</a></li>
          <li class="list-group-item"><a href="#" class="">Anteojos Oftálmicos</a></li>
          <li class="list-group-item"><a href="#" class="">Lentes de Seguridad</a></li>
          <li class="list-group-item"><a href="#" class="">Lentes de Sol</a></li>
        </ul>
      </div>
    </aside>

    <div class="col-md-9">

      <div class="orden d-flex">
        <label class="col-form-label">Ordenar por</label>
        <select id="orden" class="form-control">
          <option value="">Lo más nuevo</option>
          <option value="">Precio (de bajo a alto)</option>
          <option value="">Precio (de alto a bajo)</option>
          <option value="">Nombre de A-Z</option>
          <option value="">Nombre de Z-A</option>
        </select>
      </div>

      <div class="row productos">

        <?php for ($i = 1; $i <= 9; ++$i):?>
        <div class="col-md-4">

          <div class="producto">
            <p class="description">Carrera 8033/GS</p>
            <img src="img/productos/oftalmicos2.jpg" alt="Imagen del producto">
            <div class="contenido-producto">
              <p class="marca">Carrera</p>
              <div class="division"><span></span></div>
              <p class="precio">$5500</p>
            </div>
            <div class="row justify-content-around">
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-cart-plus"></i>Lo quiero
              </a>
              <a href="detalle-producto.php" class="btn btn-sm btn-info">
                <i class="fas fa-caret-square-right"></i>Ver más
              </a>
            </div>
          </div>

        </div>
        <?php endfor; //Fin del ciclo?>
      </div>

    </div>

  </div>

  <!-- inicio PAGINACION -->
  <nav aria-label="Page navigation">
    <ul class="pagination justify-content-end">
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Previous">
          <span aria-hidden="true">&laquo;</span>
          <span class="sr-only">Previous</span>
        </a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#" aria-label="Next">
          <span aria-hidden="true">&raquo;</span>
          <span class="sr-only">Next</span>
        </a>
      </li>
    </ul>
  </nav>
  <!-- Fin PAGINACION -->
</main>

<?php include 'views/footer.php'; ?>