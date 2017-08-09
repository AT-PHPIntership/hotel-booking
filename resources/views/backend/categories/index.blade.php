@extends('backend.layouts.main')

@section('title','Category')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <!-- {{ trans('admin_categories.categories_news') }} -->
        {{ __('Categories News') }}
        <small>{{ __('Categories') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('Home Page') }}</a></li>
        <li class="active">{{ __('Categories') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __('List Categories') }}</h3>
            </div>
            <div>
            @include('flash::message')
            </div>
            <div class="btn-create">
              <a href="{{ route('category.create') }}">
              <span>{{ __('Add Category') }} <img src="{{ asset('bower_components/AdminLTE/dist/img/plus-small.gif') }}" alt="ThemTin"></span>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list_table" class="table table-bordered table-striped">
                <thead>
                <tr align="center">
                  <th >{{ __('ID') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th colspan="2">{{ __('Function') }}</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($categories as $objCat)
                <tr>
                  <td>{{ $objCat->id }}</td>
                  <td>{{ $objCat->name }}
                  </td>
                  <td align="center">
                    <a href="{{ route('category.edit',$objCat->id) }}"> <img src="{{ asset('bower_components/AdminLTE/dist/img/pencil.gif') }}" alt="edit" /></a>
                  </td>
                  <td>
                     <form method="POST" action="{{ route('category.destroy', $objCat->id) }}" class="form-del">
                       <input type="hidden" name="_token"  value="{!! csrf_token()!!}">
                      {{ method_field('DELETE') }}
                        <button type="submit" name="" onclick="return confirm(trans('messages.confirm'))"><img src="{{ asset('bower_components/AdminLTE/dist/img/bin.gif') }}" width="16" height="16" alt="delete" /></button>
                    </form>
                  </td>
                   
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
@include('backend.layouts.partials.infor')
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
