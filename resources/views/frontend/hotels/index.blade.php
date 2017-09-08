@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/searchHotel.css')}}">
@endsection
@section('title', __('LIST HOTELS'))
@section('content')
  <main class="main">
    <div class="row mt-20">    
        <div class="col-xs-8 col-xs-offset-2">
          <div class="input-group">
            <div class="input-group-btn search-panel">
              <select name = "place_id" class="btn btn-primary">
              <option>{{ __('All hotel') }}</option>
              @foreach($topPlaces as $place)
                <option value="{{$place->place->id}}">{{$place->place->name}}</option>
              @endforeach
            </select>
            </div>
            <input type="hidden" name="search_param" value="all" id="search_param">         
            <input type="text" class="form-control" name="x" placeholder="Search term...">
            <span class="input-group-btn">
                <button class="btn btn-primary" type="button"><i class="glyphicon glyphicon-search"></i></button>
            </span>
          </div>
        </div>
    </div>
    <section class="rooms mt50">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="lined-heading"><span>{{ __('List Hotels') }}</span></h2>
          </div> 
          <!-- 3 place top -->
          @foreach($hotels as $hotel)
            <div class="col-sm-4">
              <div class="room-thumb"> <img src="{{ isset($hotel->images[0])? asset($hotel->images[0]->path): asset(config('image.no_image')) }}" alt="hotel" class="img-presentive" />
                <div class="mask">
                  <div class="main">
                    <h5>{{ $hotel->name }}</h5>
                    <div class="price">® ® ® ® </div>
                  </div>
                  <div class="content">
                    <p><span>{{ $hotel->place->name }}</p>
                    <div class="row">                        
                      @foreach($hotel->hotelServices as $key => $hotelService)
                        @if ($key < 6)
                          @if ($key == 0 || $key == 3)
                            <div class="col-xs-6">
                              <ul class="list-unstyled">
                          @endif
                          @if ($key == 5 && $hotel->hotelServices->count() > 6)
                            <li><i class="fa fa-check-circle"></i> .......</li>
                          @else
                            <li><i class="fa fa-check-circle"></i> {{ $hotelService->name }}</li>
                          @endif
                          @if ($key == 2 || $key == 5 ||$key == ($hotel->hotelServices->count() - 1))
                              </ul>
                            </div>
                          @endif
                        @endif
                      @endforeach
                    </div>
                    <a href="/detailHotel" class="btn btn-primary btn-block">Read More</a>
                  </div>
                </div>
              </div>
            </div> 
          @endforeach
        </div>
      </div>
    </section>
    <div class="text-center">{{$hotels->render()}}</div>
  </main>
@endsection
