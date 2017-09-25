@extends('backend.layouts.main')
@section('title','Creates News')
@section('content')
  <div class="content-wrapper">
    <div class="cls-news-error-message">
      @include('flash::message')
    </div>
    <section class="content">
    <h1 class="title-page text-success">{{__('ADD NEWS')}}</h1>
      <div class="row  margin-center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{__('Enter information')}}</h3>
            </div>
            <form role="form" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                  <label >{{__('Title')}}</label>
                  <input type="text" class="form-control" name="title" value="{{old('title')}}">
                  @if($errors->first('title'))
                    <span class="help-block">{{$errors->first('title')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('content') ? ' has-error' : '' }}>
                  <label>{{__('Content')}}</label>
                  <textarea class="ckeditor form-control" name="content"></textarea>
                  @if($errors->first('content'))
                    <span class="help-block">{{$errors->first('content')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('category_id') ? ' has-error' : '' }}>
                  <label>{{__('Choose category')}}</label>
                  <select name = "category_id" class="form-control">
                    <option></option>
                    @foreach($categories as $category)
                      <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                  </select>
                  @if($errors->first('category_id'))
                    <span class="help-block">{{$errors->first('category_id')}}</span>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('images.*') || $errors->has('images') ? ' has-error' : '' }}"> 
                  <label for="input-file">{{ __("Images") }}</label>
                  <input type="file" class="form-control" name="images[]" id="multiple-image" multiple>
                  <small class=" text-danger">{{ $errors->first('images.*') . $errors->first('images') }}</small>
                  <div id="showImage" class="mt-20">
                    <img class="img-place" id="default-image" src="{{ asset(config('image.default_thumbnail')) }}">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="add-news-button">
                  <a href="{{ route('news.index') }}" class="btn btn-default">
                    {{__('Back')}} 
                  </a>
                  <button type="reset" class="btn btn-warning">
                    {{__('Reset')}}
                  </button>
                </div>
                <div class="add-news-submit">
                  <button type="submit" class="btn btn-primary">
                  {{__('Submit')}}
                  </button>
                </div>
              </div>
            </form>
          </div>    
        </div>
      </div>
    </section>
  </div>  
@endsection
