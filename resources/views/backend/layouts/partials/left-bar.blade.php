<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
         <img src="{{ asset('bower_components/AdminLTE/dist/img/user3-128x128.jpg') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Nguyễn Quốc Ân</p>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Adminstrator</li>
        
        <!-- index -->
        <li class="active treeview">
          <a href="/admin">
            <i class="fa fa-home" aria-hidden="true"></i> <span>{{ __('Home Page') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!--  introduction -->
        <li class="treeview">
          <a href="{{ route('static-page.index') }}">
            <i class="fa fa-table"></i> <span>{{ __('Introduction') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!--  news -->
        <li class="treeview">
          <a href="{{ route('news.index') }}">
            <i class="fa fa-files-o"></i>
            <span>{{ __('News') }}</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">135</span>
            </span>
          </a>
        </li>

        <!-- user -->
        <li>
          <a href="{{ route('user.index') }}">
            <i class="fa fa-male" aria-hidden="true"></i>
            <span>{{ __('Users') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">23</small>
            </span>
          </a>
        </li>

       <!--  category -->
        <li class="treeview">
          <a href="{{ route('category.index') }}" id="bt-category">
            <i class="fa fa-pie-chart"></i>
            <span>{{ __('Categories') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!-- hotel -->
        <li class="treeview">
          <a href="{{ route('hotel.index') }}">
            <i class="fa fa-bed" aria-hidden="true"></i></i>
            <span>{{ __('Hotels') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!-- comment and rating -->
        <li class="treeview">
          <a href="{{ route('comment.index') }}">
            <i class="fa fa-commenting-o" aria-hidden="true"></i> <span>{{ __('Comment and Rating') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!-- booking room -->
        <li>
          <a href="#">
            <i class="fa fa-calendar"></i> <span>{{ __('Booking Room') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">17</small>
              <small class="label pull-right bg-blue">4</small>
            </span>
          </a>
        </li>

        <!-- feedback -->
        <li>
          <a href="#">
            <i class="fa fa-envelope"></i> <span>{{ __('Feedbacks') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">102</small>
            </span>
          </a>
        </li>

        <!-- place -->
        <li>
          <a href="{{ route('place.index') }}" id="place">
            <i class="fa fa-map-marker" aria-hidden="true"></i> <span>{{ __('Places') }}</span>
          </a>
        </li>

        <!-- service -->
        <li>
          <a href="{{ route('service.index') }}" >
            <i class="fa fa-empire" aria-hidden="true"></i><span>{{ __('Services') }}</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>
