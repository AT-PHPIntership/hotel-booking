@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/searchHotel.css')}}">
@endsection
@section('title', __('News'))
@section('content')
  <main class="main">
 <!-- Main content -->
  <section class="content mt-20">
    <div class="row cls-mb-5">
      @if (isset($news[0]))
        <div class="col-md-6">
          <a href="{{ route('frontend.news.show', $news[0]->slug) }}">
            <div class="image-news-show">
              <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- slides images news-->
                <div class="carousel-inner">
                {{-- show default image when has no image --}}
                  @if (!isset($news[0]->images[0]))
                      <div class="item active">
                        <img src="{{ asset(config('image.default_thumbnail')) }}">
                        <div class="carousel-caption">
                          <h3>{{ __("News's images") }}</h3>
                        </div>
                      </div>
                  @else
                    {{-- show image --}}
                    @foreach ($news[0]->images as $image)
                      <div class="item {{ ($image == $news[0]->images[0]) ? 'active' : ''}}">
                        <img src="{{ asset($image->path) }}" class="img-slide">
                      </div>
                    @endforeach
                  @endif
                </div>
                <!-- slider controls -->
                <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left"></span>
                </a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </div>
            </div>
          </a>
          <div class="summary-content-news-show">
            <h2 class="text-center text-success"><a href="{{ route('frontend.news.show', $news[0]->slug) }}">{{ contentLimit($news[0]->title) }}</a></h2>
            <p>{!! contentLimit(strip_tags($news[0]->content), 195) !!}</p>
          </div>
        </div>
      @endif
      {{-- content right --}}
      <div class="col-md-6 border-left border-top">
        <h2 class="text-danger text-center mt-20">{{ __('TOP NEWS') }}</h2>
        @foreach ($news as $key => $item)
          @if ($key != 0)
            <div class="mt-20">
              <div class="col-md-5">
                <a href="{{ route('frontend.news.show', $item->slug) }}"><img src="{{ isset($item->images[0]) ? asset($item->images[0]->path) : asset(config('image.no_image')) }}" class="img-news"></a>
              </div>
              <div col-md-8>
                <div class="img-news">
                  <h4><a href="{{ route('frontend.news.show', $item->slug) }}"> {{ contentLimit($item->title) }}</a></h4>
                  <p>{!! contentLimit(strip_tags($item->content)) !!}</p>
                </div>
              </div>
            </div>
          @endif
        @endforeach
      </div>
    </div>
     <!-- /.row -->
  </section>

  @foreach ($categories as $category)
    <section class="rooms mt50 border-left">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="lined-heading"><a href="{{ route('categories.news', $category->slug) }}"><span class="pull-left tranY-50">{{ $category->name }}</span></a></h2>
          </div> 
        </div>
        @foreach ($category->news as $key => $itemNews)
          <div class="col-md-3 cls-mb-20">
            <a href="{{ route('frontend.news.show', $itemNews->slug) }}">
              <div class="second-place news">
                <img src="{{ isset($itemNews->images[0]) ? asset($itemNews->images[0]->path) : asset(config('image.no_image')) }}" alt="topPlace" class="img-news news"/>  
                <div class="second-place-bottom news"> 
                  <h5>{{ contentLimit($itemNews->title) }}</h5>
                </div>
              </div>
            </a>
          </div>
        @endforeach
        @if($category->news->count() == App\Model\News::ITEM_LIMIT)
          <a href="">
            <button class="btn btn-primary pull-right mr-10 mt-10">{{ __('Read more') }}</button>
          </a>
        @endif
        </div>
    </section>
  @endforeach
  <div class="text-center">{{ $categories->render() }}</div>
  </main>
@endsection
