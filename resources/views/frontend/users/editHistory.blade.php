@extends('frontend.layouts.master')
@section('title', 'Edit History Booking Room')
@section('content')
  <section class="user-profile">
    <div class="user-head text-center">
      <h1>{{__('Update History Booking')}}</h1>
    </div>
    <div class="text-center">
      @include('flash::message')
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 toppad cls-tb-user" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title text-center">{{__('Infomation')}}</h3>
            </div>
            <form  action="" method="POST" class="form-horizontal">
              <div class="panel-body">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="form-group">
                  <label class="control-label col-md-3">{{__('Full name')}}</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control cls-login" value="{{$reservation->reservable->full_name}}" readonly="true">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 pull-left cls-label">{{__('Phone')}}</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control cls-login" value="{{$reservation->reservable->phone}}" readonly="true">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-md-3 cls-label">{{__('Email')}}</label>
                  <div class="col-md-8">
                    <input type="text" class="form-control cls-login" value="{{$reservation->reservable->email}}" readonly="true">
                  </div>
                </div>
                <div class="form-group {{ $errors->has('checkin_date') ? ' has-error' : '' }}">
                  <label class="control-label col-md-3 pull-left">{{__('Check in')}}</label>
                  <div class="col-md-8">
                    <input type="text" name="checkin_date" class="form-control datepicker-df check-in cls-login" value="{{ \Carbon\Carbon::parse($reservation->checkin_date)->format('m/d/Y')}}">
                    @if($errors->first('checkin_date'))
                      <span class="help-block">{{$errors->first('checkin_date')}}</span>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('checkout_date') ? ' has-error' : '' }}">
                  <label class="control-label col-md-3 pull-left">{{__('Check out')}}</label>
                  <div class="col-md-8">
                    <input type="date" name="checkout_date" class="form-control cls-login" value="{{$reservation->checkout_date}}">
                    @if($errors->first('checkout_date'))
                      <span class="help-block">{{$errors->first('checkout_date')}}</span>
                    @endif
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

