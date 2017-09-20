@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/searchHotel.css')}}">
@endsection
@section('title', __('NEWS FOR CATEGORY'))
@section('content')
  <main class="main">
    <section class="rooms mt50">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="lined-heading"><span>{{ __('List news of :name', ['name' => $category->name]) }}</span></h2>
          </div> 
          <!-- 3 place top -->
          @foreach($news as $itemNews)
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
      </div>
    </section>
    <div class="text-center">{{ $news->render() }}</div>
  </main>
@endsection