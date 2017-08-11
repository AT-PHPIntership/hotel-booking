$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    $(".btn-delete-item").bind('click',function(){ 
         
      var result = confirm("Are you sure you want to delete?");
      if(result){
        $('form.delete-item').submit();
      } else {
        return false;
      }
    });
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    // preview images
    $( "#img-upload" ).change(function() {
      if (this.files && this.files[0]) {
        for (var i = 0; i < this.files.length; ++i) {
          var file = this.files[i];
          var reader = new FileReader();
          reader.onload = function (e) {
              var imgs = $('#preview-img').html();
              $('#preview-img').html(imgs+'<img src="'+e.target.result+'" style="width:30%">');
          };
          reader.readAsDataURL(file);
        }
       }
    });
});


