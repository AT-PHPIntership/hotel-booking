@extends('backend.layouts.main')
@section('title','Update Reservation')
@section('content')
  <div class="content-wrapper">
    <h1 class="title-page text-success">
      {{__('Update Reservation')}}
    </h1>
    <section class="content">
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="cls-editnews-msg">
            @include('flash::message')
          </div>
          <div class="box box-primary">
            <form method="POST" action="" >
              {{csrf_field()}}
              {{method_field('PUT')}}
              <div class="box-body">
                <div class="form-group">
                  <div class="col-md-6">
                    <h3>
                      <label>{{__('Room:')}}</label>
                    </h3>
                  </div>
                  <div class="col-md-6">
                    <h3>
                      <label>{{$reservation->bookingroom->name}}</label>
                    </h3>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h3>
                      <label>{{__('Check in:')}}</label>
                    </h3>
                  </div>
                  <div class="col-md-6">
                    <h3>
                      <label>{{$reservation->checkin_date}}</label>
                    </h3>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h3>
                      <label>{{__('Check out:')}}</label>
                    </h3>
                  </div>
                  <div class="col-md-6">
                    <h3>
                      <label>{{$reservation->checkout_date}}</label>
                    </h3>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-md-6">
                    <h3>
                      <label>{{__('Status:')}}</label>
                    </h3>
                  </div>
                  <div class="col-md-6">
                    <h3>
                      <select>
                        <option>{{$reservation->status}}</option>
                      </select>
                    </h3>
                  </div>
                </div>
              <div class="box-footer">  
                <div class="btn-edit-news">
                  <a href="" class="btn btn-default">
                    {{__('Back')}}
                  </a>                
                  <button type="reset" class="btn btn-warning">
                    {{__('Reset')}}
                  </button> 
                </div>
                <div class="edit-news-submit">
                  <button type="submit" class="btn btn-primary">
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