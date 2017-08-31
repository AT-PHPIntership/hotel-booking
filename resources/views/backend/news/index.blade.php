@extends('backend.layouts.main')
@section('title','Manager News')
@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <h1>{{__('Management News')}}
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
              <div class="title-news mb-10">
                <h3 class="box-title title-header">{{__('List News ')}}</h3>
              </div>
              <div class="col-md-6">
                <form  class="container-search cls-search">
                  <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{request('search')}}">
                  <button type="submit" class="btn btn-primary btn-search">
                  <i class="glyphicon glyphicon-search"></i>
                  </button>
                </form>
              </div>
              <div >
                <a href="{{ route('news.create') }}" class="btn btn-primary pull-right">
                  <i class="fa fa-plus-circle"></i>
                  {{__('Add News')}}
                </a>
              </div>
            </div>
            <div class="box-body">
              @include('flash::message')
              @include('backend.layouts.partials.modal')
              <table class="table table-bordered table-responsive table-striped" id="newstable">
                <thead>
                <tr>
                  <th>{{__('Id')}}</th>
                  <th>{{__('Title')}}</th>
                  <th>{{__('Category')}}</th>
                  <th class=" col-md-1 text-center">{{__('Option')}}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($news as $item)
                  <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->name}}</td>
                    <td class="text-center">
                      <div class="btn-option text-center">
                        <a href="{{ route('news.edit',$item->slug) }}" class="btn fa fa-pencil-square-o news-btn pull-left btn-custom-option" data-original-title="Edit" data-toggle="tooltip">
                        </a>
                        <form action="{{ route('news.destroy',$item->id) }}" 
                          method="POST" class="inline">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                          <button type="submit" class="news-btn fa fa-trash-o 
                            btn-delete-item pull-left btn-custom-option"  
                            data-original-title="Delete" data-toggle="tooltip"
                            data-title="{{ __('Confirm deletion!') }}"
                            data-confirm="{{ __('Are you sure you want to delete?') }}">
                          </button>
                        </form>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              <div class="cls-searchnews-not-found text-center" hidden="">
                {{__('Data Not Found')}}
              </div>
              <div class="contain-btn second pull-right">
                <a href="{{ route('news.create') }}" class="btn btn-primary">
                  <span class="fa fa-plus-circle" aria-hidden="true"></span>
                  {{__('Add News')}}
                </a> 
              </div>
              {{$news->render()}}
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection
