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
            console.log(imgpath);
            $("#showImage").fadeIn("fast").attr('src',imgpath);
        } else {
            $("#showImage").fadeIn("fast").attr('src','/images/default/no_image.png');
        }
    });

    /**
     * Show multiple image when choose image
     */
    $('#multiple-image').change( function(event) {
        var files = event.target.files;
        var result = $("#showImage");
        result.empty();  
        $.each(files, function(i, file) {
            var imgpath = URL.createObjectURL(file);    
            result.add("<img class='img-place  mr-10' src='" + imgpath + "'>").appendTo('#showImage');
        });
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
