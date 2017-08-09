@extends('backend.layouts.main')
@section('title','Creates News')
@section('content')
  <div class="content-wrapper">
    <h1 class="title_page">{{__('ADD NEWS')}}</h1>
    <section class="content">
      <div class="row margin_center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('Enter information')}}</h3>
            </div>
            <form role="form" method="POST" action="{{ route('news.store') }}" >
              {{csrf_field()}}
              <div class="box-body">
                <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                  <label >{{__('Title')}}</label>
                  <input type="text" class="form-control" name="title">
                  @if($errors->first('title'))
                    <span class="help-block">{{$errors->first('title')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('content') ? ' has-error' : '' }}>
                  <label>{{__('Content')}}</label>
                  <textarea class="form-control" name="content"></textarea>
                  @if($errors->first('content'))
                    <span class="help-block">{{$errors->first('content')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('category_id') ? ' has-error' : '' }}>
                  <label>{{__('Category_id')}}</label>
                  <input type="text" class="form-control" name="category_id">
                  @if($errors->first('category_id'))
                   <span class="help-block">{{$errors->first('category_id')}}</span>
                  @endif
                </div>
              </div>
              <div class="box-footer btn-add-news">
                <button type="reset" class="btn btn-primary">
                  {{__('Reset')}}
                </button>
                <button type="submit" class="btn btn-primary">
                  {{__('Submit')}}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection