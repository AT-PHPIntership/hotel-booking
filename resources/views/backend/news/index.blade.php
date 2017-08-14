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
              <div class="btn-addnews">
                <a href="{{ route('news.create') }}" class="btn btn-primary">
                  <i class="fa fa-plus-circle"></i>
                  {{__('Add News')}}
                </a>
              </div>
            </div>
            <div class="box-body cl">
              @include('flash::message')
              <table class="table table-bordered table-striped clearfix" id="newstable">
                <thead>
                <tr>
                  <th class="col-news-id">{{__('Id')}}</th>
                  <th class="col-news-title">{{__('Title')}}</th>
                  <th class="col-news-content">{{__('Content')}}</th>
                  <th class="col-news-categoryid">{{__('Category_id')}}</th>
                  <th class="col-news-category">{{__('Category')}}</th>
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
                      <div class="news-option">
                        <a href="" class="btn fa fa-pencil-square-o news-btn" data-original-title="Edit" data-toggle="tooltip">
                        </a>
                        <form action="{{ route('news.destroy',$item->id) }}" method="POST">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                        <button type="submit" class="news-btn glyphicon glyphicon-trash btn-delete-item" 
                         data-original-title="Delete" data-toggle="tooltip">
                        </button>
                        </form>
                        <a href="" class="btn fa fa-upload news-btn" data-original-title="Upload Image" data-toggle="tooltip" >
                        </a>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              {!! $news->render() !!}
            </div>
          </div>
          <div class="btn-addnews">
            <a href="{{ route('news.create') }}" class="btn btn-primary">
              <i class="fa fa-plus-circle"></i>
              {{__('Add News')}}
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection