@extends('backend.layouts.main')
@section('title', __('Booking Room Detail'))
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <h1 class="title-page">{{__('DETAIL BOOKING ROOM')}}</h1>
      <div class="row margin-center">
          <div class="col-md-12">
            <div class="box">
              <div class="box-body">
                <table class="table table-condensed table-responsive">
                  <tbody>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-home text-primary"></i>
                        {{ __('Hotel Name') }}
                      </strong>
                    </td>
                      <td>
                        {{$hotel->name}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-asterisk text-primary"></i>
                        {{ __('Room Name') }}
                      </strong>
                    </td>
                      <td>
                        {{$reservation->bookingroom->name}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-user text-primary"></i>
                        {{ __('Target') }}
                      </strong>
                    </td>
                      <td>
                        {{$user->full_name}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-cloud text-primary"></i>
                        {{ __('Email') }}
                      </strong>
                    </td>
                      <td>
                        {{$user->email}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-phone text-primary"></i>
                        {{ __('Phone') }}
                      </strong>
                    </td>
                      <td>
                        {{$user->phone}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-tint text-primary"></i>
                        {{ __('Quantity') }}
                      </strong>
                    </td>
                      <td>
                        {{$reservation->quantity}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-calendar text-primary"></i>
                        {{ __('Check in') }}
                      </strong>
                    </td>
                      <td>
                        {{$reservation->checkin_date}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-calendar text-primary"></i>
                        {{ __('Check out') }}
                      </strong>
                    </td>
                      <td>
                        {{$reservation->checkout_date}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-info-sign text-primary"></i>
                        {{ __('Request') }}
                      </strong>
                    </td>
                      <td>
                        {{$reservation->request}}
                      </td>
                  </tr>
                  <tr>
                    <td>
                      <strong>
                        <i class="glyphicon glyphicon-exclamation-sign text-primary"></i>
                        {{ __('Status') }}
                      </strong> 
                    </td>
                    <td>
                      {{$reservation->status}}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="box-footer">
                <a href="{{ URL::previous() }}" class="pull-left btn btn-default">Back</a>
                @if($reservation->status != __('Cancel'))
                  <a href="" class="pull-right btn btn-primary">Edit</a>
                @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>             
@endsection