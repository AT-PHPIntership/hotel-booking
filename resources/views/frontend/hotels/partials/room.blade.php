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
          <div id="room-detail-modal-{{ $room->id }}"
            class="modal fade" role="dialog">
            <div class="modal-dialog room-dialog-modal">
            {{-- room modal --}}
              <div class="modal-content room-modal-content">
                <div class="modal-header room-modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title cls-room-title">{{ __('Room :room detail', ['room' => $room->name]) }}</h4>
                </div>
                <div class="modal-body room-modal-body">
                 <div class="row">
                  <div class="col-xs-12 col-md-6">
                    {{-- slider --}}
                    <div id="container-{{ $room->id }}" class="contain-slider-img-room">
                      <div id="main-{{ $room->id }}" role="main">
                        @if ($room->images->count() == 0)
                          <div class="cls-show-room-no-img">
                            <img class="img-room-show" src="{{ asset(config('image.no_image')) }}">
                          </div>
                        @else
                          <section class="slider">
                            <div id="slider-{{ $room ->id }}"
                              class="flexslider">
                              <ul class="slides">
                                @foreach ($room->images as $roomImage)
                                  <li>
                                    <img class="cls-img-room-show" src="{{ asset($roomImage->path) }}" />
                                  </li>
                                @endforeach
                              </ul>
                            </div>
                            <div id="carousel-{{ $room ->id }}"
                              class="flexslider cls-slider-thumbnail">
                              <ul class="slides">
                                @foreach ($room->images as $roomImage)
                                  <li>
                                    <img class="cls-img-room-thumbnail" src="{{ asset($roomImage->path) }}" />
                                  </li>
                                @endforeach
                              </ul>
                            </div> 
                          </section>
                        @endif
                      </div>
                    </div>
                    {{-- end slider --}}
                  </div>
                  <div class="col-xs-12 col-md-6">
                    <h3 class="cls-room-info">
                      {{ __('Room Information') }}
                      <span class="cls-room-empty-title">
                      {{ __('(Only :number_room_empty room(s) left)', ['number_room_empty' => ($room->total - $room->quantity_busy_reservation)] ) }} 
                    </span>
                    </h3>
                    
                    <div class="room-detail-info">
                      <ul class="cls-list-room-info">
                        <li>{{ __('Room name: :room_name', ['room_name' => $room->name ])}}</li>
                        <li>{{ __('Quantity: :room_total', ['room_total' => $room->total ])}}</li>
                        <li>{{ __('Bed: :room_bed', ['room_bed' => $room->bed ])}}</li>
                        <li>{{ __('Direction: :room_direction', ['room_direction' => $room->direction ])}}</li>
                        <li>{{ __('Max guest: :max_guest', ['max_guest' => $room->max_guest ])}}</li>
                        <li>{{ __('Descript: :room_descript', ['room_descript' => $room->descript ])}}</li>
                      </ul>
                      <p class="cls-room-price text-center mt-20">
                       {{ __(':price $', ['price' => $room->price_format]) }}
                      </p>
                      <p class="text-center">
                        <a href="{{ route('reservations.create', $room->id) }}"  class="btn cls-btn-booking">
                          {{ __('Book Now') }}</a> 
                      </p>
                   </div>                           
                  </div>
                 </div>    
                        
                </div>
                <div class="modal-footer room-modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">{{ __('Back') }}</button>
                </div>
              </div>
            </div>
          </div>
          {{-- end  room  modal--}}
        </div>
        <div class="room-item-price">
          <h3 class="cls-room-price">{{ __(':price $', ['price' => $room->price_format]) }} </h3>
        </div>
        <div class="room-item-booking">
            @if($totalRoomEmpty == 0)
              <p class="cls-no-vacancies">
                {{ __('We have no vacancies left.') }}
              </p>
            @else
              <a href="{{ route('reservations.create', $room->id) }}"  class="btn cls-btn-booking">
                {{ __('Book Now') }}</a> 
              <p class="cls-has-vacancies"> 
                {{ __('Only :number_room_empty room(s) left', ['number_room_empty' => $totalRoomEmpty]) }} 
              </p>
            @endif
        </div>
      </div>
    @endforeach 
  @endif    
</section>
