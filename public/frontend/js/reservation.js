/**
 * Load total price
 */
function loadTotalPrice() { 
    var price = ($('#js-price-room').text()).split(':')[1];
    var quantity = ($('select[name=quantity').val());
    var duration = ($('select[name=duration').val());
    $('#js-price').text('$' + price);
    $('#js-quantity').text('x' + quantity);
    $('#js-duration').text(duration + ((duration == 1) ? ' night' : ' nights'));
    $('#js-price-total').text('$ ' + price*quantity*duration);
}
$(document).ready(function() {
    $('#submit').on('click',function(){
        $('#booking-form').submit();
    });
    loadTotalPrice();

    $('#booking-form').change(function(){
        loadTotalPrice();
    });
    $('#request').keyup(function(){
        var request = ($('#request').val());
        if (request.length > 0) {
            $('#js-note-request').show();
        } else {
            $('#js-note-request').hide(); 
        }
    });
});
