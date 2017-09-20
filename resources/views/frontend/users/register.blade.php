@extends('frontend.layouts.master')
@section('title', __('Register'))
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('content')
<div class="container">
  <div class="row contain-row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">{{__('Register')}}</div>
          <div class="panel-body">
            <form class="form-horizontal" method="POST" action="">
              {{ csrf_field() }}
              <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                <label for="full_name" class="col-md-4 control-label cls-login">
                  {{__('Name')}}
                </label>
                <div class="col-md-6">
                  <input id="full_name" type="text" class="form-control cls-login" name="full_name" value="{{ old('full_name') }}" >
                  @if ($errors->has('full_name'))
                    <span class="help-block">
                      <strong>{{ $errors->first('full_name') }}</strong>
                    </span>
                  @endif
                </div>
              </div>
            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
              <label for="username" class="col-md-4 control-label cls-login">
                {{__('Username')}}
              </label>
              <div class="col-md-6">
                <input id="username" type="text" class="form-control cls-login" name="username" value="{{ old('username') }}">
                @if ($errors->has('username'))
                  <span class="help-block">
                    <strong>{{ $errors->first('username') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
              <label for="email" class="col-md-4 control-label cls-login">
                {{__('Email Address')}}
              </label>
              <div class="col-md-6">
                <input id="email" type="text" class="form-control cls-login" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                  <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
              <label for="phone" class="col-md-4 control-label cls-login">
                {{__('Phone')}}
              </label>
              <div class="col-md-6">
                <input id="phone" type="text" class="form-control cls-login" name="phone" value="{{ old('phone') }}">
                @if ($errors->has('phone'))
                  <span class="help-block">
                    <strong>{{ $errors->first('phone') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <label for="password" class="col-md-4 control-label cls-login">
                {{__('Password')}}
              </label>
              <div class="col-md-6">
                <input id="password" type="password" class="form-control cls-login" name="password">
                @if ($errors->has('password'))
                  <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group">
              <label for="password-confirm" class="col-md-4 control-label cls-login">
                {{__('Confirm Password')}}
              </label>
              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control cls-login" name="password_confirmation">
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-6 col-md-offset-4 cls-register">
                <button type="submit" class="btn btn-primary pull-right">
                  {{__('Submit')}}
                </button>
                <a href="{{URL::previous() }}" class="btn btn-default pull-left">{{__('Back')}}</a>
                <button type="reset" class="btn btn-warning pull-left">
                  {{__('Reset')}}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
