@extends('backend.layouts.main')
@section('title', __('Update Reservation'))
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <h1 class="title-page text-success">
        {{__('Update Reservation')}}
      </h1>
      <div class="row margin-center">
        <div class="col-md-12">
          <div>
              @include('flash::message')
            </div>
          <div class="box">
            <form method="POST" action="{{ route('reservation.update', $reservation->id) }}" class="mt-20">
              {{csrf_field()}}
              {{method_field('PUT')}}
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
                        {{$reservation->room->hotel->name or '' }}
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
                        {{$reservation->room->name or ''}}
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
                        {{$reservation->reservable->full_name or ''}}
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
                        {{$reservation->reservable->email or ''}}
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
                        {{$reservation->reservable->phone or ''}}
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
                        <select name="status">
                          @foreach(App\Model\Reservation::$availableStatuses as $status => $value)
                            <option value="{{$value}}" {{$reservation->status_label == $status ? 'selected' :''}}
                            >
                              {{$status}}
                            </option>
                          @endforeach
                        </select>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="box-footer">  
                <div>
                  <a href="{{ URL::previous() }}" class="mr-10 btn btn-default pull-left">
                    {{__('Back')}}
                  </a>                
                  <button type="reset" class="btn btn-warning pull-left">
                    {{__('Reset')}}
                  </button> 
                </div>
                <div>
                  <button type="submit" class="btn btn-primary pull-right">
                    {{__('Submit')}} 
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>      
@endsection
