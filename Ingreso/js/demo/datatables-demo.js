// Call the dataTables jQuery plugin
// $(document).ready(function() {
//   $('#dataTable').DataTable();
// });


$(document).ready(function() {    
  $('#dataTable').DataTable({
  //para cambiar el lenguaje a español
  scrollX: true,
      "language": {
              "lengthMenu": "Mostrar &nbsp;&nbsp;_MENU_ &nbsp;&nbsp;registros",
              "zeroRecords": "No se encontraron resultados",
              "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
              "infoFiltered": "(filtrado de un total de _MAX_ registros)",
              "sSearch": "Buscar:&nbsp;",
              "sSearchPlaceholder": "¿Que quieres buscar?",
              "oPaginate": {
                  "sFirst": "Primero",
                  "sLast":"Último",
                  "sNext":"Siguiente ",
                  "sPrevious": " Anterior"
               },
               "sProcessing":"Procesando...",
          },
      // "order": [[ 2, "asc" ]]
  });
});