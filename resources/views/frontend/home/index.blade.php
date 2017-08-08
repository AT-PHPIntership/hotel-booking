@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('content')

<!-- Introduce Slider -->
<section class="revolution-slider">
  <div class="bannercontainer">
    <div class="banner">
      <ul>
        <!-- Slide 1 -->
        <li data-transition="fade" data-slotamount="7" data-masterspeed="1500" > 
          <!-- Main Image --> 
          <img src="{{ asset('frontend/images/slide2.jpg') }}"" style="opacity:0;" alt="slidebg1"  data-bgfit="cover" data-bgposition="left bottom" data-bgrepeat="no-repeat"> 
          <!-- Layers -->           
          <!-- Layer 1 -->
          <div class="caption sft revolution-starhotel bigtext"  
                  data-x="505" 
                        data-y="30" 
                        data-speed="700" 
                        data-start="1700" 
                        data-easing="easeOutBack"> 
            <span><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></span> A Five Star Hotel <span><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></span></div>
          <!-- Layer 2 -->
          <div class="caption sft revolution-starhotel smalltext"  
                  data-x="605" 
                        data-y="105" 
                        data-speed="800" 
                        data-start="1700" 
                        data-easing="easeOutBack">
            <span>And we like to keep it that way!</span></div>
          <!-- Layer 3 -->
                  <div class="caption sft"  
                  data-x="775" 
                        data-y="175" 
                        data-speed="1000" 
                        data-start="1900" 
                        data-easing="easeOutBack">
            <a href="/detailHotel" class="button btn btn-purple btn-lg">See more</a> 
                  </div>
        </li>
    <!-- Slide 2 -->
        <li data-transition="boxfade" data-slotamount="7" data-masterspeed="1000" > 
          <!-- Main Image --> 
          <img src="{{ asset('frontend/images/slide1.jpg') }}"  alt="darkblurbg"  data-bgfit="cover" data-bgposition="left top" data-bgrepeat="no-repeat"> 
          <!-- Layers -->           
          <!-- Layer 1 -->
          <div class="caption sft revolution-starhotel bigtext"  
                  data-x="585" 
                        data-y="30" 
                        data-speed="700" 
                        data-start="1700" 
                        data-easing="easeOutBack"> 
            <span><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></span> Double room <span><i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i></span></div>
          <!-- Layer 2 -->
          <div class="caption sft revolution-starhotel smalltext"  
                  data-x="682" 
                        data-y="105" 
                        data-speed="800" 
                        data-start="1700" 
                        data-easing="easeOutBack">
            <span>€ 99,- a night this summer</span></div>
        <!-- Layer 3 -->
                  <div class="caption sft"  
                  data-x="785" 
                        data-y="175" 
                        data-speed="1000" 
                        data-start="1900" 
                        data-easing="easeOutBack">
            <a href="room-detail.html" class="button btn btn-purple btn-lg">Book this room</a> 
                  </div>
        </li>
      </ul>
    </div>
  </div>
</section>

{{-- search form --}}
@include('frontend.layouts.partials.search')

<!-- Outstanding Places -->
<section class="rooms mt50">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>Outstanding Places</span></h2>
      </div> 
      <!-- 3 place top -->
      @for ($i = 0; $i < 3; $i++)
        <div class="col-sm-4">
          <div class="room-thumb"> <img src="{{ asset('frontend/images/place1.jpg') }}" alt="topPlace" class="img-responsive" />
            <div class="mask">
              <div class="main">
                <h5>Ha Noi</h5>
                <div class="price">More 100 hotels</div>
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
                <a href="room-detail.html" class="btn btn-primary btn-block">Read More</a>
              </div>
            </div>
          </div>
        </div> 
      @endfor
    </div>
  </div>
</section>

 <!-- 4 place top -->
<section class="rooms mt50">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
      </div>
      <!-- place 1-->
       @for ($i = 0; $i < 4; $i++)
          <div class="col-sm-3">
            <div class="second-place">
            <img src="{{ asset('frontend/images/place2.jpg') }}" alt="topPlace" class="img-responsive" />  
              <div class="second-place-bottom"> 
              <h5>Da Nang</h5>
              </div>
            </div>
          </div>
       @endfor
    </div>
  </div>
</section>
<!-- top hotel -->
<section class="rooms mt50">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>Representative Hotels</span></h2>
      </div> 
      <!-- 3 place top -->
      @for ($i = 0; $i < 6; $i++)
        <div class="col-sm-4">
          <div class="room-thumb"> <img src="{{ asset('frontend/images/hotel2.jpg') }}" alt="hotel" class="img-responsive" />
            <div class="mask">
              <div class="main">
                <h5>Muong thanh</h5>
                <div class="price">® ® ® ® </div>
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
                <a href="/detailHotel" class="btn btn-primary btn-block">Read More</a>
              </div>
            </div>
          </div>
        </div> 
      @endfor
    </div>
  </div>
</section>
<!-- end top hotel -->

<!-- Why should you choose us? -->
<section class="usp mt100">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>Why should you choose us?</span></h2>
      </div>
      <div class="col-sm-3 bounceIn appear" data-start="0">
      <div class="box-icon">
        <div class="circle"><i class="fa fa-glass fa-lg"></i></div>
        <h3>Beverages included</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. </p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="400">
      <div class="box-icon">
        <div class="circle"><i class="fa fa-credit-card fa-lg"></i></div>
        <h3>Stay First, Pay After!</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. </p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="800">
      <div class="box-icon">      
        <div class="circle"><i class="fa fa-cutlery fa-lg"></i></div>
        <h3>24 Hour Restaurant</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. </p>
        </div>
        </div>
      <div class="col-sm-3 bounceIn appear" data-start="1200">
      <div class="box-icon">
        <div class="circle"><i class="fa fa-tint fa-lg"></i></div>
        <h3>Spa Included!</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. </p>
        </div>
    </div>
    </div>
  </div>
</section>

<!-- Parallax Effect-->
<script type="text/javascript">$(document).ready(function(){$('#parallax-image').parallax("50%", -0.25);});</script>

<section class="parallax-effect mt100">
  <div id="parallax-image" style="background-image: url({{ asset('frontend/images/imglast.jpg') }};">
    <div class="color-overlay fadeIn appear" data-start="600">
      <div class="container">
        <div class="content">
          <h3 class="text-center"><i class="fa fa fa-star-o"></i> Snolax N., Inc.</h3>
          <p class="text-center">A product of the Snorlax N. company
      <br></p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
