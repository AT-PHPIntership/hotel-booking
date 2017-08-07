@extends('backend.layouts.main')
@section('title','Create Category Page')
@section('content')
 <div class="content-wrapper">
      <h1 class="title_page text-success">
        {{ trans('admin_categories.create_category') }}
      </h1>

    <!-- Main content -->
    <section class="content">
      <div class="row margin_center">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ trans('admin_categories.enter') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('category.store') }}">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="InputName">{{ trans('admin_categories.category_title') }}</label>
                  <input type="text" class="form-control has-error" id="InputName" placeholder="Input Category Name" value="" title="Input Name" name="name">
                  <span class="alert-danger">{{ $errors->first('name') }}</span>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-warning">{{ trans('admin_categories.reset') }}</button>
                <button type="submit" class="btn btn-primary">{{ trans('admin_categories.submit') }}</button>
              </div>
            </form>
          </div>
</div>
@endsection