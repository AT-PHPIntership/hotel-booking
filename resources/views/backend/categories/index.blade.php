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
              <h3 class="box-title">{{ __('List Categories') }}</h3>
              <div class="contain-btn">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                  <span class="fa fa-plus-circle" aria-hidden="true"></span>
                  {{ __('Add Category') }}
                </a> 
            </div>
            </div>
            <div>
            @include('flash::message')
            </div>
            <!-- add button -->
            
            <!-- end button -->
          <!-- search -->
          <!-- end search -->
           
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-contain" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>{{ __('ID') }}</th>
                  <th class="col-md-10">{{ __('Name') }}</th>
                  <th class="col-md-2">{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($categories as $objCat)
                <tr>
                  <td>{{ $objCat->id }}</td>
                  <td>{{ $objCat->name }}
                  </td>
                  <td align="center">
                    <a href="{{ route('category.edit',$objCat->id) }}"><i class= "fa fa-pencil-square-o cus_icon"></i></a>
                     <form method="POST" action="{{ route('category.destroy', $objCat->id) }}" class="form-del inline" >
                       <input type="hidden" name="_token"  value="{!! csrf_token()!!}">
                      {{ method_field('DELETE') }}
                        <button type="submit" name="" class="fa fa-trash-o cus_icon btn btn-delete-item"></button>
                    </form>
                  </td>
                </tr>
              @endforeach
               </tbody>
              </table>
              {{ $categories->render() }}
             <div class="box-header">
              <div class="contain-btn">
                <a href="{{ route('category.create') }}" class="btn btn-primary">
                  <span class="fa fa-plus-circle" aria-hidden="true"></span>
                  {{ __('Add Category') }}
                </a> 
            </div>
            </div>
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
