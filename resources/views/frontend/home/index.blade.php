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
              <a href="/detailHotel" class="button btn btn-purple btn-lg">{{ __('See More') }}</a> 
            </div>
          </li>
          <!-- Slide 2 -->
          <li data-transition="boxfade" data-slotamount="7" data-masterspeed="1000" > 
            <!-- Main Image -->
            @if($advertiseHotel->images->count() != null) 
            <img src="{{ $advertiseHotel->images->random()->path }}" style="opacity:0;" alt="slidebg1"  data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat">
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
              <a href="room-detail.html" class="button btn btn-purple btn-lg">{{ __('Booking room') }}</a> 
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
  <section class="rooms mt50">
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
          @if($count > 3)
            @break
          @endif
          <div class="col-sm-4">
            <div class="room-thumb">
              <img src="{{ (isset($place->image)) ? $place->image_url : asset(config('image.default_thumbnail')) }}" alt="topPlace" class="img-responsive"/>
              <div class="mask">
                <div class="main cls-with-max">
                  <div class="pull-left">
                    <a href=""><h5>{{ $place->name . ' |' }}</h5></a>
                  </div>
                  <div>
                    <a href="">
                      <h5 class="cls-text-color-primary">{{ __('More :totalHotels hotels', ['totalHotels' => $place->totalHotels]) }}</h5>
                    </a>
                  </div>
                </div>
                <div class="content">
                  <p>
                  <span>{{ __('Descript') }}</span>
                  {{ contentLimit(strip_tags($place->descript)) }}
                  </p>
                  <a href="" class="btn btn-primary btn-block mt50">{{ __('See More') }}</a>
                </div>
              </div>
            </div>
          </div> 
        @endforeach
      </div>
    </div>
  </section>

   <!-- 4 place top -->
  <section class="rooms mt50">
    <div class="container">
      <div class="row">
        <div class="col-sm-12"></div>
        @php($count = 0)
        @foreach($topPlaces as $place)
          @php($count++)
          @if($count < 4)
            @continue
          @endif
            <div class="col-sm-3">
              <div class="second-place">
                <img src="{{ (isset($place->image)) ? $place->image_url : asset(config('image.default_thumbnail')) }}" alt="topPlace" class="img-responsive"/>
                <div class="second-place-bottom"> 
                  <div class="pull-left">
                    <a href=""><h5><strong>{{ $place->name }}</strong></h5></a>
                  </div>
                  <div class="pull-right">
                    <a href="">
                      <h5 class="cls-text-color-primary cls-mr-20"><strong>{{ __('More :totalHotels hotels', ['totalHotels' => $place->totalHotels]) }}</strong></h5>
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
@if($topHotels->count() != null)
  <section class="rooms mt50">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="lined-heading"><span>{{ __('Representative Hotels') }}</span></h2>
        </div> 
        <!-- 6 hotel top -->
        @foreach($topHotels as $hotel)
          <div class="col-sm-4 mt50">
            <div class="room-thumb">
              <img src="{{ ($hotel->images->count() != 0) ? $hotel->images->random()->path : asset(config('image.default_thumbnail')) }}" alt="hotel" class="img-responsive"/>
              <div class="mask">
                <div class="main cls-with-max">
                  <div class="pull-left">
                    <a href=""><h5>{{ $hotel->name }}</h5></a>
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
                    <div class="col-xs-6">
                      <ul class="list-unstyled">
                      @php($count = 0)
                        @foreach($hotel->hotelServices as $hotelService)
                          @if($count == 3)
                                </ul>
                              </div>
                            <div class="col-xs-6">
                              <ul class="list-unstyled">
                          @endif
                          <li><i class="fa fa-check-circle"></i>{{ $hotelService->service->name }}</li>
                          @php($count++)
                        @endforeach
                      </ul>
                    </div>
                  </div>
                  <a href="" class="btn btn-primary btn-block">{{ __('Read More') }}</a>
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
        <h3>Beverages included</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. </p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="400">
      <div class="box-icon">
        <div class="circle"><i class="fa fa-credit-card fa-lg"></i></div>
        <h3>Stay First, Pay After!</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. </p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="800">
      <div class="box-icon">      
        <div class="circle"><i class="fa fa-cutlery fa-lg"></i></div>
        <h3>24 Hour Restaurant</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. </p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="1200">
      <div class="box-icon">
        <div class="circle"><i class="fa fa-tint fa-lg"></i></div>
        <h3>Spa Included!</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. </p>
        </div>
    </div>
    </div>
  </div>
</section>

<!-- Parallax Effect-->
<script type="text/javascript">$(document).ready(function(){$('#parallax-image').parallax("50%", -0.25);});</script>

<section class="parallax-effect mt100">
  <div id="parallax-image" style="background-image: url({{ asset('frontend/images/imglast.jpg') }};">
    <div class="color-overlay fadeIn appear" data-start="600">
      <div class="container">
        <div class="content">
          <h3 class="text-center"><i class="fa fa fa-star-o"></i> Snolax N., Inc.</h3>
          <p class="text-center">A product of the Snorlax N. company
      <br></p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
