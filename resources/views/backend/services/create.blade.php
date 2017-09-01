@extends('backend.layouts.main')

@section('title', __('Add service'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="text-center text-success">
        {{ __("Add service") }}
      </h1>
      <div class="row margin-center">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __("Enter infomation") }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{!! route('service.store') !!}" method="POST">
              
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group has-feedback
                  {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control" name= "name" id="name"
                    placeholder="{{ __('Enter service name') }}" value="{{ old('name') }}">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-default btn-custom" href="javascript:history.back()">
                  {{ __('Back') }}
                </a>
                <button type="reset" class="btn btn-warning btn-custom">
                  {{ __('Reset') }}
                </button>
                <button type="submit" class="btn btn-primary btn-custom pull-right">
                  {{ __('Submit') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>   
    </section> 
  </div>   
@endsection
