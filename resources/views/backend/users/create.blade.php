@extends('backend.layouts.main')

@section('title', __('CREATE USER'))

@section('content')
 <div class="content-wrapper">
      <h1 class="title_page text-success">
        @include('flash::message')
        {{ __('Create user') }}
      </h1>

    <!-- Main content -->
    <section class="content">
      <div class="row margin_center">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter information') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('user.store') }}">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group">
                  <label for="username">{{ __('Username') }}</label>
                  <input type="text" class="form-control{{ $errors->has('username') ? ' has-error' : '' }}" name= "username" id="username" placeholder="Enter username" value="{{ old('username') }}">
                  <small class="text-danger">{{ $errors->first('username') }}</small>
                </div>
                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password">{{ __('Password') }}</label>
                  <input type="password" class="form-control" name= "password" id="password" placeholder="Enter password">
                  <small class="text-danger">{{ $errors->first('password') }}</small>
                </div>
                <div class="form-group has-feedback {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                  <label for="password_confirmation">{{ __('Confirm password!') }}</label>
                  <input type="password" class="form-control" name= "password_confirmation" id="password" placeholder="Enter password">
                  <small class="text-danger">{{ $errors->first('password_confirmation') }}</small>
                </div>
                <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                <label for="full_name">{{ __('Full name') }}</label>
                <input type="text" class="form-control" name= "full_name" id="full_name" placeholder="Enter full_name" value="{{ old('full_name') }}"> 

                <small class="text-danger">{{ $errors->first('full_name') }}</small>
                </div>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                  <label for="email">{{ __('Email') }}</label>
                  <input type="text" class="form-control" name= "email" id="email" placeholder="Enter Your email" data-toggle="tooltip" title="yourmail@gmail.com" value="{{ old('email') }}">
                  <small class="text-danger">{{ $errors->first('email') }}</small>
                </div>
                <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label for="phone">{{ __('Phone') }}</label>
                  <input type="text" class="form-control" name= "phone" id="phone" placeholder="Enter Your phone" value="{{ old('phone') }}">
                  <small class="text-danger">{{ $errors->first('phone') }}</small>
                </div>
                <div class="form-group col-md-6 pull-center">
                  <label for="is_active">{{ __('Is Active') }}</label>
                  <input type="checkbox" name="is_active">
                </div>
                <div class="form-group col-md-6">
                  <label for="is_admin">{{ __('Is Admin') }}</label>
                  <input type="checkbox" name="is_admin">
                </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="reset" class="btn btn-warning">{{ __('Reset') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
              </div>
            </form>
          </div>
</div>
@endsection