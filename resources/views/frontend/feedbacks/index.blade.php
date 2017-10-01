@extends('frontend.layouts.master')
@section('title', __('Feedback'))
@section('content')
  <section>
    <div class=" text-center">
      <h1>{{ __('Feedback') }}</h1>
    </div>
    <div class=" text-center">
      @include('flash::message')
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 toppad cls-tb-user" >
          <div class="panel panel-info">
            <form method="POST" action="{{ route('sendfeedback.store') }}">
              <div class="panel-body">
                {{ csrf_field() }}
                @if(Auth::user())
                  <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                    <input name="full_name" type="text" id="full_name"  class="form-control cls-login"
                    value="{{Auth::user()->full_name}}" />
                    @if($errors->first('full_name'))
                      <span class="help-block">{{ $errors->first('full_name') }}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input name="email" type="text" id="email"  class="form-control cls-login" value="{{Auth::user()->email}}"/>
                    @if($errors->first('email'))
                      <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                @else
                  <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                    <input name="full_name" type="text" id="full_name"  class="form-control cls-login" placeholder="{{ __('Please enter your full name') }}"/>
                    @if($errors->first('full_name'))
                      <span class="help-block">{{ $errors->first('full_name') }}</span>
                    @endif
                  </div>
                  <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input name="email" type="text" id="email"  class="form-control cls-login" placeholder="{{ __('Please enter your email') }}"/>
                    @if($errors->first('email'))
                      <span class="help-block">{{ $errors->first('email') }}</span>
                    @endif
                  </div>
                @endif
                <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                  <textarea class="form-control cls-login" name="content"></textarea>
                  @if($errors->first('content'))
                      <span class="help-block">{{ $errors->first('content') }}</span>
                    @endif
                </div>
              </div>
              <div class ="panel-footer clearfix cls-register">
                <button type ="submit" class="btn btn-success pull-right">
                  {{ __('Submit') }}
                </button>
                <a href="{{ URL::previous() }}" class="btn btn-default pull-left">
                  {{ __('Back') }}
                </a>
                <button class="btn btn-warning pull-left" type="reset">
                  {{ __('Reset') }}
                </button>
              </div>
              </form>
          </div>
        </div>
      </div>
    </div>
  </section>          
@endsection