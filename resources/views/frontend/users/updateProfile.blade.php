@extends('frontend.layouts.master')
@section('title', __('Update User Profile'))
@section('content')
  <section class="user-profile">
    <div class="user-head text-center">
      <h1>{{__('Update Profile')}}</h1>
    </div>
    <div class="text-center">
      @include('flash::message')
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 toppad cls-tb-user" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title text-center">{{$user->username}}</h3>
            </div>
            <form  action="{{ route('profile.update', $user->id) }}" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <div class="panel-body">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="form-group {{ $errors->has('full_name') ? ' has-error' : '' }}">
                  <label class="control-label col-md-3 pull-left">{{__('Full name')}}</label>
                  <div class="col-md-8">
                    <input type="text" name="full_name" class="form-control cls-login" value="{{$user->full_name}}">
                    @if($errors->first('full_name'))
                      <span class="help-block">{{$errors->first('full_name')}}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                  <label class="control-label col-md-3">{{__('Email')}}</label>
                  <div class="col-md-8">
                    <input type="text" name="email" class="form-control cls-login" value="{{$user->email}}">
                    @if($errors->first('email'))
                      <span class="help-block">{{$errors->first('email')}}</span>
                    @endif
                  </div>
                </div> 
                <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                  <label class="control-label col-md-3">{{__('Phone')}}</label>
                  <div class="col-md-8">
                    <input type="text" name="phone" class="form-control cls-login" value="{{$user->phone}}">
                    @if($errors->first('phone'))
                      <span class="help-block">{{$errors->first('phone')}}</span>
                    @endif
                  </div>
                </div>

                <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                  <label class="control-label col-md-3">{{__('Password')}}</label>
                  <div class="col-md-8">
                    <input type="password" name="password" class="form-control cls-login" placeholder="{{__('Fill in if you want to change password')}}">
                    @if($errors->first('password'))
                      <span class="help-block">{{$errors->first('password')}}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3">{{__('Images')}}</label>
                  <div class="col-md-8">
                    <input type="file" name="image" class="control-label">
                  </div>
                </div>
              </div>
              <div class ="panel-footer clearfix cls-register">
                <button type ="submit" class="btn btn-success pull-right">
                  {{__('Submit')}}
                </button>
                <a href="{{ URL::previous() }}" class="btn btn-default pull-left">
                  {{__('Back')}}
                </a>
                <button class="btn btn-warning pull-left" type="reset">
                  {{__('Reset')}}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>        
@endsection