@extends('frontend.layouts.master')
@section('title', __('User Profile'))
@section('content')
  <section class ='user-profile'>
    <div class="user-head text-center">
      <h1>{{__('User Profile')}}</h1>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title text-center">{{$user->username}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Picture" src="{{asset('images/default/profile.png')}}" class="img-circle img-responsive">
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>
                          <i class="fa fa-user"></i>
                          {{__('Full Name')}}
                        </td>
                        <td>
                          {{$user->full_name}}
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="fa fa-phone"></i>
                          {{__('Phone')}}
                        </td>
                        <td>
                          {{$user->phone}}
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="fa fa-envelope-o"></i>
                          {{__('Email')}}
                        </td>
                        <td>
                          {{$user->email}}  
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="fa fa-cube"></i>
                          {{__('Role')}}
                        </td>
                        <td>
                          {{$user->role}}
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="fa fa-plane"></i>
                          {{__('Total Booking Room')}}
                        </td>
                        <td>
                          <a href="" id="user-reservation">{{$user->reservations->count()}}</a>
                        </td>
                      </tr>
                      <tr>
                        <td>
                          <i class="fa fa-comment"></i>
                          {{__('Total Rating & Comment')}}
                        </td>
                        <td>
                          <a href="" id="user-comment">{{$user->ratingComments->count()}}</a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel-footer clearfix">
              <div >
                <a href="{{ URL::previous() }}" class="btn btn-default pull-left">
                  {{__('Back')}}
                </a>
                <a data-original-title="Edit Profile" data-toggle="tooltip" href="/edit" class="btn btn-success  col-md-1 pull-right">
                  <span class="fa fa-edit"></span>
                </a>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
  <section class="content" hidden="" id="table-comment">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title text-center">{{ __('List comment & rating') }}</h3>
          </div>
          <div class="box-body">
            @include('flash::message')
            @include('backend.layouts.partials.modal')
            <table class="table table-bordered table-responsive table-striped">
              <thead>
                <tr align="center">
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Comment') }}</th>
                  <th>{{ __('Hotel Name') }}</th>
                  <th>{{ __('Total Rating') }}</th> 
                  <th>{{ __('Created') }}</th> 
                  <th class="text-center">{{ __('Option') }}</th> 
                </tr>
              </thead>
              <tbody>
                @foreach($comments as $comment)
                  <tr>
                    <td>{{$comment->id}}</td>
                    <td>{{$comment->comment}}</td>
                    <td>{{$comment->hotel->name}}</td>
                    <td>{{$comment->total_rating}}</td>
                    <td>{{$comment->created_at}}</td>
                    <td class="text-center">
                      <a href="" class="fa fa-trash-o"></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>          
  </section>
  <section class="content" hidden="" id="table-reservation">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title text-center">{{ __('List Reservations') }}</h3>
          </div>
          <div class="box-body">
          @include('flash::message')
          @include('backend.layouts.partials.modal')
            <table class="table table-bordered table-responsive table-striped">
              <thead>
                <tr align="center">
                  <th>{{ __('ID') }}</th>
                  <th>{{ __('Status') }}</th>
                  <th>{{ __('Room Name') }}</th>
                  <th>{{ __('Check in') }}</th> 
                  <th>{{ __('Checkout') }}</th> 
                  <th class="text-center">{{ __('Option') }}</th> 
                </tr>
              </thead>
              <tbody>
                @foreach($user->reservations as $reservation)
                  <tr>
                    <td>{{$reservation->id}}</td>
                    <td>{{$reservation->status_label}}</td>
                    <td>{{$reservation->room->name}}</td>
                    <td>{{$reservation->checkin_date}}</td>
                    <td>{{$reservation->checkout_date}}</td>
                    <td>
                      <a href="" class="fa fa-edit"></a>
                      <a href="" class="fa fa-calendar-times-o"></a>
                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>          
  </section>
@endsection
