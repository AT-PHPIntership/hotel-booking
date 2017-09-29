@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('title', $news->title)
@section('content')

<!-- Introduce Slider -->
<div style="background:#F2EDED;">
<section class="revolution-slider">
  <div class="bannercontainer">
    <div class="banner">
      <div>
          <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" > 
          <!-- Default Image --> 
            <img src="{{ asset(config('image.bginner_news1')) }}" alt="slidebg1"  data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat" class="bg-img-slide-news"> 
          </li>
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
        <div class="col-sm-12 nopadding">
          <h2 class="lined-heading"><a href="#"><span  class="relative-header align-center">{{ __('Relative news') }}</span></a></h2>
        </div> 
      </div>
      @foreach ($category->news as $key => $itemNews)
        <div class="col-md-3">
          <a href="{{ route('frontend.news.show', $itemNews->slug) }}">
            <div class="second-place news cls-mb-20">
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
</div>
@endsection
