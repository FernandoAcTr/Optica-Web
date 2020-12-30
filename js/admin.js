/*
   Este script configura todos los plugins que se ocupan en AdminLTE
   
   Table Of Content
   
   1. Datatables
   2. Registro de Productos Comprados
   3. Validacion de formulario de registro de usuarios
   4. Calendar para el dashboard
   5. Registro de Productos Vendidos
*/

var formatter = new Intl.NumberFormat('en-US', {
  style: 'currency',
  currency: 'USD',
});

$(function () {
  // Datatables
  if ($('#tabla').length) {
    $('#tabla')
      .DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
        buttons: ['copy', 'csv', 'pdf', 'print'],
        language: {
          paginate: {
            next: 'Siguiente',
            previous: 'Anterior',
            last: 'Último',
            first: 'Primero',
          },
          info: 'Mostrando _START_ - _END_ de _TOTAL_ resultados',
          search: 'Buscar',
          emptytable: 'No hay registros',
          infoEmpty: '0 registros',
        },
      })
      .buttons()
      .container()
      .appendTo('#tabla_wrapper .col-md-6:eq(0)');
  }

  //registro de productos comprados
  if ($('#table-products').length) {
    let contador = 0;
    $('#btn-registrar').click(function (e) {
      e.preventDefault();
      addProductToTable();
    });

    $('.btn-eliminar').click(function (e) {
      e.preventDefault();
      let tr = $(this).parent().parent();
      tr.remove();
    });
  }

  //Validacion de formulario de registro de usuarios
  let isEmailCorrect = false;
  if ($('#contrasena').length) {
    $('#contrasena').keyup(validatePassword);
    $('#rep_contrasena').keyup(validatePassword);
  }

  if ($('#correo').length) {
    $('#correo').keyup(validarEmail);
    validarEmail();
  }

  function validatePassword(e) {
    let password = $('#contrasena').val();
    let repPass = $('#rep_contrasena').val();
    if (password !== repPass) {
      $('#rep_contrasena').addClass('is-invalid');
      $('#password_help').text('Las contraseñas no coinciden');
    } else {
      $('#rep_contrasena').removeClass('is-invalid');
      $('#rep_contrasena').addClass('is-valid');
      $('#password_help').text('');
    }
  }

  function validarEmail(e) {
    console.log($('#correo').val());
    if (
      /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($('#correo').val())
    ) {
      $('#correo').removeClass('is-invalid');
      $('#email_help').text('');
      isEmailCorrect = true;
    } else {
      $('#correo').addClass('is-invalid');
      $('#email_help').text('El correo es invalido');
      isEmailCorrect = false;
    }
    enableButton();
  }

  function enableButton() {
    if (isEmailCorrect) {
      $('#guardar').prop('disabled', false);
    } else {
      $('#guardar').prop('disabled', true);
    }
  }

  //Calendar para el Dashboard
  $('#calendar').datetimepicker({
    format: 'L',
    inline: true,
  });

  //registro de productos vendidos
  if ($('#table-purchase-products').length) {
    $('#btn-registrar').click(function (e) {
      e.preventDefault();
      addProductToTable();
      updatePurchaseTotal();
    });

    $('.btn-eliminar').click(function (e) {
      e.preventDefault();
      let tr = $(this).parent().parent();
      tr.remove();
    });

    $('#cantidad').change(function (e) {
      e.preventDefault();
      verificarInventario($(this).val());
    });
    updatePurchaseTotal();
  }
});

async function obtenerProductoPrecio() {
  let idProducto = $('#producto').val();

  let response = await fetch(
    `http://localhost/PrograWeb/Optica/api/productos/api-productos.php?action=oneProduct&id_producto=${idProducto}`
  );
  let data = await response.json();

  let producto = data.product;

  $('#precio').val(producto.precio);
}

function addProductToTable() {
  let contador = $('tbody tr:last th').text() || 0;

  let productoId = $('#producto').val();
  let descripcion = $('#producto option:selected').text().trim();
  let cantidad = $('#cantidad').val();
  let precio = $('#precio').val();

  if (cantidad && precio) {
    let exist = false;
    $('tbody tr').each(function (index, element) {
      let td = element.children[1];
      if (td.textContent.trim() == descripcion) {
        exist = true;
      }
    });
    if (!exist) {
      let tr = `
      <tr>
        <th scope="row">${++contador}</th>
        <td>${descripcion}</td>
        <input type="hidden" name="productos[${productoId}][descripcion]" value="${descripcion}">
        <td>${cantidad}</td>
        <input type="hidden" name="productos[${productoId}][cantidad]" value="${cantidad}">
        <td class="text-right">${formatter.format(precio)}</td>
        <input type="hidden" name="productos[${productoId}][precio]" value="${precio}">
        <td><button class='btn btn-sm btn-danger btn-eliminar' role='button'><i class="fas fa-trash-alt"></i></button></td>
      </tr>`;

      $('#table-body').append(tr);
    }
  }

  $('.btn-eliminar').click(function (e) {
    e.preventDefault();
    let tr = $(this).parent().parent();
    tr.remove();
  });
}

function updatePurchaseTotal() {
  let total = 0;

  $('tbody tr').each(function (index, element) {
    let precio = element.children[6].value;
    let cantidad = element.children[4].value;
    total += precio * cantidad;
  });

  let iva = total * 0.16;
  let subtotal = total - iva;

  $('#subtotal').text(formatter.format(subtotal));
  $('#IVA').text(formatter.format(iva));
  $('#total').text(formatter.format(total));
}

async function verificarInventario(cantidad) {
  let idProducto = $('#producto').val();

  let response = await fetch(
    `http://localhost/PrograWeb/Optica/api/productos/api-productos.php?action=oneProduct&id_producto=${idProducto}`
  );
  let data = await response.json();

  let producto = data.product;

  if (producto.stock < cantidad) {
    $('#advertencia').removeClass('d-none');
    $('#advertencia').text(
      `Solo quedan ${producto.stock} unidades del producto`
    );
  } else {
    $('#advertencia').addClass('d-none');
  }
}
