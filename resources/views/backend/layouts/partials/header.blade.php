<header class="main-header">
  <a href="{{ route('admin.index') }}" class="logo">
    <span class="logo-lg"><b>{{__('Admin ')}}</b> {{__('Management')}}</span>
  </a>
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only"></span>
    </a>
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
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
      </ul>
    </div>
  </nav>
</header>