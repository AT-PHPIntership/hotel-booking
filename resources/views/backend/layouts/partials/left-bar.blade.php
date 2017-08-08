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
            <i class="fa fa-dashboard"></i> <span>{{ trans('admin_left-bar.home_page') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!--  introduction -->
        <li class="treeview">
          <a href="../../pages/static page/indexAboutUs.html">
            <i class="fa fa-table"></i> <span>{{ trans('admin_left-bar.introduce') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!--  news -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span>{{ trans('admin_left-bar.news') }}</span>
            <span class="pull-right-container">
              <span class="label label-primary pull-right">135</span>
            </span>
          </a>
        </li>

        <!-- user -->
        <li>
          <a href="pages/widgets.html">
            <i class="fa fa-th"></i> <span>{{ trans('admin_left-bar.users') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-green">23</small>
            </span>
          </a>
        </li>

       <!--  category -->
        <li class="treeview">
          <a href="{{ route('category.index') }}">
            <i class="fa fa-pie-chart"></i>
            <span>{{ trans('admin_left-bar.categories') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!-- hotel -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>{{ trans('admin_left-bar.hotels') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!-- comment and rating -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-edit"></i> <span>{{ trans('admin_left-bar.comment') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
        </li>

        <!-- booking room -->
        <li>
          <a href="pages/calendar.html">
            <i class="fa fa-calendar"></i> <span>{{ trans('admin_left-bar.book_room') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-red">17</small>
              <small class="label pull-right bg-blue">4</small>
            </span>
          </a>
        </li>

        <!-- feedback -->
        <li>
          <a href="pages/mailbox/mailbox.html">
            <i class="fa fa-envelope"></i> <span>{{ trans('admin_left-bar.feedback') }}</span>
            <span class="pull-right-container">
              <small class="label pull-right bg-yellow">102</small>
            </span>
          </a>
        </li>

        <!-- place -->
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i> <span>{{ trans('admin_left-bar.places') }}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
            <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
            <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
            <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
            <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
            <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
            <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
            <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
            <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>