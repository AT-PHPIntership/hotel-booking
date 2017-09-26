@extends('backend.layouts.main')

@section('title',__('Create Category'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="text-center text-success">
        {{ __("Create Category") }}
      </h1>
      <div class="row margin-center">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __("Enter infomation") }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('category.store') }}" class="">
              {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="input-name">{{ __('Category name') }}</label>
                  <input type="text" class="form-control" id="input-name" placeholder="{{ __('Input Category Name')}}" value="" title="Input Name" name="name" class="col-md-6">
                  <br/>
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('category.index') }}" id="cancel" name="cancel" class="btn btn-default">{{ __('Back') }}</a>
                <button type="reset" class="btn btn-warning">{{ __('Reset') }}</button>
                <button type="submit" class="btn btn-primary btn-submit pull-right">{{ __('Submit') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>   
@endsection