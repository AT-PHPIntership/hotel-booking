@extends('backend.layouts.main')

@section('title', __('Feedback detail'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Feedback detail') }}
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>
            {{ __('Home page') }}
          </a>
        </li>
        <li>
          <a href="{{ route('feedback.index') }} "><i class="fa fa-map-marker"></i>
            {{ __('Feedback') }}
          </a>
        </li>
        <li class="active">{{ __('Feedback detail') }} </li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12  ">
          <div class="box clearfix">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">{{ __('Feedback content') }}</h3>
              </div>
              <!-- /.box-header -->
              <div class="box-body no-padding">
                <div class="mailbox-read-info">
                  <h3>{{ __('From:') }} {{ $feedback->full_name }}</h3>
                  <h5>{{ __('Email:') }} {{ $feedback->email }}
                    <span class="mailbox-read-time pull-right">{{ $feedback->created_at }}</span></h5>
                </div>
                <div class="mailbox-read-message">
                  <p>{{ $feedback->content }} </p>
                </div>
              </div>
              <div class="box-footer">
                @include('backend.layouts.partials.modal')
                <div class="pull-right">
                  <form  class="form-delete" method="post" 
                    action="{{ route('feedback.destroy', $feedback->id) }}">
                    {!! csrf_field() !!}
                    {{ method_field('DELETE') }}
                    <button class=" btn btn-default btn-delete-item fa fa-trash-o"
                      data-title="{{ __('Confirm deletion!') }}"
                      data-confirm="{{ __('Are you sure you want to delete?') }}" 
                      type="submit" >
                    </button>  
                  </form> 
                </div>
                <a class="btn btn-default btn-custom" id="btn-go-back" 
                  href="javascript:history.back()">
                  <i class="fa fa-arrow-left"></i>{{ __(' Back') }}
                </a>
              </div>
            </div>
          </div>   
        </div>   
      </div>
    </section>
  </div>
@endsection
