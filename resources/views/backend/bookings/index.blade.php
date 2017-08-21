@extends('backend.layouts.main')
@section('title','Manager BookingRooms')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>{{__('List Booking Rooms')}}
        <small>{{__('Booking Rooms')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="#"><i class="fa fa-dashboard"></i>{{__('Home')}}</a>
        </li>
        <li class="active">{{__('Booking Rooms')}}</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="title-news">
                <h3 class="box-title">{{__('Search Booking Rooms')}}</h3>
              </div>
              <div class="col-md-6">
                <form method="GET" class="container-search">
                  <input class="input-search form-control" placeholder="Search" name="search" type="text">
                  <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                </form>
              </div>
            </div>
            <div class="box-body">
              @include('flash::message')
              {{-- @include('backend.layouts.partials.modal') --}}
              <table class="table table-bordered table-responsive table-striped" id="bookingrooms-table">
                <thead>
                <tr>
                  <th>{{__('Id')}}</th>
                  <th>{{__('Rooms Name')}}</th>
                  <th>{{__('Target')}}</th>
                  <th>{{__('Quantity')}}</th>
                  <th>{{__('Check in')}}</th>
                  <th>{{__('Check out')}}</th>
                  <th>{{__('Request')}}</th>
                  <th>{{__('Status')}}</th>
                  <th class="text-center">{{__('Option')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($reservations as $reservation)
                  <tr>
                    <td>{{$reservation->id}}</td>
                    <td>
                      <a href="">
                        {{$reservation->bookingroom->name}}
                      </a>
                      </td>
                    <td>{{$reservation->target}}</td>
                    <td>{{$reservation->quantity}}</td>
                    <td>{{$reservation->checkin_date}}</td>
                    <td>{{$reservation->checkout_date}}</td>
                    <td>{{$reservation->request}}</td>
                    <td>{{$reservation->status}}</td>
                    <td align="center">
                      <a href="{{ route('bookingroom.show') }}" data-original-title="Detail" data-toggle="tooltip" class="btn fa fa-search-plus pull-left news-btn">
                      </a>
                      <a href="" class="btn fa fa-pencil-square-o news-btn pull-left" data-original-title="Edit" data-toggle="tooltip">
                      </a>
                      <form action="" method="POST" class="inline">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="news-btn fa fa-trash-o btn-delete-item pull-left"  
                         data-original-title="Delete" data-toggle="tooltip"  data-title="{{ __('Confirm deletion!') }}"
                            data-confirm="{{ __('Are you sure you want to delete?') }}">
                        </button>
                      </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $reservations->render() !!}
            </div>
          </div>
          <div>
            <a href="" class="btn btn-primary pull-right">
              <i class="fa fa-plus-circle"></i>
              {{__('Add News')}}
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection