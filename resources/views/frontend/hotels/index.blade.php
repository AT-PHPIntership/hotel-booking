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
            <form class="reservation-horizontal clearfix container-search" name="reservationform" method="GET"  action="{{ route('hotels.index') }}">
            <div id="message"></div><!-- Error message display -->
              <div class="row">
               
                <div class="coltest add-one-col">
                  <label for="hotelSourceArea">{{ __('Place') }}</label>
                  <div class="popover-icon" data-toggle="tooltip" title="{{ __('Default all places') }}" data-trigger="hover" data-placement="right"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                  <input type="text" name="hotelSourceArea" id="hotelSourceArea" class="form-control" value="" placeholder="{{ __('Place to go') }}">
                  <div class="widgetAcResult" hidden>
                    
                  </div>
                </div>
                <div class="coltest add-one-col">
                  <div class="form-group">
                    <label for="checkin">{{ __('Check-in') }}</label>
                    <div class="popover-icon" data-toggle="tooltip" title="{{ __('Check-In is from 14:00') }}" data-trigger="hover" data-placement="right"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                    <input name="checkin" type="text" id="checkin" value="" class="form-control" placeholder="Check-in"/>
                  </div>
                </div>
                <div class="coltest small-col">
                  <div class="form-group">
                    <label for="duration">{{ __('Duration') }}</label>
                    <div class="popover-icon" data-toggle="tooltip" title="{{ __('Duration booking room') }}" data-trigger="hover" data-placement="right"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                    
                    <select name = "duration" class="btn btn-default">
                      @for($i = 1; $i <= App\Model\Reservation::MAX_DURATIONS; $i++)
                        <option value="{{ $i }}">{{ $i == 1 ? __('1 night') : __(':duration nights', ['duration' => $i]) }}</option>
                      @endfor
                    </select>
                  </div>
                </div>
                <div class="coltest big-col">
                  <div class="form-group">
                    <label for="arange_id">{{ __('Order By') }}</label>
                    <div class="popover-icon" data-toggle="tooltip" title="{{ __('Default is none') }}" data-placement="right"> <i class="fa fa-info-circle fa-lg"> </i> </div>
                    <select name = "arange_id" class="btn btn-default">
                      <option value="0">{{ __('--') }}</option>
                      <option value="1">{{ __('Price cheap to expensive') }}</option>
                      <option value="2">{{ __('Price expensive to cheap') }}</option>
                      <option value="3">{{ __('Star low to high') }}</option>
                      <option value="4">{{ __('Star high to low') }}</option>
                      <option value="5">{{ __('Rating high to low') }}</option>
                  </select>
                  </div>
                </div>
                <div class="btnSubmit">
                  <button type="submit" class="btn btn-primary btn-block">{{ __('Search') }}</button>
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
                    <a href="/detailHotel" class="btn btn-primary btn-block">{{ __('See Room') }}</a>
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