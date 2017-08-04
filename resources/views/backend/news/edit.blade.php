@extends('backend.layouts.main')
@section('title','Edit News')
@section('content')
  <div class="content-wrapper">
    <h1 class="title_page text-success">
      {{trans('admin_list_news.edit_news')}}
    </h1>
  <!-- Main content -->
    <section class="content">
      <div class="row margin_center">
        <div class="col-md-12">
          <div class="box box-primary">
            <form method="POST" action="{{ route('news.update',$news->id) }}" >
              {{csrf_field()}}
              {{method_field('PUT')}}
              <div class="box-body">
                  <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                      <label>{{trans('admin_list_news.add_title')}}</label>
                      <input type="text" class="form-control" name="title"
                      value="{{$news->title}}">
                      @if($errors->first('title'))
                          <span class="help-block">{{$errors->first('title')}}</span>
                      @endif
                  </div>
                  <div class="form-group" {{ $errors->has('content') ? ' has-error' : '' }}>
                      <label>{{trans('admin_list_news.add_content')}}</label>
                      <input type="text" class="form-control" name="content"
                      value="{{$news->content}}">
                      @if($errors->first('content'))
                          <span class="help-block">{{$errors->first('content')}}</span>
                      @endif
                  </div>
                  <div class="form-group">
                    <label>{{trans('admin_list_news.add_slug')}}</label>
                    <input type="text" class="form-control" name="slug" readonly="true" value="{{$news->slug}}">
                  </div>
                  <div class="form-group">
                      <label>{{trans('admin_list_news.add_category_id')}}</label>
                      <input type="text" class="form-control" name="category_id" readonly="true" value="{{$news->category_id}}">
                  </div>
              </div>
              <div class="box-footer edit_news">
                  <button type="submit" class="btn btn-primary">
                    {{trans('admin_list_news.add_btn_sb')}} 
                  </button>
                  <a href="{{ route('news.index') }}" class="btn btn-danger">
                  {{trans('admin_list_news.add_btn_cancer')}}
                  </a>
              </div>
            </form>
          </div>
        </div>
    </div>
  </section>
</div>      
@endsection