@extends('backend.layouts.main')
@section('title','Edit News')
@section('content')
  <div class="content-wrapper">
    <section class="content">
      <h1 class="title-page text-success">
        {{__('EDIT NEWS')}}
      </h1>
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="cls-editnews-msg">
            @include('flash::message')
          </div>
          <div class="box box-primary">
            <form method="POST" action="{{ route('news.update',$news->id) }}" enctype="multipart/form-data">
              {{csrf_field()}}
              {{method_field('PUT')}}
              <div class="box-body">
                <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                  <label>{{__('Title')}}</label>
                  <input type="text" class="form-control" name="title"
                  value="{{$news->title}}">
                  @if($errors->first('title'))
                      <span class="help-block">{{$errors->first('title')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('content') ? ' has-error' : '' }}>
                  <label>{{__('Content')}}</label>
                  <textarea class="ckeditor form-control" name="content">{{$news->content}}</textarea>
                  @if($errors->first('content'))
                      <span class="help-block">{{$errors->first('content')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>{{__('Category')}}</label>
                  <input type="text" class="form-control" readonly="true" value="{{$news->category->name}}">
                </div>
                {{-- old images --}}
                @include('backend.layouts.partials.modal')
                <div class="form-group">
                  <label for="old-images">{{ __('Old Images') }}</label>
                  <div
                    id="old-images"
                    class="col-md-12"
                    data-token="{{ csrf_token() }}"
                    data-title="{{ __('Confirm deletion!') }}"
                    data-confirm="{{ __('Are you sure you want to delete?') }}">
                    @if (isset($news->images[0]))
                      @foreach ($news->images as $img)
                        <div id="old-img-{{ $img->id }}" class="col-md-3 text-center img-contain">
                          <button
                            data-url="{{ route('image.destroy', $img->id) }}"
                            class="btn-remove-img btn-link fa fa-times fz-20">
                          </button>
                          <img class="img-place" src="{{ asset($img->path) }}">
                        </div>
                      @endforeach
                    @else
                      <div id="old-images" class="text-info">{{ __('No old image') }}</div>
                    @endif
                  </div>
                </div>
                <div class="form-group {{ $errors->has('images') || $errors->has('images.*') ? ' has-error' : '' }}"> 
                  <label for="input-file">{{ __("Images") }}</label>
                  <input type="file" class="form-control" name="images[]" id="multiple-image" multiple>
                  <small class=" text-danger">{{ $errors->first('images.*') . $errors->first('images') }}</small>
                  <div id="showImage" class="mt-20 ml-2per">
                    <img class="img-place pd-0" id="default-image" src="{{ asset(config('image.no_image')) }}">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <div class="btn-edit-news">
                  <a href="{{ route('news.index') }}" class="btn btn-default">
                    {{__('Back')}}
                  </a>                
                  <button type="reset" class="btn btn-warning">
                    {{__('Reset')}}
                  </button> 
                </div>
                <div class="edit-news-submit">
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