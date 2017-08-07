@extends('backend.layouts.main')

@section('title','Place')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ trans('admin_place.place_management') }}
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="/admin"><i class="fa fa-dashboard"></i>
            {{ trans('admin_place.home_page') }}
          </a>
        </li>
        <li class="active">{{ trans('admin_place.place') }}</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title title-header">
                {{ trans('admin_place.list_place') }}
              </h3>
              <div class="contain-btn">
                <a href="{{ route('place.create') }}" class="btn btn-primary">
                <span class=" fa fa-plus-circle" aria-hidden="true">
                  </span>{{ trans('admin_place.add_place') }}
                
                </a> 
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="list-table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>{{ trans('admin_place.ordinal_number') }}</th>
                    <th>{{ trans('admin_place.image') }}</th>
                    <th>{{ trans('admin_place.name') }}</th>
                    <th>{{ trans('admin_place.descript') }}</th>
                    <th>{{ trans('admin_place.action') }}</th>
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
                          <button class=" btn-remove fa fa-trash-o" 
                            onclick="return confirm('Confirm deletion!');"
                            type="submit" class="btn">
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
