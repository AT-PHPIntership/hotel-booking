@extends('backend.layouts.main')

@section('title', __('Add place'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="text-center text-success">
        {{ __("Add place") }}
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
            <form action="{!! route('place.store') !!}" enctype="multipart/form-data"
              method="POST">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group has-feedback
                  {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control" name= "name" id="name"
                    placeholder="{{ __('Enter place name') }}" value="{{ old('name') }}">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>

                <div class="form-group has-feedback
                  {{ $errors->has('descript') ? ' has-error' : '' }}">
                  <label for="descript">{{ __('Description') }}</label>
                  <textarea class="form-control ckeditor" name= "descript" 
                    id="descript" placeholder="{{ __('Enter descript') }}"
                    value="{{ old('descript') }}" ></textarea> 
                  <small class="text-danger">{{ $errors->first('descript') }}</small>
                </div>

               
                <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}"> 
                  <label for="input-file">{{ __("Image") }}</label>
                  <input type="file" class="form-control" name="image" id="preview-image">
                  <small class=" text-danger">{{ $errors->first('image') }}</small>
                  <div class="mt-10">
                    <img class="img-place" id="showImage" src="{{ asset('/images/default/no_image.png') }}">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-default btn-custom" href="javascript:history.back()">
                  {{ __('Back') }}
                </a>
                <button type="reset" class="btn btn-warning btn-custom">
                  {{ __('Reset') }}
                </button>
                <button type="submit" class="btn btn-primary btn-custom pull-right">
                  {{ __('Submit') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>   
    </section> 
  </div>   
@endsection
