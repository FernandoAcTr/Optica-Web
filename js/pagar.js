/**
 * Este script se ocupa para hacer una peticion AJAX al carrito y pagar mediante paypal
 */
var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
});

$(function () {
  if ($('.pagar').length) {
    fetch(
      'http://localhost/PrograWeb/Optica/api/carrito/api-carrito.php?action=show'
    )
      .then((response) => response.json())
      .then((data) => {
        console.log(data);

        data.items.forEach((item) => {
          let html = `
          <hr>
          <div class="item row">
            <div class="col-4">
              <img src="img/productos/${item.foto}" alt="">
            </div>
    
            <div class="col-8">
              <div class="titulo d-flex justify-content-between">
                <p class="my-auto"><b>${item.marca}</b></p>
                <p class="badge badge-warning my-auto">${formatter.format(
                  item.precio
                )}</p>
              </div>
              <p class="mt-1 text-muted">${item.descripcion}</p>
              <p class="small">Cantidad: ${item.cantidad}</p>
            </div>
          </div>`;

          $('#list-items').append(html);
        });

        let detallePago = `
          <div class="d-flex justify-content-between">
            <p class="m-0">Subtotal: </p>
            <p class="m-0">${formatter.format(data.info.subtotal)}</p>
          </div>
          <div class="d-flex justify-content-between">
            <p class="m-0">IVA:</p>
            <p class="m-0">${formatter.format(data.info.IVA)}</p>
          </div>
          <hr>
          <div class="d-flex justify-content-between">
            <p class="my-auto">Total a pagar:</p>
            <p class="badge badge-info my-auto">${formatter.format(
              data.info.total
            )}</p>
          </div>`;

        $('#detalles').append(detallePago);

        renderPaypalButton(data);
      });
  }

  function renderPaypalButton(compra) {
    paypal
      .Buttons({
        style: {
          layout: 'vertical',
          color: 'gold',
          shape: 'rect',
        },
        createOrder: function (data, actions) {
          return actions.order.create(createOrder(compra));
        },
        onApprove: function (data, actions) {
          return actions.order.capture().then(function (details) {
            console.log(details);

            //TODO guardar la compra en la base de datos

            Swal.fire(
              'Perfecto!',
              'El pago se realizó con Exito. Gracias por su preferencia!',
              'success'
            ).then((result) => {
              // window.location = 'index.php';
            });
          });
        },
        onCancel: function (data) {
          //TODO agregar un registro a la base de datos de compra cancelada

          console.log(data);
          Swal.fire(
            'Perfecto!',
            'Tu compra fue cancelada. Sentimos que no hayas realizado la compra :(',
            'info'
          );
        },
      })
      .render('#paypal-button-container');
  }

  function createOrder(compra) {
    let order = {
      purchase_units: [
        {
          description: 'Compra realizada a Optica Tovar',
          amount: {
            currency_code: 'MXN',
            value: compra.info.total,
            breakdown: {
              item_total: {
                currency_code: 'MXN',
                value: compra.info.subtotal,
              },
              tax_total: {
                currency_code: 'MXN',
                value: compra.info.IVA,
              },
              shipping: {
                currency_code: 'MXN',
                value: '0',
              },
              handling: {
                currency_code: 'MXN',
                value: '0',
              },
              insurance: {
                currency_code: 'MXN',
                value: '0',
              },
              shipping_discount: {
                currency_code: 'MXN',
                value: '0',
              },
              discount: {
                currency_code: 'MXN',
                value: '0',
              },
            },
          },
        },
      ],
      items: [],
    };

    compra.items.forEach((item) => {
      let purchaseItem = {
        name: item.descripcion,
        quantity: item.cantidad,
        sku: item.sku,
        unit_amount: {
          currency_code: 'MXN',
          value: item.precio_unitario,
        },
      };
      order.items.push(purchaseItem);
    });

    return order;
  }
});
