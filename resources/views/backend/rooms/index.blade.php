@extends('backend.layouts.main')

@section('title', __('Room'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('HOTEL NAME: ') }}<a href="{{ route('hotel.show', $hotel->id) }}">{{ $hotel->name }}</a>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('Home Page') }}</a></li>
        <li class="active">{{ __('Rooms') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title title-header">{{ __('List Rooms') }}</h3>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
            <!-- messages -->
              @include('flash::message')
            <!-- end msg -->
              <div class="row">
              <!-- search -->
                <div class="col-md-6 container-search ">
                  <form method="GET" action="{{ route('room.index', $hotel->id) }}" class="container-search">
                    <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{ app('request')->input('search') }}">
                    <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                </div>
                <!-- end search -->
                <div class="contain-btn pull-right">
                  <a href="{{ route('room.create', $hotel->id) }}" class="btn btn-primary" id="btn-add-room">
                    <span class="fa fa-plus-circle" aria-hidden="true"></span>
                    {{ __('Add Room') }}
                  </a> 
                </div>
              </div>
               @include('backend.layouts.partials.modal')
               <table id="table-contain" class="table table-bordered table-striped
                table-responsive table-hover">
                <thead>
                <tr>
                  <th class="col-md-1">{{ __('ID') }}</th>
                  <th class="text-center">{{ __('Image') }}</th>
                  <th class="text-center">{{ __('Name') }}</th>
                  <th class="text-center">{{ __('Price') }}</th>
                  <th class="text-center">{{ __('Total') }}</th>
                  <th class="text-center">{{ __('Max Gest') }}</th>
                  <th class="text-center">{{ __('Option') }}</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($rooms as $room)
                <tr>
                  <td>{{ $room->id }}</td>
                  <td class="text-center col-image">
                    <div class="place-image-show">
                      <img class="img-place" 
                        src="{{ isset($room->images[0])? asset($room->images[0]->path): asset(config('image.no_image')) }}" >
                    </div>
                  </td>
                  <td class="text-center">
                    <a href="{{ route('room.show', [$hotel->id, $room->id]) }}">
                      {{ $room->name }}
                    </a>
                  </td>
                  <td class="text-center">{{ $room->price }}</td>
                  <td class="text-center">{{ $room->total }}</td>
                  <td class="text-center">{{ $room->max_guest }}</td>
                  <td class="text-center col-action">
                    <div class="btn-option text-center">
                      <a href="{{ route('room.edit', [$hotel->id, $room->id]) }}" class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left">
                        <i class="" aria-hidden="true"></i>
                      </a>
                      <form  class="form-delete" method="post" action="{{ route('room.destroy', [$hotel->id, $room->id]) }}">
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
               <div class="cls-search-not-found text-center" hidden="">
                {{__('Data Not Found')}}
              </div>
              <div class="contain-btn second pull-right">
                <a href="{{ route('room.create', $hotel->id) }}" class="btn btn-primary">
                  <span class="fa fa-plus-circle" aria-hidden="true"></span>
                  {{ __('Add Room') }}
                </a> 
              </div>
            {{ $rooms->render() }}
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
