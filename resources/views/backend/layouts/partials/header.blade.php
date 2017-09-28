<header class="main-header">
  <a href="{{ route('admin.index') }}" class="logo">
    <span class="logo-lg"><b>{{__('Admin ')}}</b> {{__('Management')}}</span>
  </a>
  <nav class="navbar navbar-static-top">
    <div class="btn-group cls-admin-language pull-right mr-10">
      <button class="btn btn-default btn-xs dropdown-toggle js-activated"
        type="button" data-toggle="dropdown">
        @php($locale = Cookie::get('admin_locale'))
        {{ $locale == 'vi' ? __('Tiếng Việt') : __('English') }}
        <span class="caret"></span>
      </button> 
      <ul class="dropdown-menu">
        <li class="{{ $locale == 'en' ? 'active' : '' }}">
          <a href="{{ route('admin.language', ['lang' => 'en']) }}">
            {{ __('English') }}
          </a>
        </li>
        <li class="{{ $locale == 'vi' ? 'active' : '' }}">
          <a href="{{ route('admin.language', ['lang' => 'vi']) }}">
            {{ __('Tiếng Việt') }}
          </a>
        </li>
      </ul>

    </div>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="dropdown user user-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <img src="{{ asset('bower_components/AdminLTE/dist/img/user3-128x128.jpg') }}" class="user-image" alt="User Image">
            <span class="hidden-xs">{{Auth::user()->full_name}}</span>
          </a>
          <ul class="dropdown-menu">
            <li class="user-header">
              <img src="{{ asset('bower_components/AdminLTE/dist/img/user3-128x128.jpg') }}" class="img-circle" alt="User Image">
              <p>
                {{Auth::user()->full_name}} - {{__('Web Developer')}}
                <small>{{__('Member since Jun. 2017')}}</small>
              </p>
            </li>
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">{{__('Profile')}}</a>
              </div>
              <div class="pull-right">
                <form action="{{ route('logout') }}" method="POST">
                  {{csrf_field()}}
                  <button type="submit" name="logout">
                    {{__('Log out')}}
                  </button>
                </form>
              </div>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </nav>
</header>