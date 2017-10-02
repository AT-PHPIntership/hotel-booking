@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('title', __('Home page'))
@section('content')

<!-- Introduce Slider -->
<section class="revolution-slider">
  <div class="bannercontainer">
    <div class="banner">
      <ul>
        <!-- Slide 1 -->
        @if($topHotels->count() != null)
          <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" > 
          <!-- Main Image -->
            @php($advertiseHotel = $topHotels->random())
            @if($advertiseHotel->images->count() != null) 
            <img src="{{ $advertiseHotel->images->random()->path }}" style="opacity:0;" alt="slidebg1"  data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat">
            @endif
          <!-- Layers -->           
          <!-- Layer 1 -->
            <div class="caption sft revolution-starhotel bigtext"  
                          data-x="505" 
                          data-y="30" 
                          data-speed="700" 
                          data-start="1700" 
                          data-easing="easeOutBack"> 
              <span>
                @for($i = App\Model\Hotel::STAR_MIN; $i <= App\Model\Hotel::STAR_MAX; $i++)
                  @if($i <= $advertiseHotel->star)
                      <i class="fa fa-star" aria-hidden="true"></i>
                  @else
                      <i class="fa fa-star-o"></i>
                  @endif
                @endfor
              </span> 
              {{ $advertiseHotel->name }} 
              <span>
                @for($i = App\Model\Hotel::STAR_MIN; $i <= App\Model\Hotel::STAR_MAX; $i++ )
                  @if($i <= $advertiseHotel->star)
                      <i class="fa fa-star" aria-hidden="true"></i>
                  @else
                      <i class="fa fa-star-o"></i>
                  @endif
                @endfor
              </span>
            </div>
          <!-- Layer 2 -->
            <div class="caption sft revolution-starhotel smalltext"  
                      data-x="682" 
                      data-y="105" 
                      data-speed="800" 
                      data-start="1700" 
                      data-easing="easeOutBack">
              <span>{{ __('Place: ') . $advertiseHotel->place->name }}</span>
            </div>
              <!-- Layer 3 -->
            <div class="caption sft"  
                  data-x="775" 
                  data-y="175" 
                  data-speed="1000" 
                  data-start="1900" 
                  data-easing="easeOutBack">
              <a href="{{ route('hotels.show', $advertiseHotel->slug) }}" class="button btn btn-purple btn-lg">{{ __('See More') }}</a> 
            </div>
          </li>
          <!-- Slide 2 -->
          <li data-transition="boxfade" data-slotamount="7" data-masterspeed="1000" > 
            <!-- Main Image -->
            @if($advertiseHotel->rooms->count() != null)
              @if($advertiseHotel->rooms->random()->images->count() != null) 
              <img src="{{ $advertiseHotel->rooms->random()->images->random()->path }}" style="opacity:0;" alt="slidebg1"  data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat">
              @endif 
            @endif
            <!-- Layers -->           
            <!-- Layer 1 -->
          <div class="caption sft revolution-starhotel bigtext"  
                data-x="585" 
                data-y="30" 
                data-speed="700" 
                data-start="1700" 
                data-easing="easeOutBack"> 
          {{ __('Room Diversity') }}
          </div>
          <!-- Layer 2 -->
            <div class="caption sft revolution-starhotel smalltext"  
                  data-x="682" 
                  data-y="105" 
                  data-speed="800" 
                  data-start="1700" 
                  data-easing="easeOutBack">
              <span>
                @if($advertiseHotel->rooms->count() != null)
                  {{ __('From $:min to $:max', ['min' => $advertiseHotel->rooms->min('price'), 'max' => $advertiseHotel->rooms->max('price')]) }}
                @endif
            </span>
            </div>
        <!-- Layer 3 -->
            <div class="caption sft"  
                data-x="785" 
                data-y="175" 
                data-speed="1000" 
                data-start="1900" 
                data-easing="easeOutBack">
              <a href="{{ route('hotels.show', $advertiseHotel->slug) }}" class="button btn btn-purple btn-lg">{{ __('Booking room') }}</a> 
            </div>
          </li>
        @else
          <p>{{ __('Sorry! The system is updating') }}</p>
        @endif
      </ul>
    </div>
  </div>
</section>

{{-- search form --}}
@include('frontend.layouts.partials.search')

<!-- Outstanding Places -->
  <section class="rooms mt50" id="top-3-places">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="lined-heading"><span>{{ __('Outstanding Places') }}</span></h2>
        </div> 
        @if($topPlaces->count() != null)
        <!-- 3 place top -->
        @php($count = 0)
        @foreach($topPlaces as $place)
          @php($count++)
          @if($count > (config('hotel.top-3-places')))
            @break
          @endif
          <div class="col-sm-4">
            <div class="room-thumb">
              <img src="{{ (isset($place->image)) ? $place->image_url : asset(config('image.default_thumbnail')) }}" alt="topPlace" class="img-presentive"/>
              <div class="mask">
                <div class="main cls-with-max">
                  <div class="pull-left">
                    <a href="{{ route('places.show', $place->slug) }}"><h5>{{ $place->name . ' |' }}</h5></a>
                  </div>
                  <div> 
                    <h5 class="cls-text-color-primary">{{ __('More :totalHotels hotels', ['totalHotels' => $place->hotels->count()]) }}</h5>
                  </div>
                </div>
                <div class="content">
                  <p>
                  <span>{{ __('Descript') }}</span>
                  {{ contentLimit(strip_tags($place->descript)) }}
                  </p>
                  <a href="{{ route('places.show', $place->slug) }}" class="btn btn-primary btn-block mt50">{{ __('See More') }}</a>
                </div>
              </div>
            </div>
          </div> 
        @endforeach
      </div>
    </div>
  </section>

   <!-- 4 place top -->
  <section class="rooms mt50" id="top-4-places">
    <div class="container">
      <div class="row">
        <div class="col-sm-12"></div>
        @php($count = 0)
        @foreach($topPlaces as $place)
          @php($count++)
          @if($count < (config('hotel.top-4-places')))
            @continue
          @endif
            <div class="col-sm-3">
              <div class="second-place">
                <img src="{{ (isset($place->image)) ? $place->image_url : asset(config('image.default_thumbnail')) }}" alt="topPlace" class="img-responsive"/>
                <div class="second-place-bottom"> 
                  <div class="pull-left">
                    <a href="{{ route('places.show', $place->slug) }}"><h5><strong>{{ $place->name }}</strong></h5></a>
                  </div>
                  <div class="pull-right">
                    <a href="">
                      <h5 class="cls-text-color-primary cls-mr-20"><strong>{{ __('More :totalHotels hotels', ['totalHotels' => $place->hotels->count()]) }}</strong></h5>
                    </a>
                  </div>
                </div>
              </div>
            </div>
         @endforeach
      </div>
      @else
        <p class="text-center">{{ __('Sorry! The system is updating') }}</p>
      @endif
    </div>
  </section>
<!-- top hotel -->
  <section class="rooms mt50" id="top-hotels">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="lined-heading"><span>{{ __('Representative Hotels') }}</span></h2>
        </div> 
        <!-- 6 hotels top -->
        @if($topHotels->count() != null)
        @foreach($topHotels as $hotel)
          <div class="col-sm-4 mt50">
            <div class="room-thumb">
              <img src="{{ ($hotel->images->count() != 0) ? $hotel->images->random()->path : asset(config('image.default_thumbnail')) }}" alt="hotel" class="img-presentive"/>
              <div class="mask">
                <div class="main cls-with-max">
                  <div class="pull-left">
                    <a href="{{ route('hotels.show', $hotel->slug) }}"><h5>{{ $hotel->name }}</h5></a>
                  </div>
                  <div class="pull-right cls-mr-20">
                    <a href="">
                      <h5 class="cls-text-color-primary">{{ round($hotel->total, 1) }}</h5>
                    </a>
                  </div>
                </div>
                <div class="content">
                 <p>
                    <span>{{ __('Introduce') }}</span>
                    {{ contentLimit(strip_tags($hotel->introduce)) }}
                  </p>
                  <div class="row">                        
                      @foreach($hotel->hotelServices as $key => $hotelService)
                        @if ($key < config('showitem.service_per_item'))
                          @if ($key == 0 || $key == (config('showitem.service_per_item') / 2))
                            <div class="col-xs-6">
                              <ul class="list-unstyled">
                          @endif
                          @if (
                            $key == (config('showitem.service_per_item') -1)
                              &&
                            $hotel->hotelServices->count() > config('showitem.service_per_item')
                          )
                            <li><i class="fa fa-check-circle"></i> .......</li>
                          @else
                            <li><i class="fa fa-check-circle"></i> {{ $hotelService->service->name }}</li>
                          @endif
                          @if (
                            $key == (config('showitem.service_per_item') / 2 -1)
                            ||
                            $key == (config('showitem.service_per_item') - 1)
                            ||
                            $key == ($hotel->hotelServices->count() - 1)
                          )
                              </ul>
                            </div>
                          @endif
                        @endif
                      @endforeach
                    </div>
                  <a href="{{ route('hotels.show', $hotel->slug) }}" class="btn btn-primary btn-block">{{ __('Read More') }}</a>
                </div>
              </div>
            </div>
          </div> 
        @endforeach
      </div>
    </div>
  </section>
@else
  <p class="text-center">{{ __('Sorry! The system is updating') }}</p>
@endif
  <!-- end top hotel -->

<!-- Why should you choose us? -->
<section class="usp mt100">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>{{ __('Why should you choose us?') }}</span></h2>
      </div>
      <div class="col-sm-3 bounceIn appear" data-start="0">
      <div class="box-icon">
        <div class="circle"><i class="fa fa-glass fa-lg"></i></div>
        <h3>{{ __('Safe and Reputation') }}</h3>
        <p>{{ __('As a large reservation system, we always bring you the highest level of security and reliability') }}</p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="400">
      <div class="box-icon">
        <div class="circle"><i class="fa fa-credit-card fa-lg"></i></div>
        <h3>{{ __('Book First, Pay After!') }}</h3>
        <p>{{ __('With the top safety criteria, we offer you a variety of safe, fast and convenient payment options') }}</p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="800">
      <div class="box-icon">      
        <div class="circle"><i class="fa fa-cutlery fa-lg"></i></div>
        <h3>{{ __('Fast and Convenient') }}</h3>
        <p>{{ __('We always try to improve the booking system to bring you the fastest and most convenient') }}</p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="1200">
      <div class="box-icon">
        <div class="circle"><i class="fa fa-tint fa-lg"></i></div>
        <h3>{{ __('Diversity') }}</h3>
        <p>{{ __('Variety of rooms, hotels, venues bring you many choices, the best in price and pragmatic') }}</p>
        </div>
    </div>
    </div>
  </div>
</section>

<section class="parallax-effect mt100">
  <div id="parallax-image" style="background-image: url({{ asset('frontend/images/imglast.jpg') }};">
    <div class="color-overlay fadeIn appear" data-start="600">
      <div class="container">
        <div class="content">
          <h3 class="text-center"><i class="fa fa fa-star-o"></i>{{ __('Hotel Team .Inc') }}</h3>
          <p class="text-center">{{ __('A product of the TYND Group') }}
      <br></p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
