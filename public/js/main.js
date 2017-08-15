$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
    $(".btn-delete-item").bind('click',function(e){
        e.preventDefault();
        var form = $(this.form);
        var title = $(this).attr("data-title");
        var body = '<i>' + $(this).attr("data-confirm") + '</i>';
        $('#title-content').html(title);
        $('#body-content').html(body);
        $('#confirm').modal('show');
        $("#delete-btn").one("click", function(){
            form.submit();
            $('#modal-confirm').modal('hide');
        })
    });
});
