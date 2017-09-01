@extends('backend.layouts.main')

@section('title', __('Update Place'))

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <h1 class="title-page text-success">
        {{ __('Update place') }}
      </h1>
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter information') }}</h3>
              @include('flash::message')
            </div>
            <form role="form" method="POST" enctype="multipart/form-data"
              action="{{ route('place.update', $place->id) }}">
              {!! csrf_field() !!}
              {{ method_field('PUT') }}
              <div class="box-body">
                <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control" name= "name" id="name" 
                    value="{{ old('name', $place->name) }}">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>

                <div class="form-group has-feedback 
                  {{ $errors->has('descript') ? ' has-error' : '' }}">
                  <label for="descript">{{ __('Description') }}</label>
                  <textarea class="ckeditor form-control place-descript" name= "descript" 
                    id="place-descript">{{ old('descript', $place->descript) }}</textarea>
                  <small class="text-danger">{{ $errors->first('descript') }}</small>
                </div>

                <div class="form-group"> 
                  <label for="input-file">{{ __("Image") }}</label>
                  <div >
                    <img class="img-place" id="showImage" src="{{ $place->image_url }}" >
                  </div>
                  <input type="file" class="form-control" name="image" id="preview-image">
                  <small class=" text-danger">{{ $errors->first('image') }}</small>
                </div>
              </div>
              
              <div class="box-footer">
                <a class="btn btn-default btn-custom" id="btn-go-back" 
                  href="javascript:history.back()">
                  {{ __('Back') }}
                </a>
                <button type="reset" id="btn-reset" class="btn btn-warning btn-custom">
                  {{ __('Reset') }}
                </button>
                <button type="submit" id="btn-submit" class="btn btn-primary 
                  btn-custom btn-submit pull-right">
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
