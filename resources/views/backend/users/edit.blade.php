@extends('backend.layouts.main')

@section('title', __('UPDATE USER'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="title-page text-success">
        {{ __('Update user') }}
      </h1>
      @include('flash::message')
      <div class="row margin-center">
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter information') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('user.update', $user->id) }}">
              {!! csrf_field() !!}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group">
                  <label for="username">{{ __('Username') }}</label>
                  <input type="text" class="form-control{{ $errors->has('username') ? ' has-error' : '' }}" name= "username" id="username" placeholder="{{ __('Enter username') }}" value="{{ old('username', $user->username) }}" readonly>
                  <small class="text-danger">{{ $errors->first('username') }}</small>
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">{{ __('Password') }}</label>
                  <input type="password" class="form-control" name= "password" id="password" placeholder="{{ __('Enter password if you want to change password') }}">
                  <small class="text-danger">{{ $errors->first('password') }}</small>
                </div>
                <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                  <label for="full_name">{{ __('Full name') }}</label>
                  <input type="text" class="form-control" name= "full_name" id="full_name" placeholder="{{ __('Enter full_name') }}"" value="{{ old('full_name', $user->full_name) }}"> 
                  <small class="text-danger">{{ $errors->first('full_name') }}</small>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">{{ __('Email') }}</label>
                  <input type="text" class="form-control" name= "email" id="email" placeholder="{{ __('Enter Your email') }}" data-toggle="tooltip" value="{{ old('email', $user->email) }}" readonly>
                  <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label for="phone">{{ __('Phone') }}</label>
                  <input type="text" class="form-control" name= "phone" id="phone" placeholder="{{ __('Enter Your phone') }}" value="{{ old('phone', $user->phone) }}">
                  <small class="text-danger">{{ $errors->first('phone') }}</small>
                </div>
                <div class="form-group col-md-6 pull-center">
                  <label for="is_active">{{ __('Is Active') }}</label>
                  @if (old('is_active', $user->is_active) == App\Model\User::STATUS_ACTIVED)
                    <input type="checkbox" name="is_active" value="{{ App\Model\User::STATUS_ACTIVED }}" checked>
                  @else
                    <input type="checkbox" name="is_active" value="{{ App\Model\User::STATUS_ACTIVED }}">
                  @endif
                </div>
                <div class="form-group col-md-6">
                  <label for="is_admin">{{ __('Is Admin') }}</label>
                  @if (old('is_admin', $user->is_admin) == App\Model\User::ROLE_ADMIN)
                    <input type="checkbox" name="is_admin" value="{{ App\Model\User::ROLE_ADMIN }}" checked>
                  @else
                    <input type="checkbox" name="is_admin" value="{{ App\Model\User::ROLE_ADMIN }}">
                  @endif
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('user.index') }}">
                  <button type="button" class="btn btn-default btn-custom">{{ __('Back') }}</button>
                </a>
                <button type="reset" class="btn btn-warning btn-custom">{{ __('Reset') }}</button>
                <button type="submit" class="btn btn-primary btn-custom pull-right">{{ __('Submit') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
