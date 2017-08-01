@extends('frontend.layouts.master')
@section('customcss')
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bookingRoom.css') }}">
@endsection
@section('content')
    <div class = 'body-booking'>
      <div>
          <h1>ĐẶT PHÒNG KHÁCH SẠN</h1>
      </div>
      <div class="form-booking-body">
        <div class = "left-booking ">
          <h2>Thông tin của bạn</h2>
           <form class="reservation-vertical clearfix" role="form" method="post" action="" name="reservationform">

            <div id="mesage"></div>
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
                 <button type="submit" class="btn btn-primary ">Book Now</button> 
            </div>

            
            </form>
          </div>
            <div class="right-booking">
              <div class="head-booking-detail">
                <h1>Thông tin phòng </h1>
              </div>
              <div class = "body-booking-detail">
                <div class = "image-detail">
                  <img src="{{asset('frontend/images/roomdemo.jpg')}}" style="width: 200px;">
                </div>
                <div class ='content-detail'>
                    <h1>Hotel A</h1>
                    <p>*****</p>
                </div>
                <div class="service-detail">  
                    <p><i class="fa fa-check-circle"></i> Free Wifi</p>
                    <p><i class="fa fa-check-circle"></i> Free Breakfast</p>
                    <p><i class="fa fa-check-circle"></i> Free Spa</p>
                </div>
                <div class= 'room-info'>
                  <p>Loại phòng:</p>
                  <p>Kích thước:</p>
                  <p>Đồ đạc:</p>
                  <p>Giá phòng:</p>
                </div>   
              </div>
        </div> 
    </div>
  </div>

@endsection
