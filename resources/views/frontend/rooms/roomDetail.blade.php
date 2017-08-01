@extends('frontend.layouts.master')

@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('content')
 <section class="parallax-effect">
    <div id="parallax-pagetitle" >
      <div class="color-overlay"> 
      <!-- Page title -->
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h1>Room detail</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <div class="container mt50">
    <div class="row"> 
      <!-- Slider -->
      <section class="standard-slider room-slider">
        <div class="col-sm-12 col-md-8">
          <div id="owl-standard" class="owl-carousel">
            <div class="item"> <a href="{{ asset('frontend/images/room.jpg') }}" data-rel="prettyPhoto[gallery1]"><img src="{{ asset('frontend/images/room.jpg') }}" alt="Image 2" class="img-responsive"></a> </div>
            <div class="item"> <a href="{{ asset('frontend/images/room.jpg') }}" data-rel="prettyPhoto[gallery1]"><img src="{{ asset('frontend/images/room.jpg') }}" alt="Image 2" class="img-responsive"></a> </div>
          </div>
        </div>
      </section>
    
      <!-- Room Information -->
      <section id="reservation-form" class="mt50 clearfix">
        <div class="col-sm-12 col-md-4">
          <h2>Single Room</h2>
          <h2>Max guest: 3</h2>
          <h2><span>Things</span></h2>
          <table class="table table-striped mt30">
            <tbody>
                <tr>
                  <td><i class="fa fa-check-circle"></i>Television</td>
                </tr>
                <tr>
                  <td><i class="fa fa-check-circle"></i>Air conditioning</td>
                </tr>
                <tr>
                  <td><i class="fa fa-check-circle"></i>Bathtub</td>
                </tr>
            </tbody>
          </table>
          <form>         
            <a href="/booking" class="btn btn-primary">Book Now</a>
          </form>     
        </div>
      </section>
    
      <!-- Room Content -->
     
        <div class="roomService">
              <h2 class="lined-heading"><span>Room Services</span></h2>
              <table class="table table-striped mt30">
                <tbody>
                  <tr>
                    <td><i class="fa fa-check-circle"></i> Double Bed</td>
                    <td><i class="fa fa-check-circle"></i> Free Internet</td>
                    <td><i class="fa fa-check-circle"></i> Free Newspaper</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-check-circle"></i> 60 square meter</td>
                    <td><i class="fa fa-check-circle"></i> Beach view</td>
                    <td><i class="fa fa-check-circle"></i> 2 persons</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-check-circle"></i> Double Bed</td>
                    <td><i class="fa fa-check-circle"></i> Free Internet</td>
                    <td><i class="fa fa-check-circle"></i> Breakfast included</td>
                  </tr>
                  <tr>
                    <td><i class="fa fa-check-circle"></i> Private Balcony</td>
                    <td><i class="fa fa-check-circle"></i> Flat Screen TV</td>
                    <td><i class="fa fa-check-circle"></i> Jacuzzi</td>
                  </tr>
                </tbody>
              </table>
        </div>
    </div>
  </div>
 
 <div class="other-rooms">
     <section class="rooms mt50">
     <div class="container">
       <div class="row">
         <div class="col-sm-12">
           <h2 class="lined-heading"><span>Other Rooms</span></h2>
         </div>
      <!-- Room -->
      @for($i = 0; $i < 3; $i++)
      <div class="col-sm-4">
        <div class="room-thumb"> <img src="{{ asset('frontend/images/roomdemo.jpg') }}" alt="room 3" class="img-responsive" />
          <div class="mask">
            <div class="main">
              <h5>Single room</h5>
            </div>
            <div class="content">
              <p><span>A modern hotel room in Star Hotel</span> Nunc tempor erat in magna pulvinar fermentum. Pellentesque scelerisque at leo nec vestibulum. 
                malesuada metus.</p>
              <div class="row">
                <div class="col-xs-6">
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check-circle"></i> Incl. breakfast</li>
                    <li><i class="fa fa-check-circle"></i> Private balcony</li>
                    <li><i class="fa fa-check-circle"></i> Sea view</li>
                  </ul>
                </div>
                <div class="col-xs-6">
                  <ul class="list-unstyled">
                    <li><i class="fa fa-check-circle"></i> Free Wi-Fi</li>
                    <li><i class="fa fa-check-circle"></i> Incl. breakfast</li>
                    <li><i class="fa fa-check-circle"></i> Bathroom</li>
                  </ul>
                </div>
              </div>
              <a href="room-detail.html" class="btn btn-primary btn-block">Book Now</a> </div>
          </div>
        </div>
      </div>
      @endfor
       </div>
     </div>
   </section>
 </div>


@endsection