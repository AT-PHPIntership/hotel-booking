@extends('backend.layouts.main')
@section('title', __('Booking Room Detail'))
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <h1 class="title-page text-success">{{__('DETAIL BOOKING ROOM')}}</h1>
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
                      <a href="{{ route('hotel.show', $reservation->room->hotel_id) }}">
                        {{$reservation->room->hotel->name or '' }}
                      </a>
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
                      <a href="">
                        {{$reservation->room->name or '' }}
                      </a>
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
                      {{$reservation->reservable->full_name or '' }}
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
                      {{$reservation->reservable->email or '' }}
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
                      {{$reservation->reservable->phone or '' }}
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
                      {{$reservation->status_label}}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="box-footer">
              <a href="{{ URL::previous() }}" class="pull-left btn btn-default">
                {{__('Back')}}
              </a>
              <a href="{{ route('reservation.edit', $reservation->id) }}" class="pull-right btn btn-primary">
                {{__('Edit')}}
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>             
@endsection