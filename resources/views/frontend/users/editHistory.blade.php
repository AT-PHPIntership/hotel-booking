@extends('frontend.layouts.master')
@section('title', 'Edit History Booking Room')
@section('customcss')
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/editHistoryBooking.css') }}">
@endsection
@section('content')
  <section class ='historyBooking'>
    <div class="container">
      <div class="row">
        <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">History Booking Room</h3>
            </div>
            <div class="panel-body">
              <form class="reservation-vertical clearfix" role="form" method="post" action="" name="reservationform">

                <div id="mesage">
                  
                </div>
                <!-- Error mesage display -->
                <div class="form-group1">
                  <label for="name" accesskey="E">Tên người liên hệ</label>
                  <input name="name" type="text" id="name"  class="form-control" placeholder="Please enter your name"/>
                </div>

                <div class="form-group1">
                  <label for="phone" accesskey="E">Số điện thoại</label>
                  <input name="phone" type="text" id="phone" class="form-control" placeholder="Please enter your phone"/>
               </div>

                <div class="form-group1">
                  <label for="email" accesskey="E">Email</label>
                  <input name="email" type="text" id="email" class="form-control" placeholder="Please enter your email"/>
                </div>

                <div class="form-group1">
                  <label for="checkout">Check-In</label>
                  <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00">  </div>
                  <i class="fa fa-calendar infield"></i>
                  <input name="checkout" type="text" id="checkin" value="" class="form-control" placeholder="Check-In"/>
                </div>

                <div class="form-group1">
                  <label for="checkout">Check-out</label>
                  <div class="popover-icon" data-container="body" data-toggle="popover" data-trigger="hover" data-placement="right" data-content="Check-out is from 12:00">
                  </div>
                  <input name="checkout" type="text" id="checkout" value="" class="form-control" placeholder="Check-out"/>
                </div>

                <div class="form-group1">
                  <label for="email" accesskey="E">Yêu cầu đặc biệt (Nếu có)</label>
                  <textarea class="form-control" name="textarea" id="textarea"></textarea>
                </div>

                <div class="btn-submit-booking">
                  <button type="submit" class="btn btn-primary" data-original-title="Submit" data-toggle="tooltip">
                    <span class="fa fa-check-circle-o"></span>
                  </button>
                  <a href="/show" class="btn btn-danger" data-original-title="Cancer" data-toggle="tooltip">
                    <span class="fa fa-times"></span>
                  </a>
                </div>


            
            </form>
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
