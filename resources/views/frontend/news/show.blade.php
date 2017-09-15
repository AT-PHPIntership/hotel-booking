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
          <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" > 
          <!-- Default Image --> 
            <img src="{{ asset(config('image.bg_news')) }}" alt="slidebg1"  data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat" width="100%" height="450px"> 
          </li>
        
        @if (isset($news->images))
          <div class="col-md-6 col-md-offset-3 img-inner">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
              <!-- slides images hotel-->
              <div class="carousel-inner">
                @foreach ($news->images as $image)
                  <div class="item {{ ($image == $news->images[0])? 'active' : ''}}">
                    <img src="{{ asset($image->path) }}">
                  </div>
                @endforeach
              </div>
              <!-- slider controls -->
              <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left"></span>
                <span class="sr-only">{{ __('Previous') }}</span>
              </a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right"></span>
                <span class="sr-only">{{ __('Next') }}</span>
              </a>
            </div>
          </div>
        @endif
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
      <div class="col-md-12 reservation-horizontal clearfix container-search mt-20 content">           
        {{ $news->content }}
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
