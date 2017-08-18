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
                  <th class="text-center">{{__('Option')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($reservations as $reservation)
                  <tr>
                    <td>{{$reservation->id}}</td>
                    <td>{{$reservation->rooms->name}}</td>
                    <td>{{$reservation->target}}</td>
                    <td>{{$reservation->quantity}}</td>
                    <td>{{$$reservation->checkin_date}}</td>
                    <td>{{$$reservation->checkout_date}}</td>
                    <td>{{$$reservation->request}}</td>
                    <td align="center">
                      {{-- <div class="news-option">
                        <a href="{{ route('news.edit',$item->slug) }}" class="btn fa fa-pencil-square-o news-btn pull-left" data-original-title="Edit" data-toggle="tooltip">
                        </a>
                        <form action="{{ route('news.destroy',$item->id) }}" method="POST" class="inline">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <button type="submit" class="news-btn fa fa-trash-o btn-delete-item pull-left"  
                           data-original-title="Delete" data-toggle="tooltip"  data-title="{{ __('Confirm deletion!') }}"
                              data-confirm="{{ __('Are you sure you want to delete?') }}">
                          </button>
                        </form>
                        <a href="" class="btn fa fa-upload news-btn pull-left" data-original-title="Upload Image" data-toggle="tooltip" >
                        </a>
                      </div> --}}
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $news->render() !!}
            </div>
          </div>
          <div>
            <a href="{{ route('news.create') }}" class="btn btn-primary pull-right">
              <i class="fa fa-plus-circle"></i>
              {{__('Add News')}}
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection