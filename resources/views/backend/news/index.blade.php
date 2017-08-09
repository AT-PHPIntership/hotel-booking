@extends('backend.layouts.main')
@section('title','Manager News')
@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>{{__('List News of Hotel')}}
        <small>{{__('News')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="#"><i class="fa fa-dashboard"></i>{{__('Home')}}</a>
        </li>
        <li class="active">{{__('News')}}</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="title-news">
                <h3 class="box-title">{{__('List News')}}</h3>
              </div>
              <div class="form-group search-news">
                <form method="POST" class="form-group" action="">
                  {{csrf_field()}}
                  <div class="search-select">
                    <select class="form-control" name="select">
                      <option disabled>
                      {{_('Choose')}}:
                      </option>
                      <option name="title">{{__('Title')}}</option>
                      <option name="content">
                        {{__('Content')}}</option>
                      <option name="category_id">
                        {{__('Category_id')}}
                      </option>
                      <option name="category_name">
                        {{__('Category')}}
                      </option>
                    </select>
                  </div>
                  <div class="news-search-input"> 
                    <input type="text" name="search" class="form-control">
                  </div>
                  <div class="news-search-btn">
                    <button type="submit" class="btn btn-primary">
                      {{__('Search')}}
                    </button>
                  </div>
                </form> 
              </div>
            </div>
            <div class="box-body cl">
              @include('flash::message')
              <table class="table table-bordered table-striped clearfix" id="NewsTable">
                <thead>
                <tr>
                  <th>{{__('Id')}}</th>
                  <th>{{__('Title')}}</th>
                  <th>{{__('Content')}}</th>
                  <th>{{__('Category_id')}}</th>
                  <th>{{__('Category')}}</th>
                  <th>{{__('Option')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($news as $item)
                  <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->content}}</td>
                    <td>{{$item->category_id}}</td>
                    <td>{{$item->category->name}}</td>
                    <td align="center">
                      <a href="{{ route('news.edit',$item->slug) }}" class="btn btn-primary btn-xs news_btn" id="btn-edit-news">
                        {{__('Edit')}}
                      </a>
                      <form action="" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger btn-xs news_btn">
                          {{__('Delete')}}
                        </button>
                      </form>
                      <a href="" class="btn btn-success btn-xs news_btn">
                      {{__('Upload Image')}}
                      </a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $news->render() !!}
            </div>
          </div>
          <div class="btn-AddNews">
            <a href="/admin/news/create" class="btn btn-primary">
              {{__('Add News')}}
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection