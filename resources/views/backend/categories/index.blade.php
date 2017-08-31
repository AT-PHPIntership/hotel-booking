@extends('backend.layouts.main')

@section('title', __('Category'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Management Categories News') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>{{ __('Home Page') }}</a></li>
        <li class="active">{{ __('Categories') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="title-category mb-10">
                <h3 class="box-title title-header">{{ __('List Categories') }}</h3>
              </div>  
              <div class="row">
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
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              @include('backend.layouts.partials.modal')
              <table id="table-contain" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th class="col-md-1">{{ __('ID') }}</th>
                  <th>{{ __('Name') }}</th>
                  <th class="col-md-2 text-center">{{ __('Option') }}</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($categories as $category)
                    <tr>
                      <td>{{ $category->id }}</td>
                      <td>{{ $category->name }}</td>
                      <td align="center">
                        <div class="btn-option text-center">
                          <a href="{{ route('category.edit',$category->id) }}" 
                            class= "btn-edit fa fa-pencil-square-o btn-custom-option pull-left"></a>
                          <form method="POST" action="{{ route('category.destroy', $category->id) }}"
                            class="form-del inline" >
                            {{ method_field('DELETE') }}
                            <input type="hidden" name="_token"  value="{!! csrf_token()!!}">
                            <button type="submit" 
                              class="btn-custom-option btn btn-delete-item fa fa-trash-o"
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
              <div class="cls-search-not-found text-center" hidden="">
                {{__('Data Not Found')}}
              </div>
              <div class="contain-btn second pull-right">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                  <span class="fa fa-plus-circle" aria-hidden="true"></span>
                  {{ __('Add Category') }}
                </a> 
              </div>
              {{ $categories->render() }}
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
