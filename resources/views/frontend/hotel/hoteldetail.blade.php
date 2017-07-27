@extends('templates.frontend.master')
@section('content')

 <!-- Slider -->
    <section class="standard-slider room-slider">
      <div class="col-sm-12 col-md-8">
        <div id="owl-standard" class="owl-carousel">
          <div class="item"> <a href="" data-rel="prettyPhoto[gallery1]">
          <img src="{{ asset('frontend/images/rooms/slider/750x481.gif')}}" alt="Image 2" class="img-responsive"></a> </div>
          <div class="item"> <a href="" data-rel="prettyPhoto[gallery1]">
          <img src="{{ asset('frontend/images/rooms/slider/750x481.gif')}}" alt="Image 2" class="img-responsive"></a> </div>
        </div>
      </div>
    </section>
<!-- Rooms -->
 <!-- Room Content -->
    <section>
      <div class="container">
        <div class="row">
          <div class="col-sm-7 mt50">
            <h2 class="lined-heading"><span>Room Details</span></h2>
            <h3 class="mt50">Table overview</h3>
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
            <p class="mt50">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc ligula nibh, cursus id euismod non, scelerisque nec nibh. Nam semper, ligula a rhoncus fermentum, libero lacus vulputate felis, id auctor mauris urna quis diam.</p>
          </div>
          <div class="col-sm-5 mt50">
            <h2 class="lined-heading"><span>Overview</span></h2>
            
            <!-- Nav tabs -->
            <ul class="nav nav-tabs">
              <li class="active"><a href="#overview" data-toggle="tab">Overview</a></li>
              <li><a href="#facilities" data-toggle="tab">Facilities</a></li>
              <li><a href="#extra" data-toggle="tab">Extra</a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
              <div class="tab-pane fade in active" id="overview">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum. In hendrerit risus arcu, in eleifend metus dapibus varius. Nulla dolor sapien, laoreet vel tincidunt non, egestas non justo. Phasellus et mattis lectus, et gravida urna.</p>
                <p><img src="images/tab/197x147.gif" alt="food" class="pull-right"> Donec pretium sem non tincidunt iaculis. Nunc at pharetra eros, a varius leo. Mauris id hendrerit justo. Mauris egestas magna vitae nisi ultricies semper. Nam vitae suscipit magna. Nam et felis nulla. Ut nec magna tortor. Nulla dolor sapien, laoreet vel tincidunt non, egestas non justo. </p>
              </div>
              <div class="tab-pane fade" id="facilities">Phasellus sodales justo felis, a vestibulum risus mattis vitae. Aliquam vitae varius elit, non facilisis massa. Vestibulum luctus diam mollis gravida bibendum. Aliquam mattis velit dolor, sit amet semper erat auctor vel. Integer auctor in dui ac vehicula. Integer fermentum nunc ut arcu feugiat, nec placerat nunc tincidunt. Pellentesque in massa eu augue placerat cursus sed quis magna.</div>
              <div class="tab-pane fade" id="extra">Aa vestibulum risus mattis vitae. Aliquam vitae varius elit, non facilisis massa. Vestibulum luctus diam mollis gravida bibendum. Aliquam mattis velit dolor, sit amet semper erat auctor vel. Integer auctor in dui ac vehicula. Integer fermentum nunc ut arcu feugiat, nec placerat nunc tincidunt. Pellentesque in massa eu augue placerat cursus sed quis magna.</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</div>

<!-- Other Rooms -->
<section class="rooms mt50">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h2 class="lined-heading"><span>Other rooms</span></h2>
      </div>
      <!-- Room -->
      <div class="col-sm-4">
        <div class="room-thumb"> <img src="images/rooms/356x228.gif" alt="room 1" class="img-responsive" />
          <div class="mask">
            <div class="main">
              <h5>Double bedroom</h5>
              <div class="price">&euro; 99<span>a night</span></div>
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
      <!-- Room -->
      <div class="col-sm-4">
        <div class="room-thumb"> <img src="images/rooms/356x228.gif" alt="room 2" class="img-responsive" />
          <div class="mask">
            <div class="main">
              <h5>King Size Bedroom </h5>
              <div class="price">&euro; 149<span>a night</span></div>
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
      <!-- Room -->
      <div class="col-sm-4">
        <div class="room-thumb"> <img src="images/rooms/356x228.gif" alt="room 3" class="img-responsive" />
          <div class="mask">
            <div class="main">
              <h5>Single room</h5>
              <div class="price">&euro; 120<span>a night</span></div>
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
    </div>
  </div>
</section>

@endsection