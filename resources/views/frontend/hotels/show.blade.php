@extends('frontend.layouts.master')
@section('customcss')
  <link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('content')
  <section class="parallax-effect">
    <div id="parallax-pagetitle" >
      <!-- Page title -->
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <ol class="breadcrumb cls-breadcrumb">
              <li><a href="{{ route('frontend.index') }}">{{ __('Home') }}</a></li>
              <li><a href="#">{{ $hotel->place->name }}</a></li>
              <li class="active">{{ $hotel->name }}</li>        
            </ol>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container mt50">
    <div class="row"> 
      <!-- Slider -->
      <section class="standard-slider hotel-slider">
        <div class="col-sm-12 col-md-8">
          <div id="owl-standard" class="owl-carousel">
            <div class="item"> <a href="" data-rel="prettyPhoto[gallery1]">
            @foreach ($hotel->images as $hotelImage)
              {{-- <div class="item {{ ($hotelImage == $hotel->images[0])? 'active' : ''}}"> --}}
                <img src="{{ asset($hotelImage->path) }}" class="img-responsive">>
              {{-- </div> --}}
            @endforeach
              {{-- <img src="{{ asset('frontend/images/hotel3.jpg') }}" alt="Image 2" class="img-responsive"> --}}
              </a> </div>
             
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
        <div class="cls-body-introduce-hotel">{{ $hotel->introduce }}</div>
      </section>
     {{-- List-rooms --}}
      <section class="cls-list-room">
        <!-- Modal -->
        
        @if ($hotel->rooms->count() == 0)
          <div class = "list-room">
            {{ __('Hotel not has room any ! Admin updating !') }}
          </div>
        @else
          @foreach ($hotel->rooms as $room)    
            <div class = "list-room">
              <div class = "room-image" >
                <img src="{{asset('frontend/images/roomdemo.jpg')}}">
              </div>
              <div class = "room-item">
                <h2 class = 'cls-room-name'>{{ $room->name }}</h2>
                <p>{{ __('Max guest: :max_guest', ['max_guest' => $room->max_guest]) }}</p>
                <p><a href="" class="cls-room-info" data-toggle="modal" data-target="#room-detail-modal">{{ __('Room information') }}</a></p>

                {{-- room modal --}}
                <div id="room-detail-modal" class="modal fade" role="dialog">
                  <div class="modal-dialog room-dialog-modal">

                    <!-- Modal content-->
                    <div class="modal-content room-modal-content">
                      <div class="modal-header room-modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{ __('Room :room detail', ['room' => $room->name]) }}</h4>
                      </div>
                      <div class="modal-body room-modal-body">
                        <table class="table ">
                          <tbody>
                            <tr>
                              <td>
                                <section class="standard-slider room-slider">
                                  <div class="col-sm-12 col-md-8">
                                    <div id="owl-standard" class="owl-carousel">
                                      <div class="item"> <a href="" data-rel="prettyPhoto[gallery1]">
                                      <img src="{{ asset('frontend/images/hotel3.jpg') }}" alt="Image 2" class="img-responsive"></a> </div>
                                      <div class="item"> <a href="images/rooms/slider/750x481.gif" data-rel="prettyPhoto[gallery1]">
                                      <img src="{{ asset('frontend/images/hotel3.jpg') }}" alt="Image 2" class="img-responsive"></a> </div>
                                    </div>
                                  </div>
                                </section>    
                              </td>
                              <td>Doe</td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="modal-footer room-modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                      </div>
                    </div>
                  </div>
                </div>
                {{-- end  room  modal--}}

              </div>
              <div class="room-item-price">
                <h3 class="cls-room-price">{{ __(':price VND', ['price' => $room->price]) }} </h3>
              </div>
              <div class="room-item-booking">
                <a href="/room"  class="btn cls-btn-booking">
                  {{ __('Book Now') }}</a> 
              </div>
            </div>
          @endforeach 
        @endif    
      </section>
 
      <section class="rating-comment">
        <div class="container">
          <div class="row">
              <div class="col-xs-12 col-md-6 left-rating">
                <div class="well well-sm" style="margin-top: 20px;">
                  <div class="row" >
                    @if($hotel->ratingComments->count() != 0)
                      <div class="col-xs-12 col-md-6 text-center rating-box">
                        <h1 class="rating-num">{{ $hotel->round_avg_rating }}</h1>
                        <div class="count-rating-guest">
                          <span>{{ __('According to') }}<strong>{{ $hotel->ratingComments->count() }}</strong> {{ __(' guests') }}</span>
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
                                style="width: {{ ($hotel->ratingComments->avg('food'))*10 }}%">
                                <span class="sr-only">{{ ($hotel->ratingComments->avg('food')) }}</span>
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
                                style="width: {{ ($hotel->ratingComments->avg('cleanliness'))*10 }}%">
                                <span class="sr-only">{{ ($hotel->ratingComments->avg('cleanliness'))}}</span>
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
                                style="width: {{ ($hotel->ratingComments->avg('location'))*10 }}%">
                                <span class="sr-only">{{ ($hotel->ratingComments->avg('location')) }}</span>
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
                            {{-- {{ dd($hotel->ratingComments->avg('location'))}} --}}
                              <div class="progress-bar progress-bar-info" 
                                role="progressbar" aria-valuenow="20"
                                aria-valuemin="0" aria-valuemax="100" 
                                style="width: {{ ($hotel->ratingComments->avg('service'))*10 }}%">
                                <span class="sr-only">{{ ($hotel->ratingComments->avg('service')) }}</span>
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
                                style="width: {{ ($hotel->ratingComments->avg('comfort'))*10 }}%">
                                <span class="sr-only">{{ ($hotel->ratingComments->avg('comfort')) }}</span>
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
            <div class="right-rating">
              <h3>{{ __('Comment') }}</h3>
              @if($hotel->ratingComments->count() != 0)
                @foreach ($hotel->ratingComments as $ratingComment) 
                  <div class="col-md-6 comment-old">
                    <img src="{{ asset('frontend/images/iconuser.png') }}" alt="usrs avatar" id="avatar">
                    {{-- @php (dd($ratingComment->user())) --}}
                    <h4 class="username">{{ $ratingComment->user->username }}</h4>
                    <p class="cls-comment-content">{{ $ratingComment->comment }}
                    </p>
                    <p class="cls-comment-at">
                    {{ $ratingComment->created_at }} </p>
                  </div>
                @endforeach  
              @else 
                <div class="col-md-6">
                  {{ __('No comments for this hotel.') }}
                </div>   
              @endif    
            </div>
          </div>
          {{-- end row --}}
        </div>
      </section>
    </div>
  </div>
@endsection
