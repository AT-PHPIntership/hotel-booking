@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/searchHotel.css')}}">
@endsection
@section('title', __('LIST HOTELS'))
@section('content')
  <main class="main">
    <div class="container cls-mt-100">
      @include('frontend.layouts.partials.search')
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
              <div class="room-thumb"> <img src="{{ isset($hotel->images[0]) ? asset($hotel->images[0]->path) : asset(config('image.no_image')) }}" alt="hotel" class="img-presentive" />
                <div class="mask">
                  <div class="main">
                    <h5>{{ $hotel->name }}</h5>
                    <div class="ml-5per">
                      <div class="stars">
                        @for ($i = 0; $i < $hotel->star; $i++)
                          <label class="star bg-yellow"></label>
                        @endfor
                      </div>
                    </div>
                  </div>
                  <div class="content mt-10">
                    <p><span>{{ $hotel->place->name }}</p>
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
                            <li><i class="fa fa-check-circle"></i> {{ $hotelService->name }}</li>
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
                    <a href="{{ route('hotels.show',  ['slug' => $hotel->slug, 'duration' => request('duration'), 'checkin' => request('checkin')]) }}" class="btn btn-primary btn-block">{{ __('See Room') }}</a>
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