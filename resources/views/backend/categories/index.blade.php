@extends('backend.layouts.main')

@section('title', __('Category'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Categories News') }}
        <small>{{ __('Categories') }}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('Home Page') }}</a></li>
        <li class="active">{{ __('Categories') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title title-header">{{ __('List Categories') }}</h3>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
            <!-- messages -->
              @include('flash::message')
            <!-- end msg -->
              <div class="row">
              <!-- search -->
                <div class="col-md-6">
                <form  class="container-search">
                  <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{request('search')}}">
                  <button type="submit" class="btn btn-primary btn-search">
                  <i class="glyphicon glyphicon-search"></i>
                  </button>
                </form>
              </div>
                <!-- end search -->
                <div class="contain-btn pull-right">
                   <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <span class="fa fa-plus-circle" aria-hidden="true"></span>
                    {{ __('Add Cagegory') }}
                  </a> 
                </div>
              </div>
               @include('backend.layouts.partials.modal')
              <table id="table-contain" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th class="col-md-1">{{ __('ID') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th class="col-md-2">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($categories as $category)
                <tr>
                  <td>{{ $category->id }}</td>
                  <td>{{ $category->name }}
                  </td>
                  <td align="center">
                    <a href="{{ route('category.edit',$category->id) }}"><i class= "fa fa-pencil-square-o cus_icon"></i></a>
                     <form method="POST" action="{{ route('category.destroy', $category->id) }}" class="form-del inline" >
                       <input type="hidden" name="_token"  value="{!! csrf_token()!!}">
                      {{ method_field('DELETE') }}
                        <button type="submit" 
                              class="fa fa-trash-o cus_icon btn btn-delete-item fz-20"
                              data-title="{{ __('Confirm deletion!') }}"
                              data-confirm="{{ __('Are you sure you want to delete?') }}">
                        </button>
                    </form>
                  </td>
                </tr>
              @endforeach
               </tbody>
              </table>
                <div class="contain-btn second pull-right">
                  <a href="{{ route('category.create') }}" class="btn btn-primary">
                    <span class="fa fa-plus-circle" aria-hidden="true"></span>
                    {{ __('Add Category') }}
                  </a> 
                </div>
            {{ $categories->render() }}
            </div>
           <div class="cls-search-not-found" hidden="">
              <h1 class="text-center">{{__('Data Not Found!')}}</h1>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
