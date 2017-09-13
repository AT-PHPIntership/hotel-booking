@extends('backend.layouts.main')

@section('title', __('SHOW USER'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    @if(isset($user))
      <section id="content">
        <div class="col-md-12 profile">
          <div class="col-md-4 text-center">
            <img alt="user-profile" class="img-circle"
               src="{{ asset('images/default/profile.png') }}">
            <input type="text" class="form-control text-center fz-20 mt-20" name="username" value="{{ $user->username }}" readonly>
            <div class="mt-20">
              <a href="{{ URL::previous() }}">
                <button type="button" class="btn btn-warning btn-custom btn-lg">{{ __('Back') }}</button>
              </a>
              <a href="{{ route('user.edit', $user->id) }}">
                <button type="button" class="btn btn-primary btn-custom btn-lg ml-5per">{{ __('Edit') }}</button>
              </a>
            </div>
          </div>
          <div class="col-md-8 mt-20">
            <div class="title-header text-center">
              {{ __('User Information') }}
            </div>
            <div class="col-md-12">
              <div class="col-md-2 fz-16 mt-20">{{ __('Full name') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20">{{ $user->full_name }}</div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2 fz-16 mt-20">{{ __('Email') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20">{{ $user->email }}</div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2 fz-16 mt-20">{{ __('Phone') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20">{{ $user->phone }}</div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="col-md-2 fz-16 mt-20">{{ __('Role') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20 col-md-offset-2">{{  $user->role }}</div>
              </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
              <div class="col-md-2 fz-16 mt-20">{{ __('Status') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20 col-md-offset-2">{{ $user->status }}</div>
              </div>
            </div>
            <i class="mt-20 fz-20 col-md-5 ml-5per" >{{ __(' Times rating comments: ') . $user->ratingComments->count() }}</i>
            <i class="mt-20 fz-20 col-md-5" >{{ __(' Times reservations: ') . $user->reservations->count() }}</i>
          </div>
        </div>
      </section>
    @else
        <h1 class="text-center title-page">{{ __('Nothing to show!') }}</h1>
    @endif
  </div>
@endsection
