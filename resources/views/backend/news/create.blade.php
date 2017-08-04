@extends('backend.layouts.main')
@section('title','Creates News')
@section('content')
  <div class="content-wrapper">
    <h1 class="title_page">ADD NEWS</h1>
    <!-- Main content -->
    <section class="content">
      <div class="row margin_center">
        <!-- left column -->
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Enter infomation</h3>
            </div>
            <form role="form" method="POST" action="{{ route('news.store') }}" >
              {{csrf_field()}}
              {{method_field('POST')}}
              <div class="box-body">
                <div class="form-group" {{ $errors->has('title') ? ' has-error' : '' }}>
                  <label >Title</label>
                  <input type="text" class="form-control" name="title" placeholder="Enter title news">
                  @if($errors->first('title'))
                    <span class="help-block">{{$errors->first('title')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('content') ? ' has-error' : '' }}>
                  <label>Content</label>
                  <textarea class="form-control" name="content" placeholder="Enter content news">
                  </textarea>
                  @if($errors->first('content'))
                    <span class="help-block">{{$errors->first('content')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('slug') ? ' has-error' : '' }}>
                  <label>Slug</label>
                  <input type="text" class="form-control" name="slug" placeholder="Enter news-slug">
                  @if($errors->first('slug'))
                   <span class="help-block">{{$errors->first('slug')}}</span>
                  @endif
                </div>
                <div class="form-group" {{ $errors->has('category_id') ? ' has-error' : '' }}>
                  <label>Category_id</label>
                  <input type="text" class="form-control" name="category_id" placeholder="Enter news-category-id">
                  @if($errors->first('category_id'))
                   <span class="help-block">{{$errors->first('category_id')}}</span>
                  @endif
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer btn-add-news">
                <button type="reset" class="btn btn-primary">Reset</button>
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection