@extends('frontend.layouts.master')
@section('customcss')
  <link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('content')
  <section class="cls-breadcrumb-effect">
    <div id="parallax-pagetitle" >
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb cls-breadcrumb">
              <li><a href="{{ route('home.index') }}">{{ __('Home') }}</a></li>
              <li><a href="#">{{ $hotel->place->name }}</a></li>
              <li class="active">{{ $hotel->name }}</li>        
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container mt50 clearfix">
    <div class="row"> 
      <!-- Slider -->
      <section class="standard-slider hotel-slider">
        <div class="col-sm-12 col-md-8">
          <div id="owl-standard" class="owl-carousel">
            @foreach ($hotel->images as $hotelImage)
              <div class="item">
                <a href="" data-rel="prettyPhoto[gallery1]">
                  <img src="{{ asset($hotelImage->path) }}" class="img-responsive">
                </a> 
              </div>
            @endforeach    
          </div>
        </div>
      </section>
    
      {{-- Hotel infomation --}}
      <section id="reservation-form" class="mt50 clearfix">
        <div class="col-sm-12 col-md-4 cls-box-info-hotel">
          <h1>{{ $hotel->name }}</h1>
          <p>  
            @for ($i = 0; $i < $hotel->star; $i++)
              <span class="fa fa-star inline cls-star-hotel"></span>
            @endfor
          </p>
          <p><span>{{ __('Address: :address', ['address' => $hotel->address]) }} </span></p>
          @if($hotel->ratingComments->count() != 0 )
            <div class="cls-rating-hotel">
              <span class="cls-rating">
                <b class="cls-rating-point">{{ $hotel->round_avg_rating }}</b>{{ __('/10')}} 
              </span>
              <span class="cls-rating-label">{{ $hotel->label_rating }}</span>
            </div>
            <div class="count-rating-guest">
              <span>{{ __('According to') }} <strong>{{ $hotel->ratingComments->count() }}</strong> {{ __(' guests') }}</span>
            </div>
          @else
            <div class="count-rating-guest">
              <span><i class="no-rating">{{ __('There are no reviews yet')}}</i></span>
            </div> 
          @endif 

          <caption> <h3>{{ __('Services') }}</h3></caption>
          <div class="cls-list-service">
            <ul class="list-group row">
              @foreach ($hotel->hotelServices as $hotelService)
                <li class="list-group-item col-xs-6">
                  <i class="fa fa-check-circle cls-color-primary"></i>
                  <span class="ml-5">{{ $hotelService->service->name }}</span>
                </li>
              @endforeach
            </ul> 
          </div>  
        </div>
      </section>
     {{-- Hotel introduce --}}
      <section class="cls-introduce-hotel">
        <div class="cls-title-introduce-hotel"> <h2 class="introduce-hotel-label">{{ __('Introduce') }}</h2> </div>
        <div class="cls-body-introduce-hotel">{{ strip_tags($hotel->introduce) }}</div>
      </section>
     {{-- List-rooms --}}
      <section class="cls-list-room">
        @if ($hotel->rooms->count() == 0)
          <div class = "list-room">
            {{ __('Hotel not has room any ! Admin is updating !') }}
          </div>
        @else
          @foreach ($roomEmpty as $room)  
            <div class = "list-room">
              <div class = "room-image" >
                <img src="{{asset('frontend/images/roomdemo.jpg')}}">
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
                               {{ __(':price VND', ['price' => $room->price_format]) }}
                              </p>
                              <p class="text-center">
                                <a href="/room"  class="btn cls-btn-booking">
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
      <section class="clearfix">
        <div class="container">
          <div class="row">
            <div class="col-xs-12 col-md-6 left-rating">
              <div class="well well-sm">
                <div class="row" >
                  @if($hotel->ratingComments->count() != 0)
                    <div class="col-xs-12 col-md-6 text-center rating-box">
                      <h1 class="rating-num">{{ getRoundFloat($hotel->round_avg_rating) }}</h1>
                      <div class="count-rating-guest">
                        <span>{{ __('According to ') }}<strong>{{ $hotel->ratingComments->count() }}</strong> {{ __(' guests') }}</span>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="row rating-desc">
                        <div class="col-xs-3 col-md-3 text-right">
                          {{ __('Food') }}
                        </div>
                        <div class="col-xs-8 col-md-9">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-info" 
                              role="progressbar" 
                              aria-valuemin="0" aria-valuemax="100" 
                              style="width: {{ getProgressPercent($hotel->ratingComments->avg('food')) }}%">
                              <span class="sr-only">
                                {{ getRoundFloat(($hotel->ratingComments->avg('food'))) }}
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="row rating-desc">
                        <div class="col-xs-3 col-md-3 text-right">
                          {{ __('Cleanliness') }}
                        </div>
                        <div class="col-xs-8 col-md-9">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-info" 
                              role="progressbar" aria-valuenow="20"
                              aria-valuemin="0" aria-valuemax="100" 
                              style="width: {{ getProgressPercent($hotel->ratingComments->avg('cleanliness')) }}%">
                              <span class="sr-only">
                                {{ getRoundFloat(($hotel->ratingComments->avg('cleanliness')))}}
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="row rating-desc">
                        <div class="col-xs-3 col-md-3 text-right">
                          {{ __('Location') }}
                        </div>
                        <div class="col-xs-8 col-md-9">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-info" 
                              role="progressbar" aria-valuenow="20"
                              aria-valuemin="0" aria-valuemax="100" 
                              style="width: {{ getProgressPercent($hotel->ratingComments->avg('location')) }}%">
                              <span class="sr-only">
                                {{ getRoundFloat(($hotel->ratingComments->avg('location'))) }}
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="row rating-desc">
                        <div class="col-xs-3 col-md-3 text-right">
                          {{ __('Service') }}
                        </div>
                        <div class="col-xs-8 col-md-9">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-info" 
                              role="progressbar" aria-valuenow="20"
                              aria-valuemin="0" aria-valuemax="100" 
                              style="width: {{ getProgressPercent($hotel->ratingComments->avg('service')) }}%">
                              <span class="sr-only">
                                {{ getRoundFloat(($hotel->ratingComments->avg('service'))) }}
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                      <div class="row rating-desc">
                        <div class="col-xs-3 col-md-3 text-right">
                          {{ __('Comfort') }}
                        </div>
                        <div class="col-xs-8 col-md-9">
                          <div class="progress progress-striped">
                            <div class="progress-bar progress-bar-info" 
                              role="progressbar" aria-valuenow="20"
                              aria-valuemin="0" aria-valuemax="100" 
                              style="width: {{ getProgressPercent($hotel->ratingComments->avg('comfort')) }}%">
                              <span class="sr-only">
                                {{ getRoundFloat(($hotel->ratingComments->avg('comfort'))) }}
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @else 
                    <div class="col-xs-12 text-center rating-box">
                      <h4 class="text-left">
                        <i class="no-rating">{{ __('There are no reviews yet. Do you want to be the first to comment?')}}
                        </i>
                      </h4>  
                    </div>    
                  @endif 
                </div> 
              </div>
              <div class="comment-old">
                <form action="">
                  <textarea class="your-comment" placeholder="{{ __('Write your comment.....') }}"></textarea>
                  <button class="btn btn-primary" type="submit">{{ __('Submit') }}</button>
                </form>
              </div>
            </div>
            <div class="col-xs-12 col-md-6">
              <div class="cls-contain-comment">
                <h3>{{ __('Comment ( :count_comment )', ['count_comment' => $hotel->ratingComments->count()] ) }}</h3>
                @if($hotel->ratingComments->count() != 0)
                  @foreach ($ratingComments as $comment) 
                    <div class="col-md-12 comment-old">
                      <div class="total-rating-circle">
                        <span class="cls-value-rating">{{ getRoundFloat($comment->total_rating) }}</span>
                      </div>
                      <h4 class="cls-username-comment">{{ $comment->user->username }}</h4>
                      <p class="cls-comment-content">{{ $comment->comment }}
                      </p>
                      <p class="cls-comment-at">
                      {{ $comment->created_at }} </p>
                    </div>
                  @endforeach  
                  {{ $ratingComments->render() }}
                @else 
                  <div class="col-md-6">
                    {{ __('No comments for this hotel.') }}
                  </div>   
                @endif    
              </div>
            </div>
          </div>
          {{-- end row --}}
        </div>
      </section>
    </div>
  </div>
@endsection
<script type="text/javascript">
  console.log(1);
</script>