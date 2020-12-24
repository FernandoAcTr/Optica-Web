/*
En este archivo se hacen todas las peticiones AJAX para la pagina de la tienda
*/

$(function () {
  //==========================================================
  //Pagina tienda
  //==========================================================
  if ($('.tienda').length) {
    var currentPage = 1;
    var filter = 0;
    var orderBy = 0;

    //Peticion para las categorias
    llenarCategorias();
    //Peticion para los productos
    llenarProductos();

    //Cambiar el select
    $('#select_order').change(function (e) {
      e.preventDefault();
      orderBy = $(this).val();
      llenarProductos();
    });
  }

  function llenarCategorias() {
    fetch(
      'http://localhost/PrograWeb/Optica/api/productos/api-productos.php?action=categories'
    )
      .then((response) => response.json())
      .then((data) => {
        data.categories.forEach((categoria) => {
          let option = `<li class="list-group-item"><a href="#" data-filter="${categoria.id_categoria}">${categoria.categoria}</a></li>`;
          $('#categorias').append(option);
        });
        $('#categorias a').click(function (e) {
          e.preventDefault();
          $('#categorias a').removeClass('category-active');
          $(this).addClass('category-active');

          currentPage = 1;
          filter = $(this).attr('data-filter');
          llenarProductos();
        });
      });
  }

  function llenarProductos() {
    fetch(getProductUrl())
      .then((response) => response.json())
      .then((data) => {
        $('.productos').html('');
        data.products.items.forEach((producto) => {
          var html = `
          <div class="col-md-4 producto">
            <p class="marca">${producto.marca}</p>
            <img src="img/productos/${producto.foto}" alt="Imagen del producto" height="170">
            <div class="contenido-producto">
              <p class="description">${producto.descripcion}</p>
              <div class="division"><span></span></div>
              <p class="precio">$${producto.precio}</p>
            </div>
            <div class="row justify-content-around">
              <a href="#" class="btn btn-sm btn-primary">
                <i class="fas fa-cart-plus"></i>Lo quiero
              </a>
              <a href="detalle-producto.php?id_producto=${producto.id_producto}" class="btn btn-sm btn-info">
                <i class="fas fa-caret-square-right"></i>Ver más
              </a>
            </div>
          </div>`;
          $('.productos').append(html);
        });

        pagination(data);
      });
  }

  function pagination(data) {
    //definir la paginacion
    let products = data.products;
    let page = products.page;
    let lastPage = products.totalPages;
    let previousPage = page == 1 ? -1 : page - 1;
    let nextPage = page == lastPage ? -1 : page + 1;
    var html = `<li class="d-flex"><p class="mr-5 my-auto text-muted small">Se muestran ${products.start} - ${products.end} de ${products.totalProducts} resultados</p></li>`;
    if (previousPage != -1)
      html += `<li class="page-item">
        <a class="page-link" href="#" aria-label="Previous" data-page=${previousPage}>
          <span aria-hidden="true">&laquo;</span>
        </a>
      </li>`;
    for (let i = page - 2; i <= page + 2; i++) {
      if (i > 0 && i <= lastPage) {
        let active = i == currentPage ? 'active' : '';
        html += `<li class="page-item ${active}"><a class="page-link" href="#" data-page=${i}>${i}</a></li>`;
      }
    }
    if (nextPage != -1)
      html += `<li class="page-item">
        <a class="page-link" href="#" aria-label="Next" data-page=${nextPage}>
          <span aria-hidden="true">&raquo;</span>
        </a>
      </li>`;

    if (data.products.totalPages > 1) {
      $('.pagination').html(html);
      addPaginationListener();
    } else {
      $('.pagination').html('');
    }
  }

  function addPaginationListener() {
    $('.pagination a').click(function (e) {
      e.preventDefault();
      let page = $(this).attr('data-page');
      console.log(page);
      currentPage = page;
      llenarProductos();
    });
  }

  function getProductUrl() {
    return `http://localhost/PrograWeb/Optica/api/productos/api-productos.php?page=${currentPage}&filter=${filter}&orderBy=${orderBy}`;
  }

  //==========================================================
  //Pagina detalle producto
  //==========================================================
  if ($('.detalle-producto').length) {
    let idProducto = $('#id_producto').val();
    let url = `http://localhost/PrograWeb/Optica/api/productos/api-productos.php?action=oneProduct&id_producto=${idProducto}`;
    fetch(url)
      .then((response) => response.json())
      .then((data) => {
        let producto = data.product;
        let detalle = `
        <div class="col-md-7">
        <img src="img/productos/${producto.foto}" alt="Imagen del producto" width="550">
        </div>

        <div class="col-md-5 detalles">
          <h2 class="marca">${producto.marca}</h2>
          <p class="sku">SKU: ${producto.sku}</p>
          <p class="text-muted">Descripcion: ${producto.descripcion}</p>
          <p class="precio">$${producto.precio}</p>
          <p class="cantidad">Cantidad</p>
          <input type="number" class="form-control" min="1" value="1">
          <a href="#" class="btn btn-primary">Agregar al carrito</a>
        </div>`;

        let info = `
        <p>Color</p>
        <p>${producto.color}</p>
        
        <p>Talla</p>
        <p>${producto.talla}</p>
        
        <p>Longitud de Varilla</p>
        <p>${producto.longitud_varilla}</p>
        
        <p>Ancho de puente</p>
        <p>${producto.ancho_puente}</p>
        
        <p>Ancho total</p>
        <p>${producto.ancho_total}</p>
        
        <p>Tipo de Armazon</p>
        <p>${producto.tipo_armazon}</p>`;

        $('.detalle .row').html(detalle);
        $('.info').html(info);
      });
  }
});
