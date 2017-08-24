@extends('backend.layouts.main')
@section('title', __('Update Static Page'))
@section('content')
 <div class="content-wrapper">
      <h1 class="title_page text-success">
        {{ __('Update Static Page') }}
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
            <form method="POST" action="{{ route('static-page.update', $staticPage->id) }}">
            {{ csrf_field() }}
            {{ method_field('PUT') }}
              <div class="box-body">
              	<div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
                  <label for="content">{{ __('Title of Static Page') }}</label>
                  <input type="text" class="form-control" id="title" placeholder="Input Static Page Title" value="{{ $staticPage->title }}" title="Input Title" name="title">
                  <span class="alert-danger">{{ $errors->first('title') }}</span>
                </div>
                <div class="form-group {{ $errors->has('content') ? ' has-error' : '' }}">
                  <label for="content">{{ __('Content of Static Page') }}</label>
                  <textarea class="form-control ckeditor" id="content" placeholder="Input Static Page Content" title="Input Content" name="content">{{ $staticPage->content }}</textarea>
                  <span class="alert-danger">{{ $errors->first('content') }}</span>
                </div>
               
                      
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="{{ route('static-page.index') }}" id="cancel" name="cancel" class="btn btn-default">Back</a>
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