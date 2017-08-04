$(function () {
  $("#example1").DataTable();
  $('#example2').DataTable({
    "paging": true,
    "lengthChange": false,
    "searching": false,
    "ordering": true,
    "info": true,
    "autoWidth": false
  });
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});

$('#File').change( function(event) {
	var imgpath = URL.createObjectURL(event.target.files[0]);
	$("#showImage").fadeIn("fast").attr('src',imgpath);
});

