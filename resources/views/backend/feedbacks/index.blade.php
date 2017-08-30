@extends('backend.layouts.main')

@section('title', __('Feedback'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Management Feedback') }}
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>
            {{ __('Home page') }}
          </a>
        </li>
        <li class="active">
          <a href="{{ route('feedback.index') }}">
            {{ __('Feedback') }}
          </a>
        </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title title-header">
                {{ __('List feedback') }}
              </h3>
            </div>
            
            <!-- /.box-header -->
            <div class="box-body">
              @include('flash::message')
              <div class="row">
                <div class="col-md-6 container-search ">
                  <form class="container-search" method="GET" action="{{ route('feedback.index') }}">
                    <input class="input-search form-control" placeholder="Search" name="search" type="text" value="{{ app('request')->input('search') }}">
                    <button type="submit" id="btn-search" class="btn btn-primary btn-search"><i class="glyphicon glyphicon-search"></i></button>
                  </form>
                </div>
                 
              </div>
              @include('backend.layouts.partials.modal')
              <table id="table-contain" class="table table-bordered table-striped
                table-responsive mt-20">
                <thead>
                  <tr>
                    <th class="text-center">{{ __('ID') }}</th>
                    <th class="text-center">{{ __('Full name') }}</th>
                    <th class="text-center">{{ __('Email') }}</th>
                    <th class="text-center">{{ __('Content') }}</th>
                    <th class="text-center">{{ __('Option') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($feedbacks as $feedback)
                    <tr>
                      <td class="col-no text-center">{{ $feedback->id }}</td>
                      <td class="text-center col-fullname">
                        {{ $feedback->full_name }}
                      </td>
                      <td class="col-email">{{ $feedback->email }}</td>
                      <td class="col-content">{{ contentLimit($feedback->content)}}</td>
                      <td class="text-center col-action">
                        <div class="btn-option text-center">
                          <a href="{{ route('feedback.show', $feedback->id) }}"
                            class="btn-edit fa fa-search-plus btn-custom-option pull-left">
                            <i class="" aria-hidden="true"></i>
                          </a>
                          <form  class="form-delete" method="post" 
                            action="{{ route('feedback.destroy', $feedback->id) }}">
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
              {{ $feedbacks->links() }}
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
