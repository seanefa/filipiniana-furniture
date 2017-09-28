$(document).ready(function () {
  var table = $('.dataTable').DataTable({
    "order": [],
    "pageLength": 5,
    "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
    "aoColumnDefs" : [
    {
     'bSortable' : false,
     'bSearchable' : false,
     'aTargets' : [ 'removeSort' ]
   }]
 });
});

$(document).ready(function () {
  $('#reportsTable').DataTable( {
    dom: 'Bfrtip',
    buttons: [
    'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});

/*<![CDATA[
jQuery(function($) { 'use strict';
  $("#printReceipt").find('.print-link').on('click', function() {
      //Print ele2 with default options
      $.print("#printReceipt");
    });
});
]]>*/