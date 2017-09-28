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
     * Show message if database has not data or search not found in page News
     */
    var countNews = $('#newstable tbody tr').length;
    if (countNews == 0) {
        $('.cls-searchnews-not-found').show();
    }

    /**
     * Check if not input value in field search.
     */
    $('.btn-search').on('click', function(event) {
        $input = $(this).prev().val();
            if ($input.length != 0) {
                $(this).parent().submit();      
            }        
        event.preventDefault();
    });

    /**
     * Show message if database has not data or search
     */
    var count_records = $('#table-contain tbody tr').length;
    if (count_records == 0) {
        $('.cls-search-not-found').show();
    }

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
     * remove image when click button remove image
     */
    $('.btn-remove-img').bind('click',function(e){
        e.preventDefault();
        var img_container = $('#old-images');
        var img_item = $(this).parent();
        var title = img_container.data('title');
        var token = img_container.data('token');
        var url = $(this).data('url');
        var body = '<i>' + img_container.data('confirm') + '</i>';
        $('#title-content').html(title);
        $('#body-content').html(body);
        $('#confirm').modal('show');
        $('#delete-btn').one('click', function(){
            $.ajax({
                url: url,
                type: 'POST',
                data: {_method: 'delete', _token :token},
                success: function( msg ) {
                    if (msg.result) {
                        img_item.remove()
                    }
                    if (img_container.children().length == 0) {
                        img_container.add('<div id="old-images" class="text-info">No old image</div>').appendTo('#old-images');
                    }
                }
            });
            $('#confirm').modal('hide');
        })
    });

    /**
     * Show hinted place when focus place_slug field
     */
    $('#hotelSourceArea').focus(function(event) {
        $('.widgetAcResult').show();
    });

    /**
     * Show hinted place when key up place_slug field
     */
    $('#hotelSourceArea').keyup(function(event) {
        var url = $(this).data('url');
        var key = $(this).val();
        $.ajax({
                url: url,
                type: 'GET',
                data: {key :key},
                success: function( msg ) {
                    if (msg == '') {
                        $('#submit').attr("disabled", true);
                    } else {
                        $('#submit').removeAttr("disabled");
                    }
                    $('.widgetAcResult').html(msg);
                }
            });
    });

    /**
     * Hide hinted place when blur place_slug field
     */
    $('#hotelSourceArea').blur(function(event) {
        if ($('.widgetAcResult div li.place-selected')[0]) {
            $(this).val($('.widgetAcResult div li.place-selected')[0].innerHTML);
        }
        $('.widgetAcResult').fadeOut();
    });

    /**
     * Fill value for place_slug field when choose hinted place
     */
    $(".widgetAcResult").on('click', 'div li.place-selected', function(event) {
        $('#hotelSourceArea').val($(this)[0].innerHTML);
    });
});
