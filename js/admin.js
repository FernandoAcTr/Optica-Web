/*
   
   Table Of Content
   
   1. Datatables

*/
$(function () {
  // Datatables
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
});
