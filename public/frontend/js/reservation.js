$(document).ready(function() {
    $('#submit').on('click',function(){
    	var checkin = $('input[name=checkin_date').val().split('-');
    	var	duration = parseInt($('select[name=duration]').val());
    	var	checkinDate = new Date();
    	checkinDate.setDate(checkin[2]);
    	checkinDate.setMonth(checkin[1] -1);
    	checkinDate.setYear(checkin[0]);
    	checkout = new Date();
    	checkout.setDate(checkinDate.getDate() + duration);
    	$('input[name=checkout_date').val($.datepicker.formatDate('yy-mm-dd', checkout));
     	$('#booking-form').submit();
    });
});