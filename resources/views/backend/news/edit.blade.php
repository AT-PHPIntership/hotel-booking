@extends('backend.layouts.main')
@section('title','Edit News')
@section('content')
  <div class="content-wrapper">
    <h1 class="title-page text-success">
      {{__('EDIT NEWS')}}
    </h1>
    <section class="content">
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="cls-editnews-msg">
            @include('flash::message')
          </div>
          <div class="box box-primary">
            <form method="POST" action="{{ route('news.update',$news->id) }}" >
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
                  <textarea class="form-control" name="content">{{$news->content}}</textarea>
                  @if($errors->first('content'))
                      <span class="help-block">{{$errors->first('content')}}</span>
                  @endif
                </div>
                <div class="form-group">
                  <label>{{__('Category')}}</label>
                  <input type="text" class="form-control" readonly="true" value="{{$news->category->name}}">
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