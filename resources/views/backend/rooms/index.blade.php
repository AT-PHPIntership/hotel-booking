@extends('backend.layouts.main')

@section('title', __('Room'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Rooms') }}
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
                  <form method="GET" action="{{ route('room.index') }}" class="form-search">
                    <input class="input-search form-control" placeholder="Search" name="keyword" type="text" value="{{ app('request')->input('keyword') }}">
                    <button type="submit" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                </div>
                <!-- end search -->
                <div class="contain-btn pull-right">
                  <a href="{{ route('room.create') }}" class="btn btn-primary">
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
                  <th>{{ __('Name') }}</th>
                  <th>{{ __('Hotel') }}</th>
                  <th>{{ __('Descript') }}</th>
                  <th>{{ __('Price') }}</th>
                  <th>{{ __('Size') }}</th>
                  <th>{{ __('Total') }}</th>
                  <th>{{ __('Bed') }}</th>
                  <th>{{ __('Direction') }}</th>
                  <th>{{ __('Max_Gest') }}</th>
                  <th >{{ __('Action') }}</th>
                </tr>
                </thead>
                <tbody>
            @foreach ($rooms as $room)
                <tr>
                  <td>{{ $room->id }}</td>
                  <td class="text-center col-image">
                    <div class="place-image-show">
                      <img class="img-place" src="{{ $room->image->path }}" >
                    </div>
                  </td>
                  <td>{{ $room->name }}</td>
                  <td>{{ $room->hotel->name }}</td>
                  <td>{{ $room->descript }}</td>
                  <td>{{ $room->price }}</td>
                  <td>{{ $room->size }}</td>
                  <td>{{ $room->total }}</td>
                  <td>{{ $room->max_guest }}</td>
                  <td class="text-center col-action">
                        <div class="btn-option text-center">
                          <a href="{{ route('room.edit', $room->id) }}" class="btn-edit fa fa-pencil-square-o btn-custom-option pull-left">
                            <i class="" aria-hidden="true"></i>
                          </a>
                          <form  class="form-delete" method="post" action="{{ route('room.destroy', $room->id) }}">
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
                <div class="contain-btn second pull-right">
                  <a href="{{ route('room.create') }}" class="btn btn-primary">
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
