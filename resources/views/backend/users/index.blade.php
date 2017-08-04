@extends('backend.layouts.main')

@section('title','User')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ trans('admin_user.list_user') }}
        <small>advanced tables</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ trans('admin_user.home_page') }}</a></li>
        <li class="active">{{ trans('admin_user.list_user') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ trans('admin_user.list_user') }}</h3>
              @include('flash::message')
            </div>
            <div class="float-left">
              <a href="{{ route('user.create')}}">
              <span class="btn btn-primary">{{ trans('admin_user.add_user') }}
                <i class="fa fa-plus"></i>
              </span>
              </a>
            </div>
             <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-sm-6 form-search">
                  <div id="example1_filter" class="dataTables_filter">
                    <form method="GET">
                      <label>{{ trans('admin_user.search') }}</label>
                      <input type="search" class="form-control input-sm" 
                        placeholder="">
                    </form>    
                  </div>
                </div>
              </div>
              <table id="list-table" class="table table-bordered table-striped">
                <thead>
                <tr align="center">
                  <th>{{ trans('admin_user.no') }}</th>
                  <th>{{ trans('admin_user.user_name') }}</th>
                  <th>{{ trans('admin_user.full_name') }}</th>
                  <th>{{ trans('admin_user.email') }}</th>
                  <th>{{ trans('admin_user.phone') }}</th>
                  <th>{{ trans('admin_user.is_admin') }}</th>
                  <th>{{ trans('admin_user.is_active') }}</th>
                  <th>{{ trans('admin_user.action') }}</th>
                </tr>
                </thead>
                <tbody>
            @php ($index = 1)
            @foreach ($users as $objUser)
                <tr>
                  <td>{{ $index++ }}</td>
                  <td>{{ $objUser->username }}
                  <!-- <td>{{ $objUser->password }}</td> -->
                  <td>{{ $objUser->full_name }}
                  <td>{{ $objUser->email }}</td>
                  <td>{{ $objUser->phone }}
                  <td>{{ $objUser->is_admin }}</td>
                  <td>{{ $objUser->is_active }}
                  </td>
                  <td align="center">
                    <a href="{{ route('user.edit', $objUser->id) }}" >
                      <i class= "fa fa-pencil-square-o cus_icon"></i>
                    </a>
                    <form method="POST" action="{{ route('user.destroy', $objUser->id) }}" class="inline">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="user_id" value="{{ $objUser->id }}">
                      {!! csrf_field() !!}
                      <button class="fa fa-trash-o cus_icon" onclick="return confirm('{{ trans('admin_user.confirm_delete') }}');" type="submit" class="btn">
                      </button>
                    </form> 
                  </td>
                </tr>
                @endforeach
               </tbody>
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
<!-- ./wrapper -->

@endsection
