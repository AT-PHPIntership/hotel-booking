@extends('frontend.layouts.master')
@section('title', 'Edit History Booking Room')
@section('content')
  <section class="user-profile">
    <div class="user-head text-center">
      <h1>{{__('Show History Booking')}}</h1>
    </div>
    <div class="text-center">
      @include('flash::message')
      @include('frontend.layouts.partials.modal')
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 toppad cls-tb-user" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title text-center">{{__('Infomation')}}</h3>
            </div>
            <div class="panel-body form-horizontal">
              <div class="form-group">
                <label class="control-label col-md-3">{{__('Hotel')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{$reservation->room->hotel->name}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">{{__('Room')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{$reservation->room->name}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">{{__('Full name')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{$reservation->reservable->full_name}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">{{__('Phone')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{$reservation->reservable->phone}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 cls-label">{{__('Email')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{$reservation->reservable->email}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 pull-left">{{__('Check in')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{ \Carbon\Carbon::parse($reservation->checkin_date)->format('m/d/Y')}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 pull-left">{{__('Check out')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{ \Carbon\Carbon::parse($reservation->checkout_date)->format('m/d/Y')}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">{{__('Quantity')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{$reservation->quantity}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">{{__('Request')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{$reservation->request}}
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">{{__('Status')}}</label>
                <div class="col-md-8">
                  <div class="form-control cls-login">
                    {{$reservation->status_label}}
                  </div>
                </div>
              </div>
            </div>
            <div class ="panel-footer clearfix cls-register">
              @if($reservation->status_label == __('Pending'))
                <form method="POST" action="{{ route('user.cancelBooking', [$reservation->reservable->id, $reservation->id]) }}">
                  {{csrf_field()}}
                  {{method_field('PUT')}}
                  <button type ="submit" class="btn btn-danger pull-right btn-confirm" data-title="{{ __('Confirm deletion!') }}"
                    data-confirm="{{ __('Are you sure you want to cancel this booking?') }}">
                    {{__('Cancel this')}}
                  </button>
                </form>
              @endif
              <a href="{{ URL::previous() }}" class="btn btn-default pull-left">
                {{__('Back')}}
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

