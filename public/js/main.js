$(function () {
  $("#list-table").DataTable({
    "paging": false,
    "searching": true,
    "lengthChange": false
  });
});

$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip(); 
});

$('#File').change( function(event) {
	var imgpath = URL.createObjectURL(event.target.files[0]);
	$("#showImage").fadeIn("fast").attr('src',imgpath);
});

