@extends('backend.layouts.main')
@section('title', __('Update Category'))
@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
     <section class="content">
      <h1 class="title-page text-success">
        {{ __('Update Category') }}
      </h1>
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter information') }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('category.update', $category->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="InputName">{{ __('Category name') }}</label>
                    
                  <input type="text" class="form-control" id="InputName" placeholder="Input Category Name" value="{{ $category->name }}" title="Input Name" name="name">
                  <span class="alert-danger">{{ $errors->first('name') }}</span>
                </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('category.index') }}" id="cancel" name="cancel" class="btn btn-default">Back</a>
                <button type="reset" class="btn btn-warning">{{ __('Reset') }}</button>
                <button type="submit" class="btn btn-primary pull-right">{{ __('Submit') }}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>    
</div>
@endsection
