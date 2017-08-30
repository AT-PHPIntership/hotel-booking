@extends('backend.layouts.main')

@section('title', __('Service'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Management Service') }}
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>
            {{ __('Home page') }}
          </a>
        </li>
        <li class="active">{{ __('Service') }}</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title title-header">
                {{ __('List services') }}
              </h3>
              <div class="row">
                <div class="col-md-6 container-search ">
                  <form  class="container-search">
                    <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{request('search')}}">
                    <button type="submit" class="btn btn-primary btn-search">
                    <i class="glyphicon glyphicon-search"></i>
                    </button>
                </form>
                </div>
                <div class="contain-btn pull-right">
                  <a href="{{ route('service.create') }}" class="btn btn-primary">
                    <span class="fa fa-plus-circle" aria-hidden="true"></span>
                    {{ __('Add Service') }}
                  </a> 
                </div>
              </div>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              @include('backend.layouts.partials.modal')
              <table id="table-contain" class="table table-bordered table-striped
                table-responsive">
                <thead>
                  <tr>
                    <th class="text-center">{{ __('ID') }}</th>
                    <th class="text-center">{{ __('Name') }}</th>
                    <th class="text-center">{{ __('Option') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($services as $service)
                    <tr>
                      <td class="col-md-2 text-center">{{ $service->id }}</td>
                      <td class="col-md-8">{{ $service->name }}</td>
                      <td class="col-md-2 text-center col-action">
                        <div class="btn-option text-center">
                          <a href="{{ route('service.edit', $service->id) }}" class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left">
                            <i class="" aria-hidden="true"></i>
                          </a>
                          <form  class="form-delete" method="post" action="{{ route('service.destroy', $service->id) }}">
                            {!! csrf_field() !!}
                            {{ method_field('DELETE') }}
                            <button class=" btn-custom-option btn btn-delete-item fa fa-trash-o"
                              data-title="{{ __('Confirm deletion!') }}"
                              data-confirm="{{ __('Are you sure you want to delete?') }}" 
                              type="submit" >
                            </button>
                          </form> 
                        </div>
                      </td>
                    </tr>
                  @endforeach 
                </tbody> 
              </table>
              <div class="cls-search-not-found" hidden="">
                <h1 class="text-center">{{__('Data Not Found!')}}</h1>
              </div>
              <div class="contain-btn second pull-right">
                <a href="{{ route('service.create') }}" class="btn btn-primary">
                  <span class="fa fa-plus-circle" aria-hidden="true"></span>
                  {{ __('Add service') }}
                </a> 
              </div>
              {{ $services->links() }}
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
