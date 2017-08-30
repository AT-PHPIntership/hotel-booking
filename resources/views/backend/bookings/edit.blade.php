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
          <div class="cls-editnews-msg">
            @include('flash::message')
          </div>
          <div class="box box-primary">
            <form method="POST" action="{{ route('reservation.update', $reservation->id) }}" >
              {{csrf_field()}}
              {{method_field('PUT')}}
              <div class="box-body">
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Hotel Name:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <h4>
                      <label>{{$reservation->room->hotel->name or ''}}</label>
                    </h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Room:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <h4>
                      <label>{{$reservation->room->name or ''}}</label>
                    </h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Target:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <h4>
                      <label>{{$reservation->reservable->full_name or ''}}</label>
                    </h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Phone:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <h4>
                      <label>{{$reservation->reservable->phone or ''}}</label>
                    </h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Email:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <h4>
                      <label>{{$reservation->reservable->email or ''}}</label>
                    </h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Quantity:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <h4>
                      <label>{{$reservation->quantity}}</label>
                    </h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Check in:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <h4>
                      <label>{{$reservation->checkin_date}}</label>
                    </h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Check out:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6">
                    <h4>
                      <label>{{$reservation->checkout_date}}</label>
                    </h4>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h4>
                      <label>{{__('Status:')}}</label>
                    </h4>
                  </div>
                  <div class="col-md-6" {{ $errors->has('status') ? ' has-error' : '' }}>
                    <h4>
                      <select name="status">
                        @foreach(App\Model\Reservation::$availableStatuses as $status => $value)
                          <option value="{{$value}}" {{$reservation->status_label == $status ? 'selected' :''}}
                          >
                            {{$status}}
                          </option>
                        @endforeach
                      </select>
                    </h4>
                    @if($errors->first('status'))
                      <span class="help-block">{{$errors->first('status')}}</span>
                    @endif
                  </div>
                </div>
              <div class="box-footer">  
                <div class="cls-update-booking">
                  <a href="{{ URL::previous() }}" class="btn btn-default pull-left">
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