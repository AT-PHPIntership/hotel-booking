@extends('frontend.layouts.master')
@section('title', __('User Profile'))
{{-- @section('customcss')
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/userProfile.css') }}">
@endsection --}}
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
              <h3 class="panel-title text-center">{{__('USER NAME')}}</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                @if($user)
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Picture" src="{{asset('images/default/profile.png')}}" class="img-circle img-responsive">
                </div>
                @else
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Picture" src="{{asset('images/default/profile.png')}}" class="img-circle img-responsive">
                @endif
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
                <a data-original-title="Edit Profile" data-toggle="tooltip" href="/edit" class="btn btn-success  col-md-2 pull-right">
                  <span class="fa fa-edit"></span>
                </a>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('customjs')
<script type="text/javascript" src ="{{asset('frontend/js/userProfile.js')}}"></script>
@endsection
