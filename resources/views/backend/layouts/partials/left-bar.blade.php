<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
      <img src="{{ asset('bower_components/AdminLTE/dist/img/user3-128x128.jpg') }}"
       class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Nguyễn Quốc Ân</p>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">{{ __('Adminstrator')  }}</li>
      <!-- index -->
      <li class="{{ isActiveRoute('admin.index') }}">
        <a href="/admin">
          <i class="fa fa-home" aria-hidden="true"></i> <span>{{ __('Home Page') }}</span>
        </a>
      </li>

      <!--  introduction -->
      <li class="{{ areActiveRoute(['static-page.index', 'static-page.edit']) }}">
        <a href="{{ route('static-page.index') }}">
          <i class="fa fa-table"></i> <span>{{ __('Static Pages') }}</span>
        </a>
      </li>

      <!--  news -->
      <li class="{{ areActiveRoute(['news.index','news.create', 'news.edit']) }}">
        <a href="{{ route('news.index') }}">
          <i class="fa fa-files-o"></i>
          <span>{{ __('News') }}</span>
        </a>
      </li>

      <!-- user -->
      <li class="{{ areActiveRoute(['user.index','user.create', 'user.edit', 'user.show']) }}">
        <a href="{{ route('user.index') }}">
          <i class="fa fa-male" aria-hidden="true"></i>
          <span>{{ __('Users') }}</span>
        </a>
      </li>

     <!--  category -->
      <li class="{{ areActiveRoute(['category.index','category.create', 'category.edit']) }}">
        <a href="{{ route('category.index') }}" id="bt-category">
          <i class="fa fa-pie-chart"></i>
          <span>{{ __('Categories') }}</span>
        </a>
      </li>

      <!-- hotel -->
      <li class="{{ areActiveRoute(['hotel.index','hotel.create', 'hotel.edit', 'hotel.show']) }}">
        <a href="{{ route('hotel.index') }}">
          <i class="fa fa-bed" aria-hidden="true"></i></i>
          <span>{{ __('Hotels') }}</span>
        </a>
      </li>

      <!-- comment and rating -->
      <li class="{{ isActiveRoute('comment.index') }}">
        <a href="{{ route('comment.index') }}">
          <i class="fa fa-commenting-o" aria-hidden="true"></i> <span>{{ __('Comment and Rating') }}</span>
        </a>
      </li>

      <!-- booking room -->
      <li class="{{ areActiveRoute(['reservation.index','reservation.show', 'reservation.edit']) }}">
        <a href="{{ route('reservation.index') }}">
          <i class="fa fa-calendar"></i> <span>{{ __('Booking Room') }}</span>
        </a>
      </li>

      <!-- feedback -->
      <li>
        <a href="#">
          <i class="fa fa-envelope"></i> <span>{{ __('Feedbacks') }}</span>
        </a>
      </li>

      <!-- place -->
      <li class="{{ areActiveRoute(['place.index','place.create', 'place.edit']) }}">
        <a href="{{ route('place.index') }}" id="place">
          <i class="fa fa-map-marker" aria-hidden="true"></i> <span>{{ __('Places') }}</span>
        </a>
      </li>

      <!-- service -->
      <li class="{{ areActiveRoute(['service.index','service.create', 'service.edit']) }}">
        <a href="{{ route('service.index') }}" >
          <i class="fa fa-empire" aria-hidden="true"></i><span>{{ __('Services') }}</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
