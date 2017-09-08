@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/searchHotel.css')}}">
@endsection
@section('title', __('LIST HOTELS'))
@section('content')
  <main class="main">
    <section id="reservation-form" class="mt-0">
      <div>
        <div class="row">
          <div class="col-md-12">           
            <form class="reservation-horizontal clearfix container-search" action="/search" name="reservationform" >
            <div id="message"></div><!-- Error message display -->
              <div class="row">
               
                <div class="coltest add-one-col">
                  <div class="form-group">
                    <label for="room">Place</label>
                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Vivamus sagittis lacus vel augue laoreet rutrum faucibus."> <i class="fa fa-info-circle fa-lg"> </i> </div>
                    <select name = "place_id" class="btn btn-primary">
                      <option>{{ __('All hotel') }}</option>
                      @foreach($topPlaces as $place)
                        <option value="{{$place->id}}">{{$place->name}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="coltest add-one-col">
                  <div class="form-group">
                    <label for="checkin">Check-in</label>
                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                    <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in"/>
                  </div>
                </div>
                <div class="coltest add-one-col">
                  <div class="form-group">
                    <label for="checkout">Check-out</label>
                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                    
                    <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out"/>
                  </div>
                </div>
                <div class="coltest add-one-col">
                  <div class="form-group">
                    <label for="checkin">Check-in</label>
                    <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-In is from 11:00"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                    <select name = "arange_id" class="btn btn-primary">
                      <option>{{ __('Arangement') }}</option>
                      <option value="{{$place->id}}">{{ __('Price cheap to expensive') }}</option>
                      <option value="{{$place->id}}">{{ __('Price expensive to cheap') }}</option>
                      <option value="{{$place->id}}">{{ __('Star low to high') }}</option>
                      <option value="{{$place->id}}">{{ __('Star high to low') }}</option>
                  </select>
                  </div>
                </div>
                <div class="btnSubmit">
                  <button type="submit" class="btn btn-primary btn-block">Search</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
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
                    <a href="/detailHotel" class="btn btn-primary btn-block">{{ __('Read More') }}</a>
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
