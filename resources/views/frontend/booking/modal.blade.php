<div class="modal fade cls-modal-booking" id="booking-modal" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-body">
        <div class="col-md-5">
          <img class="img-circle img-responsive" src="{{ asset('frontend/images/booking-ss-tynd.png') }}" alt="">
        </div>
        <p class="cls-modal-booking-text text-center text-primary">{{ __('You have successfully booked!') }}</p>
        <p class="text-center text-primary">{{ __('Thank you for trusting and traveling with us!') }}</p>
      </div>
      <div class="modal-footer cls-modal-booking-footer">
        <a href="{{ route('home.index') }}" class="btn btn-primary">{{ __('Yes, I known') }}</a>
      </div>
    </div>
    
  </div>
</div>