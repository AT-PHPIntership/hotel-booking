@extends('backend.layouts.main')

@section('title', __('Place'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Management Place') }}
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="/admin"><i class="fa fa-dashboard"></i>
            {{ __('Home page') }}
          </a>
        </li>
        <li class="active">{{ __('Place') }}</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <div class="title-place mb-10">
                <h3 class="box-title title-header">
                  {{ __('List places') }}
                </h3>
              </div>  
              <div class="row">
                <div class="col-md-6 container-search ">
                  <form class="container-search" method="GET" action="{{ route('place.index') }}">
                    <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{ app('request')->input('search') }}">
                    <button type="submit" id="btn-search" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                </div>
                <div class="contain-btn pull-right">
                  <a href="{{ route('place.create') }}" class="btn btn-primary">
                    <span class="fa fa-plus-circle" aria-hidden="true"></span>
                    {{ __('Add Place') }}
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
                    <th class="text-center col-md-1">{{ __('ID') }}</th>
                    <th class="text-center col-md-2">{{ __('Image') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th class="text-center col-md-2">{{ __('Option') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($places as $place)
                    <tr>
                      <td class="col-no text-center">{{ $place->id }}</td>
                      <td class="text-center col-image">
                        <div class="place-image-show">
                          <a class="url-place" href="{{ route('place.show', $place->id) }}">
                            <img class="img-place" src="{{ $place->image_url }}" >
                          </a>  
                        </div>
                      </td>
                      <td class="col-name">
                        <a class="url-place" href="{{ route('place.show', $place->id) }}">
                          {{ $place->name }}
                        </a>
                      </td>
                      <td class="text-center col-action">
                        <div class="btn-option text-center">
                          <a href="{{ route('place.edit', $place->id) }}" class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left">
                            <i class="" aria-hidden="true"></i>
                          </a>
                          <form  class="form-delete" method="post" action="{{ route('place.destroy', $place->id) }}">
                            {!! csrf_field() !!}
                            {{ method_field('DELETE') }}
                            <button class="btn-custom-option btn btn-delete-item fa fa-trash-o"
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
              <div class="cls-search-not-found text-center" hidden="">
                {{__('Data Not Found')}}
              </div>
              <div class="contain-btn second pull-right">
                <a href="{{ route('place.create') }}" class="btn btn-primary">
                  <span class="fa fa-plus-circle" aria-hidden="true"></span>
                  {{ __('Add Place') }}
                </a> 
              </div>
              {{ $places->links() }}
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
