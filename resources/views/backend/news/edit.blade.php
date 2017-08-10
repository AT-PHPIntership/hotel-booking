@extends('backend.layouts.main')
@section('title','Edit News')
@section('content')
  <div class="content-wrapper">
    <h1 class="title-page text-success">
      {{__('EDIT NEWS')}}
    </h1>
  <!-- Main content -->
    <section class="content">
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="box box-primary">
            @foreach($news as $new)
            <form method="POST" action="{{ route('news.update',$new->id) }}" >
              {{csrf_field()}}
              {{method_field('PUT')}}
              <div class="box-body">
                  <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                      <label>{{__('Title')}}</label>
                      <input type="text" class="form-control" name="title"
                      value="{{$new->title}}">
                      @if($errors->first('title'))
                          <span class="help-block">{{$errors->first('title')}}</span>
                      @endif
                  </div>
                  <div class="form-group" {{ $errors->has('content') ? ' has-error' : '' }}>
                      <label>{{__('Content')}}</label>
                      <input type="text" class="form-control" name="content"
                      value="{{$new->content}}">
                      @if($errors->first('content'))
                          <span class="help-block">{{$errors->first('content')}}</span>
                      @endif
                  </div>
                  <div class="form-group">
                      <label>{{__('Category_id')}}</label>
                      <input type="text" class="form-control" name="category_id" readonly="true" value="{{$new->category_id}}">
                  </div>
              </div>
              <div class="box-footer edit-news">
                  <button type="submit" class="btn btn-primary">
                    {{__('Submit')}} 
                  </button>
                  <a href="{{ route('news.index') }}" class="btn btn-danger">
                  {{__('Cancer')}}
                  </a>
              </div>
            </form>
            @endforeach
          </div>
        </div>
    </div>
  </section>
</div>      
@endsection