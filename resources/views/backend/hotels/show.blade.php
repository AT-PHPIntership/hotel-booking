@extends('backend.layouts.main')
@section('title', __('Hotels managment'))
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      {{ __('Hotels managment') }}
      <small>
        {{ __('Hotel detail') }}
      </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
      <li class="active">{{ __('Hotel detail') }}</li>
    </ol>
  </section>
 <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        @include('flash::message')
      </div>
      <div class="col-md-5">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- slides images hotel-->
          <div class="carousel-inner">
          {{-- show default image when has no image --}}
            @if ($hotel->images->count() == 0)
                <div class="item active">
                  <img src="{{ asset(config('image.default_thumbnail')) }}">
                  <div class="carousel-caption">
                    <h3>{{ __("Hotel's images") }}</h3>
                  </div>
                </div>
            @endif
            {{-- show image --}}
            @foreach ($hotel->images as $hotelImage)
              <div class="item {{ ($hotelImage == $hotel->images[0])? 'active' : ''}}">
                <img src="{{ asset($hotelImage->path) }}">
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
      {{-- content left --}}
      <div class="col-md-7">
        {{-- hotel name --}}
        <h1>{{ $hotel->name }}</h1>
        {{-- hotel star --}}
        @for ($i = 0; $i < $hotel->star; $i++)
          <div class="glyphicon glyphicon-star inline"></div>
        @endfor
        {{-- show hotel infomation --}}
        <h4><a class="bg-faded" href="{{ route('place.show' , $hotel->place->id) }}">{{ __('Place: ') . $hotel->place->name }}</a></h4>
        <h5>{{ __('Address: ') . $hotel->address }}</h5>
        <div class="cls-introduce-hotel">
          {{ __('Introduce: ' . strip_tags($hotel->introduce)) }}
        </div>
        <h3>{{ __('Services: :totalServices.', ['totalServices' => $hotel->hotelServices->count() ]) }}</h3>
        <ul>
          @foreach ($hotel->hotelServices as $hotelService)
            <div class="col-md-3 pull-left">
              <li>{{ $hotelService->service->name }}</li>
            </div>
          @endforeach
        </ul>
        <div class="clearfix"></div>
        <h3><a href="{{ route('room.index', $hotel->id) }}">{{ __('Total rooms: :total.', ['total' => $totalRooms]) }}</a></h3>
      </div>
      <div class="box-footer">
        <a class="btn btn-primary btn-custom pull-right" href="{{ route('hotel.edit', $hotel->id) }}">
          {{ __('Edit hotel') }}
        </a>
        <a class="btn btn-default btn-custom pull-right" href="javascript:history.back()">
          {{ __('Back') }}
        </a>
      </div>
    </div>
     <!-- /.row -->
  </section>
</div>
@endsection
