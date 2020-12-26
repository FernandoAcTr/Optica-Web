/*
   Este script configura todos los plugins que se ocupan en AdminLTE
   
   Table Of Content
   
   1. Datatables
   2. Registro de Productos
   3. Validacion de formulario de registro de usuarios
   4. Calendar para el dashboard
*/

$(function () {
  // Datatables
  if ($('#tabla').length) {
    $('#tabla').DataTable({
      paging: true,
      lengthChange: false,
      searching: true,
      ordering: true,
      info: true,
      autoWidth: false,
      responsive: true,
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
    });
  }

  //registro de productos
  if ($('#table-products').length) {
    let contador = 0;
    $('#btn-registrar').click(function (e) {
      e.preventDefault();
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
            <td>${precio}</td>
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
});
