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
              <h1>Hotel detail</h1>
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
            <div class="item"> <a href="" data-rel="prettyPhoto[gallery1]">
            <img src="{{ asset('frontend/images/hotel3.jpg') }}" alt="Image 2" class="img-responsive"></a> </div>
            <div class="item"> <a href="images/rooms/slider/750x481.gif" data-rel="prettyPhoto[gallery1]">
            <img src="{{ asset('frontend/images/hotel3.jpg') }}" alt="Image 2" class="img-responsive"></a> </div>
          </div>
        </div>
      </section>
    
      <!-- Room Information -->
      <section id="reservation-form" class="mt50 clearfix">
        <div class="col-sm-12 col-md-4">
          <h1>Hotel Name</h1>
          <p>Star: ® ® ® ®</p>
          <p><span>Address: @yield('address')</span></p>
          <span>Location <br>
            Located in central London, this hotel is steps from Russell Square and the British Museum. St. George, Bloomsbury and University of London are also within a 10 minute walk. <br>
            Residence characteristics
            In addition to a restaurant, this hotel offers self-parking and a garden. <br>
            Room amenities
            All 58 rooms are equipped with many amenities such as refrigerator or coffee / tea facilities, beside the minibar and TV. Hairdryers, safes, and showers are among the services and amenities available to guests.
           </span>
          <table class="table table-striped mt30">
            <caption> <h3>Services</h3></caption>
            <tbody>
                <tr>
                  <td><i class="fa fa-check-circle"></i>Tivi</td>
                   <td><i class="fa fa-check-circle"></i>Massage</td>
                </tr>
                <tr>
                  <td><i class="fa fa-check-circle"></i>Live massage</td>
                   <td><i class="fa fa-check-circle"></i>Tivi</td>
                </tr>
                <tr>
                  <td><i class="fa fa-check-circle"></i>Aaaaaa</td>
                   <td><i class="fa fa-check-circle"></i>Tivi</td>
                </tr>
            </tbody>
          </table>     
        </div>
      </section>
     </div>
     {{-- list-rooms --}}
    <div class="list-rooms">
      <h1>List Rooms</h1>
    </div>``
    @for($i = 0; $i<4 ;$i++)
      <div class = "listHotel">
          <div class = "room-image" >
          <img src="{{asset('frontend/images/roomdemo.jpg')}}">
          </div>
          <div class = "room-item">
            <h1 class = 'hotel-name'>Single room</h1>
            <p>Max guest: 2</p>
            <p>Room information</p>
          </div>
          <div class="room-item">
            <h2 class= 'room-price'>Price</h2>
            <h3>$ 100.5</h3>
            <button name = 'btnBookRoom' class="btn btn-primary"><a href="/room">Book Now</a></button>
          </div>
      </div>
    @endfor

    {{-- rating --}}

    </div>
  </div>  
</div>

</section>
<section class="rating-comment">
    <div class="container">
      <h1 class="h1-rating">Rating</h1>
        <div class="row">
            <div class="col-xs-12 col-md-6 left-rating">
                <div class="well well-sm" style="margin-top: 20px;">
                    <div class="row" >
                        <div class="col-xs-12 col-md-6 text-center rating-box">
                            <h1 class="rating-num">
                                4.0</h1>
                            <div class="rating">
                                <span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">
                                </span><span class="glyphicon glyphicon-star"></span><span class="glyphicon glyphicon-star">
                                </span><span class="glyphicon glyphicon-star-empty"></span>
                            </div>
                            <div>
                                <span class="glyphicon glyphicon-user"></span>1,050,008 total
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="row rating-desc">
                                {{-- 5 rating --}}
                                @for($i =0; $i<5; $i++)
                                 <div class="col-xs-3 col-md-3 text-right">
                                    <span class="glyphicon glyphicon-star"></span>Comfor
                                </div>
                                  <div class="col-xs-8 col-md-9">
                                      <div class="progress progress-striped">
                                          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20"
                                              aria-valuemin="0" aria-valuemax="100" style="width: {{ ($i*2)*10 }}%">
                                              <span class="sr-only">{{ ($i*2)*10 }}%</span>
                                          </div>
                                      </div>
                                  </div>
                                @endfor
                                <div class="link-rating">
                                   <a href="">Rating for this hotel</a><br>
                                </div>
                                {{-- end ratin --}}
                            </div>
                        </div>
                    </div>
                  <div class="comment-old">
                      <form action="">
                        <textarea class="your-comment" placeholder="Write your comment....."></textarea>
                        <button class="btn btn-primary" type="submit">Submit</button>

                      </form>
                  </div>
                </div>
              </div>
            <div class="right-rating">
                <h3 style="margin-top: 20px; display: block;">Comment</h3>
                @for($i =0; $i < 4; $i++)
                <div class="col-md-6 comment-old">
                  <img src="{{asset('frontend/images/iconuser.png')}}" alt="usrs avatar" id="avatar">
                  <h4 class="username">user name</h4>
                  <p>It's very good. ahihi It's very good. ahihiIt's very good. ahihiIt's very good. ahihi
                      ahihi
                  </p>
                  <p>11:31 AM, Monday, July 2017</p>
                </div>
              @endfor
            </div>
          </div>
        {{-- end row --}}
      </div>
</section>

  </div>
</div>
@endsection