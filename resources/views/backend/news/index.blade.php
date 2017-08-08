@extends('backend.layouts.main')
@section('title','Manager News')
@section('content')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>{{trans('admin_list_news.title')}}
        <small>{{trans('admin_list_news.news')}}</small>
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="#"><i class="fa fa-dashboard"></i>{{trans('admin_list_news.home')}}</a>
        </li>
        <li class="active">{{trans('admin_list_news.news')}}</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="title-news">
                <h3 class="box-title">{{trans('admin_list_news.list')}}</h3>
              </div>
              <div class="form-group search-news">
                <form method="POST" class="form-group" action="">
                  {{csrf_field()}}
                  <div class="search-select">
                    <select class="form-control" name="select">
                      <option disabled>
                      {{trans('admin_list_news.choose')}}:
                      </option>
                      <option name="title">{{trans('admin_list_news.tb_title')}}</option>
                      <option name="content">
                        {{trans('admin_list_news.tb_content')}}</option>
                      <option name="category_id">
                        {{trans('admin_list_news.tb_category_id')}}
                      </option>
                      <option name="category_name">
                        {{trans('admin_list_news.tb_category')}}
                      </option>
                    </select>
                  </div>
                  <div class="news-search-input"> 
                    <input type="text" name="search" class="form-control">
                  </div>
                  <div class="news-search-btn">
                    <button type="submit" class="btn btn-primary">
                      {{trans('admin_list_news.search')}}
                    </button>
                  </div>
                </form> 
              </div>
            </div>
            <div class="box-body cl">
              <div class="form-group has-error"> 
                @foreach (['successCreate', 'failCreate','deleteSuccess','deleteFail','successEdit','failEdit'] as $msg)
                  @if(Session::has($msg))
                  <span class="help-block">{{ Session::get($msg) }}</span>
                  @endif
                @endforeach
              </div>
              <table class="table table-bordered table-striped clearfix" id="NewsTable">
                <thead>
                <tr>
                  <th>{{trans('admin_list_news.id')}}</th>
                  <th>{{trans('admin_list_news.tb_title')}}</th>
                  <th>{{trans('admin_list_news.tb_content')}}</th>
                  <th>{{trans('admin_list_news.tb_category_id')}}</th>
                  <th>{{trans('admin_list_news.tb_category')}}</th>
                  <th>{{trans('admin_list_news.option')}}</th>
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
                      <a href="" class="btn btn-primary btn-xs news_btn">
                      {{trans('admin_list_news.edit')}}</a>
                      <form action="" method="POST">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <button type="submit" class="btn btn-danger btn-xs news_btn">
                          {{trans('admin_list_news.delete')}}
                        </button>
                      </form>
                      <a href="" class="btn btn-success btn-xs news_btn">
                      {{trans('admin_list_news.btn-image')}}
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
            <a href="/admin/news/create" class="btn btn-primary" id="btn-add-news">
              {{trans('admin_list_news.add')}}
            </a>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection