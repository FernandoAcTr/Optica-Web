/**
 * Este script se ocupa de actualizar el carrito y agregar y remover items de él
 */

var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
});

actualizarItemsNumber();

function actualizarCarrito() {
  fetch(
    'http://localhost/PrograWeb/Optica/api/carrito/api-carrito.php?action=show'
  )
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      html = ``;

      data.items.forEach((producto) => {
        html += `<li class="producto">
            <div class="row">
              <div class="col-7">
                <img src="img/productos/${producto.foto}" alt="">
              </div>
              <div class="col-5">
                <p class="marca">${producto.marca}</p>
                <p class="precio">${formatter.format(producto.precio)}</p>
                <p class="cantidad">
                  Cant: ${producto.cantidad} 
                  <a><i class="fas fa-minus-circle" onclick="removeItemFromCart(${
                    producto.id_producto
                  })"></i></a>
                </p>
              </div>
            </div>
          </li>
          <hr>`;
      });

      $('.contenido-carrito ul').html(html);
      $('#total').text(`${formatter.format(data.info.total)}`);

      Cookies.set('itemsNumber', data.info.count);
      actualizarItemsNumber();
    });
}

function addItemToCart(idProducto) {
  fetch(
    `http://localhost/PrograWeb/Optica/api/carrito/api-carrito.php?action=add&id=${idProducto}`
  )
    .then((response) => response.json())
    .then((data) => {
      console.log('agregado');
      actualizarCarrito();
      Swal.fire('Perfecto!', 'Se agregó el producto al carrito!', 'success');
    });
}

function removeItemFromCart(idProducto) {
  fetch(
    `http://localhost/PrograWeb/Optica/api/carrito/api-carrito.php?action=remove&id=${idProducto}`
  )
    .then((response) => response.json())
    .then((data) => {
      console.log('eliminado');
      actualizarCarrito();
    });
}

function actualizarItemsNumber() {
  let numero = Cookies.get('itemsNumber');
  if (numero) {
    $('#item-in-cart').text(numero);
  } else {
    $('#item-in-cart').text('0');
  }
}

//==========================================================
//Pagina detalle producto
//==========================================================
function addManyToCart(idProducto) {
  let cantidad = $('#quantity').val();
  for (let i = 0; i < cantidad; i++) {
    fetch(
      `http://localhost/PrograWeb/Optica/api/carrito/api-carrito.php?action=add&id=${idProducto}`
    )
      .then((response) => response.json())
      .then((data) => {
        console.log('agregado');
      });
  }
  actualizarCarrito();
  Swal.fire(
    'Perfecto!',
    `Se agregaron ${cantidad} existencias del producto al carrito!`,
    'success'
  );
}