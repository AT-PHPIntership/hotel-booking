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
              <h3 class="box-title title-header">
                {{ __('List place') }}
              </h3>
              <div class="contain-btn">
                <a href="{{ route('place.create') }}" class="btn btn-primary">
                <span class=" fa fa-plus-circle" aria-hidden="true">
                  </span>{{ __('Add Place') }}
                
                </a> 
              </div>
            </div>
            @include('flash::message')
            <!-- /.box-header -->
            <div class="box-body">
              <table id="table-contain" class="table table-bordered table-striped table-place">
                <thead>
                  <tr>
                    <th class="text-center col-no">{{ __('No.') }}</th>
                    <th class="text-center col-image">{{ __('Image') }}</th>
                    <th class="text-center col-name">{{ __('Name') }}</th>
                    <th class="text-center col-descript">{{ __('Descript') }}</th>
                    <th class="text-center col-action">{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($index = 1)
                  @foreach ($places as $place)
                    <tr>
                      <td class="col-no">{{ $index++ }}</td>
                      <td class="text-center col-image">
                        <div class="place-image-show">
                          <img class="img-place" src="{{ asset($place->image) }}" >
                        </div>
                      </td>
                      <td class="col-name">{{ $place->name }}</td>
                      <td class="col-descript">{{ $place->descript }}</td>
                      <td class="text-center col-action">
                        <a href="{{ route('place.edit', $place->id) }}">
                          <i class="fa fa-pencil-square-o btn-pencil" aria-hidden="true"></i></a>
                        <form method="post" action="{{ route('place.destroy', $place->id) }}">
                          {!! csrf_field() !!}
                          {{ method_field('DELETE') }}
                          <input type="hidden" name="id" value="{{ $place->id }}">
                          <button class=" btn btn-delete-item fa fa-trash-o" 
                            type="submit" >
                          </button>
                        </form> 
                      </td>
                    </tr>
                  @endforeach 
                </tbody> 
              </table>
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
