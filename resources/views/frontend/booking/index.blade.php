@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/searchHotel.css')}}">
@endsection
@section('title', __('Booking rooms'))
@section('content')
  <main class="main">
    <div class="container">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-10">
          <h2 class="mt50">{{ __('Hotel booking') }}</h2>
          <div class="alert alert-info" role="alert">
            <a href="#" class="alert-link">{{ __('Log in') }}</a>
            <span>{{ __('to your account for easy access and other advantages.') }}</span>
          </div>
          <h2 class="mt50">{{ __('Fill your infomation') }}</h2>
          <div class="cls-form-border-parent">
          {{-- input form --}}
            <form role="form" method="POST" class="cls-form-border col-md-8 form-group" action="">
              {!! csrf_field() !!}
              {{-- name --}}
              <div class="col-md-12 nopadding">
                <label for="name">{{ __("Contact's name") }}<i class="text-danger"> *</i></label>
                <input type="text" name="name" class="form-control{{ $errors->has('name') ? ' has-error' : '' }}" placeholder="{{ __('Ex: Nguyen Van A') }}">
                <small class="text-danger">{{ $errors->first('username') }}</small>
              </div>
              {{-- phone --}}
              <div class="col-sm-4 nopadding mt20">
                <label for="phone">{{ __('Phone number') }}<i class="text-danger"> *</i></label>
                <input type="numberic" name="phone" class="form-control" placeholder="{{ __('Ex: +84 978 965 426') }}">
                <small class="text-danger">{{ $errors->first('phone') }}</small>
              </div>
              <div class="col-sm-7 pull-right nopadding mt20">
                <label for="email">{{ __("Contact's email address") }}<i class="text-danger"> *</i></label>
                <input type="email" name="email" class="form-control" placeholder="{{ __('Ex: nnnam@gmail.com') }}">
                <small class="text-danger">{{ $errors->first('email') }}</small>
              </div>
              {{-- checkin --}}
              <div class="col-sm-5 nopadding mt20">
                <label for="checkin">{{ __('Check in') }}<i class="text-danger"> *</i></label>
                <input type="date" name="checkin" class="form-control">
                <small class="text-danger">{{ $errors->first('checkin') }}</small>
              </div>
              <div class="col-sm-5 nopadding mt20 cls-ml-20">
                <label for="checkout">{{ __('Check out') }}<i class="text-danger"> *</i></label>
                <input type="date" name="checkout" class="form-control">
                <small class="text-danger"></small>
              </div>
              <div class="col-sm-2 nopadding mt20">
                <label for="rooms">{{ __('No. of rooms') }}</label>
                <input type="number" class="form-control">
              </div>
              <div class="col-sm-12 nopadding mt20">
                <label for="special-request">{{ __('Special requests') }}</label>
                <textarea name="special-request" class="form-control"></textarea>
                <small class="text-info">{{ __("Special requests are subject to availability and may incur charges. For further details, you can contact the property directly.") }}</small>
              </div>
            </form>
            <div class="cls-item-border pull-right">
                <img class="cls-image-rooms" src="{{ asset(config('image.default_thumbnail')) }}" alt="">
                <div class="cls-ml-20">
                  <h4>{{ __('Hotel name:') }}</h4>
                  <h4>{{ __('Rooms name:') }}</h4>
                  <h4>{{ __('Quanlity:') }}</h4>
                  <h4>{{ __('Rooms name:') }}</h4>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <h2 class="mt50">{{ __('Price details') }}</h2>
            <div class="cls-form-border col-md-8 form-group">
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
@endsection