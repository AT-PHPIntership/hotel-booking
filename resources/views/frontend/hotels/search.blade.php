@extends('frontend.layouts.partials.master')
@section('customcss')
<link rel="stylesheet" type="text/css" href="{{asset('frontend/css/searchHotel.css')}}">
@endsection
@section('content')
<main class="main">
  <div class = "formSearch">
    @include('frontend.layouts.partials.search')
  </div>
  <section id="reservation-form">
    <div class="container">
      <div class="row">
        <div class="col-md-12">   
          <div class="reservation-horizontal clearfix container-search filterHotel">
            <div class="row">
              <div class="col-md-12">           
                <div class="filter-group">
                  <p>Order by: </p>
                </div>
                <div class="filter-group">
                  <a href="#">Propose</a>
                </div>
                <div class="filter-group">
                  <ul>
                    <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated">Rating<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="room-list.html">ASC</a></li>
                        <li><a href="room-detail.html">DESC</a></li>
                      </ul>
                    </li>
                  </ul>  
                </div>
                <div class="filter-group">
                  <ul>
                    <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated">Star<b class="caret"></b></a>
                      <ul class="dropdown-menu">
                        <li><a href="room-list.html">ASC</a></li>
                        <li><a href="room-detail.html">EDSC</a></li>
                      </ul>
                    </li>
                  </ul>  
                </div>
            </div>
          </div>
          </div>
        </div>  
      </div>
    </div>
  </section>
  @for($i = 0; $i<3 ;$i++)
  <div class = "listHotel">
      <div class = "hotel-image" >
      <img src="{{asset('frontend/images/hotel2.jpg')}}">
      </div>
      <div class = "hotel-item">
        <h1 class = 'hotel-name'>Hotel Name</h1>
        <p>*****</p>
        <p>Quận Hải Châu, Thành phố Đà Nẵng</p>
        <p>Rating</p>
      </div>
      <div class="hotel-item">
        <h2 class= 'hotel-price'>Price</h2>
        <h3>$ 200.5 </h3>
        <button name = 'btnBookRoom' class="btn btn-primary"><a href="/detailHotel">See more</a></button>
      </div>
  </div>
  @endfor
</main>  
@endsection