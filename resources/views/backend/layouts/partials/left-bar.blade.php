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
          <a href="../index.html">
            <i class="fa fa-dashboard"></i> <span>{{ __('Home Page') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!--  introduction -->
        <li class="treeview">
          <a href="../../pages/static page/indexAboutUs.html">
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
            <i class="fa fa-th"></i> <span>{{ __('Users') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">23</small>
            </span>
          </a>
        </li>

       <!--  category -->
        <li class="treeview">
          <a href="{{ route('category.index') }}">
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
            <i class="fa fa-laptop"></i>
            <span>{{ __('Hotels') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!-- comment and rating -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>{{ __('Comment and Rating') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!-- booking room -->
        <li>
          <a href="{{ route('bookingroom.index') }}">
            <i class="fa fa-calendar"></i> <span>{{ __('Booking Room') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">17</small>
              <small class="label pull-right bg-blue">4</small>
            </span>
          </a>
        </li>

        <!-- feedback -->
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>{{ __('Feedback') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">102</small>
            </span>
          </a>
        </li>

        <!-- place -->
        <li>
          <a href="{{ route('place.index') }}" id="place">
            <i class="fa fa-university"></i> <span>{{ __('Place') }}</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
</aside>
