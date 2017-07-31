@extends('frontend.layouts.partials.master')
@section('title', 'User Profile')
@section('customcss')
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/userProfile.css') }}">
@endsection
@section('content')
  <section class ='user-profile'>
    <div class="user-head">
      <h1>USER PROFILE</h1>
    </div>
    <div class="container">
      <div class="historyBooking">
        <a href="/show">Show History Booking</a>
      </div>
      <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">USER NAME</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Picture" src="" class="img-circle img-responsive">
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>AAAA</td>
                        <td>1111</td>
                      </tr>
                      <tr>
                        <td>BBBB</td>
                        <td>2222</td>
                      </tr>
                      <tr>
                        <td>CCCC</td>
                        <td>3333</td>
                      </tr>
                   
                         <tr>
                      <tr>
                        <td>DDDD</td>
                        <td>4444</td>
                      </tr>
                        <tr>
                        <td>EEEE</td>
                        <td>5555</td>
                      </tr>
                      <tr>
                        <td>FFFF</td>
                        <td>6666</td>
                      </tr>
                        <td>GGGG</td>
                        <td>7777</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <div class="panel-footer">
              <div class="footer-btn">
                <a data-original-title="Edit Profile" data-toggle="tooltip" href="/edit" class="btn btn-success center-block">
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
