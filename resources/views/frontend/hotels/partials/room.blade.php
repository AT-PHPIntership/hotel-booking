<section class="cls-list-room">
  <div class="cls-info-arrange-time alert alert-info">
    <p class="cls-checkin-checkout-date">
      {{ __('List vacancies from :checkin to :checkout .',
       ['checkin' => formatDateTimeToDate($checkinDateDefault),
        'checkout' => formatDateTimeToDate($checkoutDateDefault)]) }}
    </p>
  </div>
  @if ($hotel->rooms->count() == 0)
    <div class = "list-room">
      {{ __('Hotel not has room any ! Admin is updating !') }}
    </div>
  @else
    @foreach ($roomEmpty as $room)  
      @php($totalRoomEmpty = $room->total - $room->quantity_busy_reservation)
      <div class = "list-room">
        <div class = "room-image" >
          <img src="{{ isset($room->images[0])? asset($room->images[0]->path): asset(config('image.no_image')) }}">
        </div>
        <div class = "room-item">
          <h2 class = 'cls-room-name'>{{ $room->name }}</h2>
          <p>{{ __('Max guest: :max_guest', ['max_guest' => $room->max_guest]) }}</p>
          <p><a href="" class="cls-room-info link-room-info" data-toggle="modal" data-target="#room-detail-modal-{{ $room->id }}" data-id='{{ $room->id }}'>{{ __('Room information') }}</a></p>
        </div>
        <div class="room-item-price">
          <h3 class="cls-room-price">{{ __(':price $', ['price' => $room->price_format]) }} </h3>
        </div>
        <div class="room-item-booking">
          <a href="/room"  class="btn cls-btn-booking">
            {{ __('Book Now') }}</a> 
            @if($totalRoomEmpty == 0)
              <p class="cls-no-vacancies">
                {{ __('We have no vacancies left.') }}
              </p>
            @else
              <p class="cls-has-vacancies"> 
                {{ __('Only :number_room_empty room(s) left', ['number_room_empty' => $totalRoomEmpty]) }} 
              </p>
            @endif
        </div>
      </div>
    @endforeach 
  @endif    
</section>
