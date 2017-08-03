@extends('backend.layouts.master')

@section('title','User')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Thành Viên trong khách sạn
        <small>User</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Người dùng</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách Người dùng</h3>
            </div>
            <div class="float-left">
              <a href="">
              <span>Thêm Người dùng <img src="../../hotel_admin/dist/img/plus-small.gif" alt="ThemTin"></span>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Username</th>
                  <th>Password</th>
                  <th>Fullname</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>Is_Admin</th>
                  <th>Is_Active</th>
                  <th>Function</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</th>
                  <td>at-annguyen</th>
                  <td>123</th>
                  <td>Nguyễn Quốc Ân</th>
                  <td>an.nguyen@asiantech.vn</th>
                  <td>0935880743</th>
                  <td><img src="../hotel_admin/dist/img/notification-tick.gif"></th>
                  <td><img src="../hotel_admin/dist/img/notification-tick.gif"></th>
                  <td align="center">
                    <a href="">Sửa <img src="../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</th>
                  <td>at-annguyen</th>
                  <td>123</th>
                  <td>Nguyễn Quốc Ân</th>
                  <td>an.nguyen@asiantech.vn</th>
                  <td>0935880743</th>
                  <td><img src="../hotel_admin/dist/img/cross-on-white.gif"></th>
                  <td><img src="../hotel_admin/dist/img/notification-tick.gif"></th>
                  <td align="center">
                    <a href="">Sửa <img src="../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                   <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                 <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
                <tr>
                  <td>Id</th>
                  <td>Username</th>
                  <td>Password</th>
                  <td>Fullname</th>
                  <td>Email</th>
                  <td>Phone</th>
                  <td>Is_Admin</th>
                  <td>Is_Active</th>
                  <td>A</td>
                </tr>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <!-- /.control-sidebar-menu -->
  @include('backend.layouts.partials.infor'
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@endsection