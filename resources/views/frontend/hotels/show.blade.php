@extends('frontend.layouts.master')
@section('customcss')
  <link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('title', __(':hotel Hotel', ['hotel' => $hotel->name]))
@push('css')
  <link rel="stylesheet" href="{{ asset('frontend/css/flexslider.css') }}" type="text/css" media="screen" />
@endpush
@push('scripts')
  <script defer src="{{ asset('frontend/js/jquery.flexslider.js') }}"></script>
@endpush
@section('content')
  @php ($countComment = $hotel->ratingComments->count())
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
            @if ($hotel->images->count() == 0)
              <div class="item">
                <img src="{{ asset(config('image.no_image')) }}"
                  class="img-responsive cls-no-img-hotel">
              </div>
            @else
              @foreach ($hotel->images as $hotelImage)
                <div class="item">
                  <img src="{{ asset($hotelImage->path) }}" class="img-responsive">
                </div>
              @endforeach
            @endif      
          </div>
        </div>
      </section>
    
      {{-- Hotel infomation --}}
      <section class="mt50 clearfix">
        <div class="col-sm-12 col-md-4 cls-box-info-hotel">
          <h1>{{ $hotel->name }}</h1>
          <p>  
            @for ($i = 0; $i < $hotel->star; $i++)
              <span class="fa fa-star inline cls-star-hotel"></span>
            @endfor
          </p>
          <p><span>{{ __('Address: :address', ['address' => $hotel->address]) }} </span></p>
          @if($countComment != 0 )
            <div class="cls-rating-hotel">
              <span class="cls-rating">
                <b class="cls-rating-point">{{ $hotel->round_avg_rating }}</b>{{ __('/10')}} 
              </span>
              <span class="cls-rating-label">{{ $hotel->label_rating }}</span>
            </div>
            <div class="count-rating-guest">
              <span>{{ __('According to') }} <strong>{{ $countComment }}</strong> {{ __(' guests') }}</span>
            </div>
          @else
            <div class="count-rating-guest">
              <span><i class="no-rating">{{ __('There are no reviews yet')}}</i></span>
            </div> 
          @endif 

          <caption> <h3>{{ __('Services') }}</h3></caption>
          <div class="cls-list-service">
            <ul class="list-group row"> 
              @foreach ($services as $service)
                <li class="list-group-item col-xs-6">
                  <i class="fa fa-check-circle cls-color-primary"></i>
                  <span class="ml-5">{{ $service->name }}</span>
                </li>
              @endforeach
            </ul> 
          </div>  
        </div>
      </section>
     {{-- Hotel introduce --}}
      <section class="cls-introduce-hotel">
        <div class="cls-title-introduce-hotel"> <h2 class="introduce-hotel-label">{{ __('Introduce') }}</h2> </div>
        <div class="cls-body-introduce-hotel">{!! $hotel->introduce !!}</div>
      </section>
      @include('frontend.hotels.partials.room')
      @include('frontend.hotels.partials.rating_comment')
    </div>
  </div>
@endsection
