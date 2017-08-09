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
              <table id="table-contain" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>{{ __('Image') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Descript') }}</th>
                    <th>{{ __('Action') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @php ($index = 1)
                  @foreach ($places as $place)
                    <tr>
                      <td>{{$index++}}</td>
                      <td><img src=" {{ asset('/images/places/'.$place->image) }}" >
                      </td>
                      <td>{{$place->name}}</td>
                      <td>{{$place->descript}}</td>
                      <td align="center">
                        <a href="{{ route('place.edit', $place->id) }}">
                          <i class="fa fa-pencil-square-o btn-pencil" aria-hidden="true"></i></a>
                        <form method="post" action="{{ route('place.destroy', $place->id )}}">
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
              {{ $places->links()}}
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
