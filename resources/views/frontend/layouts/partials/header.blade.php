<!-- Top header -->
<div id="top-header">
  <div class="container">
    <div class="row">
      <div class="col-xs-6">
        <div class="th-text pull-left">
        </div>
      </div>
      <div class="col-xs-6">
        <div class="th-text pull-right">
          <div class="th-item">
            <div class="btn-group">
              <button id="js-language" class="btn btn-default btn-xs dropdown-toggle js-activated"
                type="button" data-toggle="dropdown">
                {{ Cookie::get('frontend_locale') == 'vi' ? __('Tiếng Việt') : __('English') }}
                <span class="caret"></span>
              </button> 
              <ul class="dropdown-menu">
                <li>
                  <a href="{{ route('frontend.language', ['lang' => 'en']) }}">
                    {{ __('English') }}
                  </a>
                </li>
                <li class="active">
                  <a href="{{ route('frontend.language', ['lang' => 'vi']) }}">
                    {{ __('Tiếng Việt') }}
                  </a>
                </li>
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
        <a href="/" class="navbar-brand">         
        <!-- Logo -->
          <img class="logo-header" src="{{asset('frontend/images/logo.png')}}" alt="Snorlax" class="logo-header">
        </a>
        </div>
      <div id="navbar-collapse-grid" class="navbar-collapse collapse fz-16">
        <ul class="nav navbar-nav">
          <li class="dropdown {{ isActiveRoute('home.index') }}"> <a href="/">{{ __('Home') }}</a>
          </li>
        <!-- hotels -->
          <li class="{{ areActiveRoute(['hotels.index', 'hotels.show']) }}"> <a href="{{ route('hotels.index') }}">{{ __('Hotels') }}</b></a>
          </li>
        <!-- news -->
          <li class="{{ areActiveRoute(['frontend.news.index', 'frontend.news.show']) }}"> <a href="{{ route('frontend.news.index') }}">{{ __('News') }}</a>
          @if(Auth::check())
            <li class="dropdown"> <a href="#" data-toggle="dropdown" class="dropdown-toggle js-activated">{{Auth::user()->username}}<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="{{ route('profile.show', Auth::user()->id) }}" id="user-profile">{{__('Profile')}}</a></li>
                @if(Auth::user()->is_admin == App\Model\User::ROLE_ADMIN)
                  <li><a href="{{ route('admin.index') }}">
                    {{__('Admin Management')}}</a>
                  </li>
                @endif
                <li>
                  <a href="{{ route('logout') }}" id ="logout">{{__('Log out')}}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" hidden="">
                    {{ csrf_field() }}
                  </form>
                </li>
              </ul>
            </li>
          @else
            <li> <a href="{{ route('login') }}" id="login">{{__('Login')}}</a></li>
            <li> <a href="{{ route('register') }}" id="register">{{__('Register')}}</a>
          @endif
          </li>
        </ul>
      </div>
    </div>
  </div>
</header>