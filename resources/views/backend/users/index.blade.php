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
             <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                  <form method="GET" action="{{ route('user.index') }}" class="container-search">
                    <input class="input-search form-control" placeholder="Search" name="keyword" type="text" value="{{ app('request')->input('keyword') }}">
                    <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                </div>
                <div class="contain-btn">
                  <a class="btn btn-primary" href="{{ route('user.create')}}">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add user') }}
                  </a>
                </div>
              </div>
              @include('backend.layouts.partials.modal')
              <table id="table-contain" class="table table-bordered table-responsive table-striped">
                <thead>
                  <tr align="center">
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Username') }}</th>
                    <th>{{ __('Full Name') }}</th>
                    <th>{{ __('Email')}}</th>
                    <th>{{ __('Phone') }}</th>
                    <th>{{ __('Role') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Option') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>{{ $user->username }}
                      <!-- <td>{{ $user->password }}</td> -->
                      <td>{{ $user->full_name }}
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phone }}
                      <td>
                        @if ($user->is_admin == App\Model\User::ROLE_ADMIN)
                          <form >
                            <button type="submit" class="btn btn-default btn-on btn-sm">{{ __('Admin') }}</button>
                          </form>
                        @else
                          <form >
                            <button type="submit" class="btn btn-default btn-off btn-sm">{{ __('User') }}</button>
                        @endif
                      </td>
                      <td>
                        @if ($user->is_active == App\Model\User::STATUS_ACTIVED)
                          <form >
                            <button type="submit" class="btn btn-default btn-on btn-sm">{{ __('Active') }}</button>
                          </form>
                        @else
                          <form >
                            <button type="submit" class="btn btn-default btn-off btn-sm">{{ __('Disabled') }}</button>
                        @endif
                      </td>
                      <td align="center">
                        <div class="option-btn">
                          <a href="{{ route('user.edit', $user->id) }}"  class="btn-edit fa fa-pencil-square-o btn-pencil cus-icon-sm" >
                          </a>
                          <form method="POST" action="{{ route('user.destroy', $user->id) }}" class="inline">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            {!! csrf_field() !!}
                            <button 
                              class="fa fa-trash-o cus_icon btn btn-delete-item" type="submit" 
                              data-title="{{ __('Confirm deletion!') }}"
 +                            data-confirm="{{ __('Are you sure you want to delete?') }}"
 +                            title="{{ __('Delete User') }}">
                            </button>
                          </form> 
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="contain-btn second">
                <a class="btn btn-primary" href="{{ route('user.create')}}">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add user') }}
                </a>
              </div>
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