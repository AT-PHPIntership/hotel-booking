@extends('backend.layouts.main')

@section('title', __('SHOW USER'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section id="content">
      <div class="col-md-12">
        <img src="{{ asset('images/users/hinh-nen-dep-10_044004.jpg') }}"
          class="img-bg-profile">
        <img src="{{ asset('images/users/profile-pictures.png') }}" class="img-profile">
      </div>
      <div class="profile-name">{{ $user->username }}</div>
      <div class="col-md-12 option-profile">
        <a href="{{ URL::previous() }}">
          <button type="button" class="btn btn-warning btn-custom btn-lg">{{ __('Back') }}</button>
        </a>
        <a href="{{ route('user.edit', $user->id) }}">
          <button type="button" class="btn btn-primary btn-custom btn-lg mr-l-5per">{{ __('Edit') }}</button>
        </a>
      </div>
      <div class="info-profile">
        <li class="item">
          <strong>
            {{ __('Full name') }}
          </strong>
          <div class="text-success">
            {{ $user->full_name }}
          </div>
        </li>
        <li class="item">
          <strong>
            {{ __('Email') }}
          </strong>
          <div class="text-success">
            {{ $user->email }}
          </div>
        </li>
        <li class="item">
          <strong>
            {{ __('Phone') }}
          </strong>
          <div class="text-success">
            {{ $user->phone }}
          </div>
        </li>
        <li class="item">
          <strong>
            {{ __('Role') }}
          </strong>
          <div class="text-success">
            @if ($user->is_admin == App\Model\User::ROLE_ADMIN)
              Admin
            @else
              User
            @endif
          </div>
        </li>
        <li class="item">
          <strong>
            {{ __('Status') }}
          </strong>
          <div class="text-success">
            @if ($user->is_active == App\Model\User::STATUS_ACTIVED)
              Actived
            @else
              Disabled
            @endif
          </div>
        </li>
      </div>
    </section>
  </div>

@endsection
