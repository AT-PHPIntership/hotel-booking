@extends('backend.layouts.main')

@section('title', __('User'))

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Management Users') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i> {{ __('Home Page') }}</a></li>
        <li class="active">{{ __('Users') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="title-user mb-10">
                <h3 class="box-title title-header">{{ __('List Users') }}</h3>
              </div>  
              <div class="row">
                <div class="col-md-6">
                  <form method="GET" action="{{ route('user.index') }}" class="container-search">
                    <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{ app('request')->input('search') }}">
                    <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                </div>
                <div class="contain-btn">
                  <a class="btn btn-primary" href="{{ route('user.create')}}" id="btn-add-user">
                  <span class="fa fa-plus-circle"></span>
                  {{ __('Add user') }}
                  </a>
                </div>
              </div>
            </div>
             <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              @include('backend.layouts.partials.modal')
              <table id="table-contain" class="table table-bordered table-responsive table-striped">
                <thead>
                  <tr align="center">
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Username') }}</th>
                    <th>{{ __('Full Name') }}</th>
                    <th>{{ __('Email')}}</th>
                    <th>{{ __('Phone') }}</th>
                    <th class="text-center">{{ __('Role') }}</th>
                    <th class="text-center">{{ __('Status') }}</th>
                    <th class="text-center">{{ __('Option') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                    <tr>
                      <td>{{ $user->id }}</td>
                      <td>
                        <a href="{{ route('user.show', $user->id) }}">
                          {{ $user->username }}
                        </a>
                      </td>
                      <td>{{ $user->full_name }}
                      <td>{{ $user->email }}</td>
                      <td>{{ $user->phone }}
                      <td class="text-center">
                        <form method="POST" action="{{ route('user.updateRole', $user->id) }}">
                          {!! csrf_field() !!}
                          {{ method_field('PUT') }}
                          @if ($user->is_admin == App\Model\User::ROLE_ADMIN)
                            <button type="submit" class="btn btn-default btn-on btn-sm">{{ __('Admin') }}</button>
                          @else
                            <button type="submit" class="btn btn-default btn-off btn-sm">{{ __('User') }}</button>
                          @endif
                        </form>
                      </td>
                      <td class="text-center">
                        <form method="POST" action="{{ route('user.updateStatus', $user->id) }}">
                          {!! csrf_field() !!}
                          {{ method_field('PUT') }}
                          @if ($user->is_active == App\Model\User::STATUS_ACTIVED)
                            <button type="submit" class="btn btn-default btn-on btn-sm">{{ __('Active') }}</button>
                          @else
                            <button type="submit" class="btn btn-default btn-off btn-sm">{{ __('Disabled') }}</button>
                          @endif
                        </form>
                      </td>
                      <td align="center">
                        <div class="btn-option text-center">
                          <a href="{{ route('user.edit', $user->id) }}"  class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left" >
                          </a>
                          <form method="POST" action="{{ route('user.destroy', $user->id) }}" class="inline">
                            {!! csrf_field() !!}
                            {{ method_field('DELETE') }}
                            <button type="submit" 
                              class="btn-custom-option btn btn-delete-item fa fa-trash-o"
                              data-title="{{ __('Confirm deletion!') }}"
                              data-confirm="{{ __('Are you sure you want to delete?') }}">
                            </button>
                          </form> 
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="cls-search-not-found text-center" hidden="">
                {{__('Data Not Found')}}
              </div>
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

@endsection
