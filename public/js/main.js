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
    var names = '';
    var ids = ''
    $(".checkbox-inline input").bind('click',function(){ 
      var service = this.value.split('-');
      names = names + service[1] + ', ';
      ids = ids + service[0] + '/';
      console.log(names);
      $("#services").val(names);
    });
    $(".btn-delete-item").bind('click',function(){
            $("#services").val(ids);
    });
    $( "#img-upload" ).change(function() {
      if (this.files && this.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.preview-img').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    }
    });
});


// document.getElementById("files").onchange = function () {
//     var reader = new FileReader();

//     reader.onload = function (e) {
//         // get loaded data and render thumbnail.
//         document.getElementById("image").src = e.target.result;
//     };

//     // read the image file as a data URL.
//     reader.readAsDataURL(this.files[0]);
// };

