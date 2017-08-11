@extends('backend.layouts.main')
@section('title', __('Update Category'))
@section('content')
 <div class="content-wrapper">
      <h1 class="title_page text-success">
        {{ __('Update Category') }}
      </h1>

    <!-- Main content -->
    <section class="content">
      <div class="row margin_center col-md-12">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter Information') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('category.update', $category->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="InputName">{{ __('Name of Category') }}</label>
                    
                  <input type="text" class="form-control" id="InputName" placeholder="Input Category Name" value="{{ $category->name }}" title="Input Name" name="name">
                  <span class="alert-danger">{{ $errors->first('name') }}</span>
                </div>
              <!-- /.box-body -->
              <div class="box-footer" align="center">
                <button type="reset" class="btn btn-warning">{{ __('Reset') }}</button>
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
                 <a href="{{ route('category.index') }}" id="cancel" name="cancel" class="btn btn-default">Cancel</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>    
</div>
@endsection