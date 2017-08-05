@extends('backend.layouts.main')

@section('title','User')

@section('content')
 <div class="content-wrapper">
      <h1 class="title_page text-success">
        @include('flash::message')
        {{ trans('admin_user.create_user') }}
      </h1>

    <!-- Main content -->
    <section class="content">
      <div class="row margin_center">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ trans('admin_user.enter_information') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ route('user.store') }}">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group">
                  <label for="UserName">{{ trans('admin_user.user_name') }}</label>
                  <input type="text" class="form-control{{ $errors->has('UserName') ? ' has-error' : '' }}" name= "UserName" id="UserName" placeholder="Enter UserName">
                  <small class="text-danger">{{ $errors->first('UserName') }}</small>
                </div>
                <div class="form-group has-feedback {{ $errors->has('Password') ? ' has-error' : '' }}">
                  <label for="Password">{{ trans('admin_user.password') }}</label>
                  <input type="password" class="form-control" name= "Password" id="Password" placeholder="Enter Password">
                  <small class="text-danger">{{ $errors->first('Password') }}</small>
                </div>
                <div class="form-group{{ $errors->has('FullName') ? ' has-error' : '' }}">
                <label for="FullName">{{ trans('admin_user.full_name') }}</label>
                <input type="text" class="form-control" name= "FullName" id="FullName" placeholder="Enter FullName"> 

                <small class="text-danger">{{ $errors->first('FullName') }}</small>
                </div>
                <div class="form-group{{ $errors->has('Email') ? ' has-error' : '' }}">
                  <label for="Email">{{ trans('admin_user.email') }}</label>
                  <input type="text" class="form-control" name= "Email" id="Email" placeholder="Enter Your Email" data-toggle="tooltip" title="yourmail@gmail.com">
                  <small class="text-danger">{{ $errors->first('Email') }}</small>
                </div>
                <div class="form-group{{ $errors->has('Phone') ? ' has-error' : '' }}">
                  <label for="Phone">{{ trans('admin_user.phone') }}</label>
                  <input type="text" class="form-control" name= "Phone" id="Phone" placeholder="Enter Your Phone">
                  <small class="text-danger">{{ $errors->first('Phone') }}</small>
                </div>
                <div class="form-group col-md-6 pull-center">
                  <label for="IsActive">{{ trans('admin_user.is_active') }}</label>
                  <input type="checkbox" name="IsActive">
                </div>
                <div class="form-group col-md-6">
                  <label for="IsAdmin">{{ trans('admin_user.is_admin') }}</label>
                  <input type="checkbox" name="IsAdmin">
                </div>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="reset" class="btn btn-warning">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
</div>
@endsection