
<!-- Top header -->
<div id="top-header">
  <div class="container">
    <div class="row">
      <div class="col-xs-6">
        <div class="th-text pull-left">
          <div class="th-item"> <a href="#"><i class="fa fa-phone"></i> 05-460789986</a> </div>
          <div class="th-item"> <a href="#"><i class="fa fa-envelope"></i> MAIL@STARHOTEL.COM </a></div>
        </div>
      </div>
      <div class="col-xs-6">
        <div class="th-text pull-right">
          <div class="th-item">
            <div class="btn-group">
              <button class="btn btn-default btn-xs dropdown-toggle js-activated" type="button" data-toggle="dropdown"> English <span class="caret"></span> </button>
              <ul class="dropdown-menu">
                <li> <a href="#">ENGLISH</a> </li>
                <li> <a href="#">VIETNAMESE</a> </li>
              </ul>
            </div>
          </div>
          <div class="th-item">
            <div class="social-icons"> <a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-youtube-play"></i></a> </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Header -->
<header>
  <!-- Navigation -->
  <div class="navbar yamm navbar-default" id="sticky">
    <div class="container">
      <div class="navbar-header">
        <button type="button" data-toggle="collapse" data-target="#navbar-collapse-grid" class="navbar-toggle"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <a href="/home" class="navbar-brand">         
        <!-- Logo -->
        <div id="logo"> <img id="default-logo" src="{{ asset('frontend/images/logo1.png')}}" alt="Snorlax" style="height:44px;"> <img id="retina-logo" src="images/logo-retina.png" alt="Starhotel" style="height:44px;"> </div>
        </a> </div>
      <div id="navbar-collapse-grid" class="navbar-collapse collapse">
        <ul class="nav navbar-nav">
          <li class="dropdown active"> <a href="/home">Home</a>
          </li>
        <!-- hotels -->
          <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated">Hotels<b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="room-list.html">Slector1</a></li>
                  <li><a href="room-detail.html">Slector1</a></li>
                </ul>
              </li>
        <!-- news -->
          <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated">News<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="blog.html">Sports</a></li>
              <li><a href="blog-post.html">Sale</a></li>
            </ul>
          </li>
          <li> <a href="{{ route('login') }}">Login</a></li>
          <li> <a href="{{ route('register') }}">Register</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>