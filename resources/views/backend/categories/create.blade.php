@extends('backend.layouts.main')

@section('content')
 <div class="content-wrapper">
      <h1 class="title_page text-success">
        CREATE CATEGORIES NEWS
      </h1>

    <!-- Main content -->
    <section class="content">
      <div class="row margin_center">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">Enter infomation</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('category.store') }}">
            {{ csrf_field() }}
              <div class="box-body">
                <div class="form-group">
                  <label for="InputName">Name of Category News</label>
                  <input type="text" class="form-control" id="InputName" placeholder="Input Category Name" value="" title="Input Name" name="name">
                </div>
                <div class="form-group">
                  <label for="slug">Slug of Category News</label>
                  <input type="text" class="form-control" id="slug" placeholder="Input Slug" value="" title="Input Name" name="slug">
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