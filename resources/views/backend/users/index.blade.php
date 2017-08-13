@extends('backend.layouts.main')

@section('title', __('User'))

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('List Users') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> {{ __('Home Page') }}</a></li>
        <li class="active">{{ __('List Users') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ __('List Users') }}</h3>
              @include('flash::message')
            </div>
            <div class="float-left">
              <a href="{{ route('user.create')}}">
              <span class="btn btn-primary">{{ __('Add user') }}
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
                      <label>{{ __('Search') }}</label>
                      <input id="search-input" type="search" class="form-control input-sm" 
                        placeholder="" name="search_input">
                    </form>    
                  </div>
                </div>
              </div>
              </div>
              <table id="table-contain" class="table table-bordered table-striped">
                <thead>
                <tr align="center">
                  <th>{{ __('No') }}</th>
                  <th>{{ __('Username') }}</th>
                  <th>{{ __('Full Name') }}</th>
                  <th>{{ __('Email')}}</th>
                  <th>{{ __('Phone') }}</th>
                  <th>{{ __('Is Admin') }}</th>
                  <th>{{ __('Is Active') }}</th>
                  <th>{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
            @php ($index = 1)
            @foreach ($users as $user)
                <tr>
                  <td>{{ $index++ }}</td>
                  <td>{{ $user->username }}
                  <!-- <td>{{ $user->password }}</td> -->
                  <td>{{ $user->full_name }}
                  <td>{{ $user->email }}</td>
                  <td>{{ $user->phone }}
                  <td>{{ $user->is_admin }}</td>
                  <td>{{ $user->is_active }}
                  </td>
                  <td align="center">
                    <a href="{{ route('user.edit', $user->id) }}" >
                      <i class= "fa fa-pencil-square-o cus_icon"></i>
                    </a>
                    <form method="POST" action="{{ route('user.destroy', $user->id) }}" class="inline">
                      <input type="hidden" name="_method" value="DELETE">
                      <input type="hidden" name="user_id" value="{{ $user->id }}">
                      {!! csrf_field() !!}
                      <button class="fa fa-trash-o cus_icon btn btn-delete-item" type="submit" id="user_{{$user->id}}">
                      </button>
                    </form> 
                  </td>
                </tr>
                @endforeach
               </tbody>
              </table>
              {!! $users->render() !!}
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