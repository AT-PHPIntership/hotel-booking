@extends('backend.layouts.main')
@section('title','Creates News')
@section('content')
  <div class="content-wrapper">
    <h1 class="title_page">{{trans('admin_list_news.add_news')}}</h1>
    <section class="content">
      <div class="row margin_center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{trans('admin_list_news.add_info')}}</h3>
            </div>
            <form role="form" method="POST" action="{{ route('news.store') }}" >
              {{csrf_field()}}
              {{method_field('POST')}}
              <div class="box-body">
                <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                  <label >{{trans('admin_list_news.add_title')}}</label>
                  <input type="text" class="form-control" name="title">
                  @if($errors->first('title'))
                    <span class="help-block">{{$errors->first('title')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('content') ? ' has-error' : '' }}>
                  <label>{{trans('admin_list_news.add_content')}}</label>
                  <textarea class="form-control" name="content">
                  </textarea>
                  @if($errors->first('content'))
                    <span class="help-block">{{$errors->first('content')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('slug') ? ' has-error' : '' }}>
                  <label>{{trans('admin_list_news.add_slug')}}</label>
                  <input type="text" class="form-control" name="slug">
                  @if($errors->first('slug'))
                   <span class="help-block">{{$errors->first('slug')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('category_id') ? ' has-error' : '' }}>
                  <label>{{trans('admin_list_news.add_category_id')}}</label>
                  <input type="text" class="form-control" name="category_id">
                  @if($errors->first('category_id'))
                   <span class="help-block">{{$errors->first('category_id')}}</span>
                  @endif
                </div>
              </div>
              <div class="box-footer btn-add-news">
                <button type="reset" class="btn btn-primary">
                  {{trans('admin_list_news.add_btn_rs')}}
                </button>
                <button type="submit" class="btn btn-primary">
                  {{trans('admin_list_news.add_btn_sb')}}
                </button>
              </div>
            </form>i
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection