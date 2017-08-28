@extends('backend.layouts.main')
@section('title',__('Manager BookingRooms'))
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>{{__('List Booking Rooms')}}
        <small>{{__('Booking Rooms')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>{{__('Home')}}</a>
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
                <form method="GET" class="container-search cls-search">
                  <input class="input-search form-control" placeholder="Search" name="search" type="text">
                  <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                </form>
              </div>
            </div>
            <div class="box-body">
              @include('flash::message')
              {{-- @include('backend.layouts.partials.modal') --}}
              <table class="table table-bordered table-responsive table-striped" id="table-contain">
                <thead>
                <tr>
                  <th>{{__('Id')}}</th>
                  <th>{{__('Rooms Name')}}</th>
                  <th>{{__('Target')}}</th>
                  <th>{{__('Full Name')}}</th>
                  <th>{{__('Check in')}}</th>
                  <th>{{__('Check out')}}</th>
                  <th>{{__('Status')}}</th>
                  <th class="text-center col-md-2">{{__('Option')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($reservations as $reservation)
                  <tr>
                    <td>{{$reservation->id}}</td>
                    <td>
                      <a href="" id="id-room-detail">
                        {{$reservation->room->name}}
                      </a>
                    </td>
                    <td>{{$reservation->target}}</td>
                    <td>
                      @if($reservation->target == __('user'))
                        <a href="{{ route('user.show', $reservation->target_id) }}" id="id-user-detail">
                          {{$reservation->reservable->full_name}}
                        </a>
                      @else()
                        {{$reservation->reservable->full_name}}
                      @endif
                    </td>
                    <td>{{$reservation->checkin_date}}</td>
                    <td>{{$reservation->checkout_date}}</td>
                    <td>{{$reservation->status_label}}</td>
                    <td align="center">
                      <a href="{{ route('reservation.show', $reservation->id) }}" data-original-title="Detail" data-toggle="tooltip" class="btn fa fa-search-plus pull-left news-btn">
                      </a>
                      <a href="{{ route('reservation.edit', $reservation->id) }}" class="btn fa fa-pencil-square-o news-btn center-block {{$reservation->status_label != __('Canceled') ? "":"disabled"}}" data-original-title="Edit" data-toggle="tooltip" >
                      </a>
                      <form action="" method="POST" class="inline">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="news-btn fa fa-trash-o btn-delete-item pull-right"  
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
            <div class="cls-search-not-found text-center" hidden="">
                {{__('Data Not Found')}}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection