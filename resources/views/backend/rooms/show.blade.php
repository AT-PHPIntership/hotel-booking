@extends('backend.layouts.main')
@section('title', __('SHOW ROOM'))
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1 class="text-center">
      {{ __('HOTEL NAME: ') }}<a href="{{ route('hotel.show', $hotel->id) }}">{{ $hotel->name }}</a>
    </h1>
    </a>
    <h1>
      {{ __('Rooms managment') }}
      <small>
        {{ __('Room detail') }}
      </small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
      <li class="active">{{ __('Room detail') }}</li>
    </ol>
  </section>
 <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-5">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
          <!-- slides images room-->
          <div class="carousel-inner">
          {{-- show default image when has no image --}}
            @if (!isset($room->images[0]))
                <div class="item active">
                  <img src="{{ asset(config('image.default_thumbnail')) }}">
                  <div class="carousel-caption">
                    <h3>{{ __("Room's images") }}</h3>
                  </div>
                </div>
            @else
              {{-- show image --}}
              @foreach ($room->images as $roomImage)
                <div class="item {{ ($roomImage == $room->images[0]) ? 'active' : ''}}">
                  <img src="{{ asset($roomImage->path) }}" class="img-slide">
                </div>
              @endforeach
            @endif
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
      {{-- content right --}}
      <div class="col-md-7">
        {{-- room name --}}
        <h1>{{ $room->name }}</h1>
        {{-- show room infomation --}}
        {{-- hotel name --}}
        <h4>{{ __('Hotel: ') }}<a class="bg-faded" href="{{ route('hotel.show' , $hotel->id) }}">{{ $hotel->name }}</a></h4>
        {{-- Descript --}}
        <h5>{{ __('Descript: ') . $room->descript }}</h5>
        <h5>{{ __('Price: ') . $room->price }}</h5>
        <h5>{{ __('Size: ') . $room->size }}</h5>
        <h5>{{ __('Total: ') . $room->total }}</h5>
        <h5>{{ __('Bed: ') . $room->bed }}</h5>
        <h5>{{ __('Direction: ') . $room->direction }}</h5>
        <h5>{{ __('Max guest: ') . $room->max_guest }}</h5>
      </div>
      <div class="box-footer">
        <a class="btn btn-primary btn-custom pull-right" href="{{ route('room.edit', [$hotel->id, $room->id]) }}">
          {{ __('Edit room') }}
        </a>
        <a class="btn btn-default btn-custom pull-right" href="{{ URL::previous() }}">
          {{ __('Back') }}
        </a>
      </div>
    </div>
     <!-- /.row -->
  </section>
</div>
@endsection
