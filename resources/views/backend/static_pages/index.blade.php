@extends('backend.layouts.main')

@section('title', __('Static Pages'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Management Static Pages') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('admin.index')}}">
          <i class="fa fa-dashboard"></i>{{ __('Home Page') }}</a></li>
        <li class="active">{{ __('Static Pages') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title title-header">{{ __('List Static Pages') }}</h3>
            </div>
           
            <!-- /.box-header -->
            <div class="box-body">
            <!-- messages -->
              @include('flash::message')
            <!-- end msg -->
            <table id="table-contain" class="table table-bordered table-striped table-hover">
              <thead>
                <tr>
                  <th class="col-md-1">{{ __('ID') }}</th>
                  <th >{{ __('Title page') }}</th>
                  <th class="col-md-1 text-center">{{ __('Option') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($staticPages as $staticPage)
                  <tr>
                    <td>{{ $staticPage->id }}</td>
                    <td>{{ $staticPage->title }}
                    </td>
                    <td class="text-center">
                      <a href="{{ route('static-page.edit', $staticPage->id) }}"><i class= "btn-edit fa fa-pencil-square-o btn-custom-option "></i></a>
                    </td>
                  </tr>
                @endforeach
               </tbody>
              </table>
              {{ $staticPages->render() }}
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
