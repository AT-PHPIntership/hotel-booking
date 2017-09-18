@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('title', __('DETAIL NEWS'))
@section('content')

<!-- Introduce Slider -->
<section class="revolution-slider">
  <div class="bannercontainer">
    <div class="banner">
      <div>
          <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" > 
          <!-- Default Image --> 
            <img src="{{ asset(config('image.bg_news')) }}" alt="slidebg1"  data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat" class="bg-img-slide-news"> 
          </li>
          <div class="col-md-6 col-md-offset-3 img-inner">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- slides images hotel-->
              <div class="carousel-inner">
                <div class="item active">
                  <img src="{{ asset(config('image.bg_news')) }}" class="bg-img-slide-news">
                </div>
                <div class="item">
                  <img src="{{ asset(config('image.bginner_news')) }}" class="bg-img-slide-news">
                </div>
              </div>
              <!-- slider controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only"></span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only"></span>
              </a>
            </div>
          </div>
        </div>
    </div>
  </div>
</section>

{{-- content news --}}
<section id="reservation-form">
  <div class="container">
    <div class="row">
      <h2 class="col-md-12 reservation-horizontal clearfix container-search text-center text-success">           
        {{ $news->title }}
      </h2>
      <div class="col-md-12 reservation-horizontal clearfix container-search mt-20 content text-center">           
        {!! $news->content !!}
      </div>
    </div>
  </div>
</section>

<section class="rooms mt50 border-left">
  @if (isset($category->news[0]))
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="lined-heading"><a href="#"><span>{{ __('Relative news') }}</span></a></h2>
        </div> 
      </div>
      @foreach ($category->news as $key => $itemNews)
        <div class="col-md-3">
          <a href="{{ route('frontend.news.show', $itemNews->slug) }}">
            <div class="second-place news">
              <img src="{{ isset($itemNews->images[0]) ? asset($itemNews->images[0]) : asset(config('image.no_image')) }}" alt="topPlace" class="img-news news"/>  
              <div class="second-place-bottom news"> 
                <h5>{{ contentLimit($itemNews->title) }}</h5>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  @endif
</section>
@endsection
