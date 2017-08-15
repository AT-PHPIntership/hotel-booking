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
                <h3 class="box-title">{{__('Search News')}}</h3>
              </div>
              <div class="form-group search-news">
                <form method="POST" class="form-group" action="">
                  {{csrf_field()}}
                  <div class="news-search-input"> 
                    <input type="text" name="search" class="form-control pull-left">
                  </div>
                  <div class="news-search-btn">
                    <button type="submit" class="btn btn-primary" data-original-title="Search" data-toggle="tooltip">
                      <i class="fa fa-search"></i>
                    </button>
                  </div>
                </form> 
              </div>
              <div class="">
                <a href="{{ route('news.create') }}" class="btn btn-primary pull-right">
                  <i class="fa fa-plus-circle"></i>
                  {{__('Add News')}}
                </a>
              </div>
            </div>
            <div class="box-body">
              @include('flash::message')
              <table class="table table-bordered table-responsive" id="newstable">
                <thead>
                <tr>
                  <th>{{__('Id')}}</th>
                  <th>{{__('Title')}}</th>
                  <th>{{__('Content')}}</th>
                  <th>{{__('Category_id')}}</th>
                  <th>{{__('Category')}}</th>
                  <th class="text-center">{{__('Option')}}</th>
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
                        <a href="" class="btn fa fa-pencil-square-o news-btn pull-left" data-original-title="Edit" data-toggle="tooltip">
                        </a>
                        <form action="" method="POST" >
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <button type="submit" class="news-btn fa fa-trash-o btn-delete-item pull-left"  
                           data-original-title="Delete" data-toggle="tooltip">
                          </button>
                        </form>
                        <a href="" class="btn fa fa-upload news-btn pull-left" data-original-title="Upload Image" data-toggle="tooltip" >
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
          <div>
            <a href="{{ route('news.create') }}" class="btn btn-primary pull-right">
              <i class="fa fa-plus-circle"></i>
              {{__('Add News')}}
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection