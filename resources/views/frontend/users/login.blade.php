@extends('frontend.layouts.master')
@section('customcss')
@section('title', __('Login'))
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('content')
  <div class="container">
    <div class="row contain-row" >
      <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
          <div class="panel-heading">{{__('Login')}}</div>
          <div class="panel-body">
            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
              {{ csrf_field() }}
                <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                  <label for="username" class="col-md-4 control-label">{{__('Username')}}</label>
                  <div class="col-md-6">
                    <input id="username" type="username" class="form-control cls-login" name="username" value="{{ old('username') }}">
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
                  </div>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                  <label for="password" class="col-md-4 control-label">{{__('Password')}}</label>
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
                  <div class="col-md-6 col-md-offset-4">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{__('Remember Me')}}
                      </label>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <button type="submit" class="btn btn-primary">
                            Login
                        </button>

                        <a class="forgot-pass btn btn-link" href="{{ route('password.request') }}">
                            Forgot Your Password?
                        </a>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
