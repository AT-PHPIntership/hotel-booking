<section class="cls-list-room">
  @if ($hotel->rooms->count() == 0)
    <div class = "list-room">
      {{ __('Hotel not has room any ! Admin is updating !') }}
    </div>
  @else
    @foreach ($roomEmpty as $room)  
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
          <h3 class="cls-room-price">{{ __(':price VND', ['price' => $room->price_format]) }} </h3>
        </div>
        <div class="room-item-booking">
          <a href="/room"  class="btn cls-btn-booking">
            {{ __('Book Now') }}</a> 
          <p class="cls-room-empty"> 
            {{ __('Only :number_room_empty room(s) left', ['number_room_empty' => ($room->total - $room->quantity_busy_reservation)] ) }} 
          </p>
        </div>
      </div>
    @endforeach 
  @endif    
</section>
