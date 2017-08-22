$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    
    /**
     * Show delete confimation when click button delete
     */
    $('.btn-delete-item').bind('click',function(e){
        e.preventDefault();
        var form = $(this.form);
        var title = $(this).attr('data-title');
        var body = '<i>' + $(this).attr('data-confirm') + '</i>';
        $('#title-content').html(title);
        $('#body-content').html(body);
        $('#confirm').modal('show');
        $('#delete-btn').one('click', function(){
            form.submit();
            $('#confirm').modal('hide');
        })
    });

    /**
     * Show image when choose image
     */
    $('#preview-image').change( function(event) {
        var select_input_file = $(this).val();
        if (select_input_file) {
            var imgpath = URL.createObjectURL(event.target.files[0]);
            $("#showImage").fadeIn("fast").attr('src',imgpath);
        } else {
            $("#showImage").fadeIn("fast").attr('src','/images/default/no_image.png');
        }
    });

    /**
     * Show images when choose images
     */
    $( "#img-upload" ).change(function() {
      console.log('test');
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

    /**
     * Show message if database has not data or search not found
     *
     */
    var count_records = $('#table-contain tbody tr').length;
    if (count_records == 0) {
        $('.cls-search-not-found').show();
    }
});
