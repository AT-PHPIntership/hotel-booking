@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/searchHotel.css')}}">
@endsection
@section('customjs')
  <script type="text/javascript" src="{{ asset('frontend/js/reservation.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('frontend/js/app.trans.js') }}"></script> 
  <script type="text/javascript" src="{{ asset('frontend/js/app.lang_vi.js') }}"></script> 
@endsection
@section('title', __('Booking Rooms - :hotelName', ['hotelName' => $room->hotel->name]))
@section('content')
  <main class="main">
  @if (session('msg'))
    <div id="msg-booking" hidden="">{{ session('msg') }}</div>
    @include('frontend.booking.modal')
  @endif
    <div class="container">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <h2 class="mt50">{{ __('Hotel booking') }}</h2>
            <div class="alert alert-info" role="alert">
              @if(Auth::user())
                <p>{{ __('Welcome to booking rooms') }}</p>
              @else
                <a href="{{ route('login') }}" class="alert-link">{{ __('Log in') }}</a>
                <span>{{ __('to your account for easy access and other advantages.') }}</span>
              @endif
            </div>
          <h2 class="mt50">{{ __('Fill your infomation') }}</h2>
          <div class="col-md-8 nopadding">
            @include('flash::message')
          </div>
          <div class="cls-form-border-parent">
          {{-- input form --}}
            <form  id="booking-form" method="POST" class="cls-form-border col-md-8 form-group" action="{{ route('reservations.store', $room->id) }}" enctype="multipart/form-data">
              {!! csrf_field() !!}
              {{-- name --}}
              <div class="col-md-12 nopadding">
                <label for="full_name">{{ __("Contact's name") }}<i class="text-danger"> *</i></label>
                @if(Auth::user())
                  <input type="text" name="full_name" class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" value="{{ Auth::user()->full_name }}" readonly>
                @else
                  <input type="text" name="full_name" class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" placeholder="{{ __('Ex: Nguyen Van A') }}">
                @endif
                <span class="text-danger">{{ ($errors->first('full_name')) ? $errors->first('full_name') : '' }}</span>
              </div>
              {{-- phone --}}
              <div class="col-sm-4 nopadding mt20">
                <label for="phone">{{ __('Phone number') }}<i class="text-danger"> *</i></label>
                @if(Auth::user())
                  <input type="numberic" name="phone" class="form-control" " value="{{ Auth::user()->phone }}" readonly>
                @else
                  <input type="numberic" name="phone" class="form-control" placeholder="{{ __('Ex: +84 978 965 426') }}">
                @endif
                <span class="text-danger">{{ ($errors->first('phone')) ? $errors->first('phone') : '' }}</span>
              </div>
              <div class="col-sm-7 pull-right nopadding mt20">
                <label for="email">{{ __("Contact's email address") }}<i class="text-danger">*</i></label>
                @if(Auth::user())
                  <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                @else
                  <input type="email" name="email" class="form-control" placeholder="{{ __('Ex: nnnam@gmail.com') }}"> 
                @endif
                <span class="text-danger">{{ ($errors->first('email')) ? $errors->first('email') : '' }}</span>
              </div>
              {{-- checkin --}}
              <div class="col-sm-5 nopadding mt20">
                <label for="checkin">{{ __('Check-in') }}</label>
                <div class="popover-icon" data-toggle="tooltip" title="{{ __('Check-In is from 14:00') }}" data-trigger="hover" data-placement="right"> <i class="fa fa-info-circle fa-lg"></i></div>
                <input name="checkin" type="text" id="checkin" class="form-control{{ $errors->has('checkin') ? ' has-error' : '' }}" placeholder="{{ __('Check-in') }}" value="{{ isset($bookingInfomation) ? $bookingInfomation['checkin'] : '' }}" />
                 <small class="text-danger">{{ $errors->first('checkin') }}</small>
              </div>
              {{-- duration --}}
              <div class="col-sm-5 nopadding mt20 cls-ml-20">
                <label for="duration">{{ __('No. of night') }}<i class="text-danger">*</i></label>
                <select name = "duration" class="form-control">
                  @for($i = 1; $i <= App\Model\Reservation::MAX_DURATIONS; $i++)
                      <option value="{{ $i }}" {{ ($i == $bookingInfomation['duration']) ? 'selected' : '' }}>{{ $i == 1 ? __(':duration night', ['duration' => $i]) : __(':duration nights', ['duration' => $i]) }}</option>
                  @endfor
                </select>
                <small class="text-danger"></small>
              </div>
              <div class="col-sm-4 nopadding mt20">
                <label for="quantity">{{ __('No. of rooms') }}</label>
                <select name = "quantity" class="form-control">
                  @for($i = 1; $i <= $emptyRooms; $i++)
                      <option value="{{ $i }}">{{ $i == 1 ? __(':quantity room', ['quantity' => $i]) : __(':quantity rooms', ['quantity' => $i]) }}</option>
                  @endfor
                </select>
              </div>
              <div class="col-sm-12 nopadding mt20">
                <label for="request">{{ __('Special requests') }}</label>
                <textarea name="request" class="form-control" id="request"></textarea>
                <small class="text-info">{{ __("Special requests are subject to availability and may incur charges. For further details, you can contact the property directly.") }}</small>
              </div>
              {{-- hidden infor --}}
              <input type="hidden" name="status" value="{{ App\Model\Reservation::STATUS_PENDING }}">
              <input type="hidden" name="checkout_date">
              <input type="hidden" name="room_id" value="{{ $room->id }}">
              <input type="hidden" name="target" value="{{ (Auth::user()) ? App\Model\Reservation::TARGET_USER : App\Model\Reservation::TARGET_GUEST }}">
              <input type="hidden" name="target_id" value="{{ (Auth::user()) ? Auth::user()->id : '' }}">
              <input type="hidden" name="checkout_date">
            </form>
            <div class="cls-item-border pull-right">
              <div class="head-booking-detail cls-ml-20">
                <h5><strong>{{ __('Rooms infomation') }}</strong></h5>
              </div>
                <img class="cls-image-rooms" src="{{ ($room->images->count() != 0) ? asset($room->images->random()->path) : asset(config('image.default_thumbnail')) }}" alt="">
                <div class ="content-detail cls-ml-5-percent">
                  <h3>{{ $room->hotel->name }}</h3>
                  <span>
                    @for($i = App\Model\Hotel::STAR_MIN; $i <= App\Model\Hotel::STAR_MAX; $i++)
                      @if($i <= $room->hotel->star)
                          <i class="fa fa-star" aria-hidden="true"></i>
                      @else
                          <i class="fa fa-star-o"></i>
                      @endif
                    @endfor
                  </span> 
                </div>
                <div class="service-detail cls-ml-5-percent">  
                  @foreach($room->hotel->services as $service)
                    <span><i class="fa fa-check-circle cls-service"></i>{{ $service->name }}</span>
                  @endforeach
                </div>
                <div class= 'room-info cls-ml-5-percent mt20'>
                  <p>{{ __('Name: :name', ['name' => $room->name]) }}</p>
                  <p>{{ __('Size: :size', ['size' => $room->size]) }}</p>
                  <p>{{ __('Max guest: :max_guest', ['max_guest' => $room->max_guest]) }}</p>
                  <p id="js-price-room">{{ __('Price: :price', ['price' => $room->price]) }}</p>
                  <small class="text-danger">{{ __('(Has :emptyRooms empty rooms)', ['emptyRooms' => $emptyRooms]) }}</small>
                </div>   
              </div>
            </div>
            <div class="clearfix"></div>
            <h2 class="mt50">{{ __('Price details') }}</h2>
            <div class="cls-form-border col-md-8 form-group">
              <h3>{{ __('Price:') }}<span id="js-price" class="pull-right"></span></h3>
              <h3>{{ __('Quantity:') }}<span id="js-quantity" class="pull-right"></span></h3>
              <h3>{{ __('Duration:') }}<span id="js-duration" class="pull-right"></span></h3>
              <h3><strong>{{ __('Total Price:') }}<span id="js-price-total" class="pull-right"></span></strong></h3>
              <small id="js-note-request" class="text-danger" hidden>{{ __("Special requests are subject to availability and may incur charges. For further details, you can contact the property directly.") }}</small>
            </div>
            <div class="col-md-8 nopadding cls-mb-50">
              <button id="submit" class="btn btn-primary pull-right">{{ __('Submit') }} </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection