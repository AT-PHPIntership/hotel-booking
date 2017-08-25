@extends('backend.layouts.main')

@section('title', __('Static Page'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Static Page') }}
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('Home Page') }}</a></li>
        <li class="active">{{ __('Static Page') }}</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title title-header">{{ __('Static Content') }}</h3>
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
                  <th >{{ __('Title') }}</th>
                  <th class="col-md-1">{{ __('Action') }}</th>
                </tr>
              </thead>
              <tbody>
            @foreach ($staticPages as $staticPage)
                <tr>
                  <td>{{ $staticPage->id }}</td>
                  <td>{{ $staticPage->title }}
                  </td>
                  <td align="center">
                    <a href="{{ route('static-page.edit', $staticPage->id) }}"><i class= "fa fa-pencil-square-o cus_icon"></i></a>
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
