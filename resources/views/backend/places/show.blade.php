@extends('backend.layouts.main')

@section('title', __('Place detail'))

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ __('Place detail') }}
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="{{ route('admin.index') }}"><i class="fa fa-dashboard"></i>
            {{ __('Home page') }}
          </a>
        </li>
        <li>
          <a href="{{ route('place.index') }} "><i class="fa fa-map-marker"></i>
            {{ __('Place') }}
          </a>
        </li>
        <li class="active">{{ $place->name }}</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12  ">
          <div class="box clearfix">
            <div class="box-header with-border">
              <h2 class="bold text-center inline" id="place-detail-name">
                {{ $place->name }}
              </h2>

              
              <a class="btn btn-primary btn-custom  pull-right" id="btn-edit" 
                href="{{ route('place.edit', $place->id) }}">
                {{ __('Edit') }}
              </a>
              <a class="btn btn-default btn-custom  pull-right" id="btn-go-back" 
                href="javascript:history.back()">
                {{ __('Back') }}
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body ">
              <div class="row">
                <div class=" col-sm-6 text-center">
                  <img class="cls-image-place-detail img-responsive pad"
                    src="{{ $place->image_url }}" alt="image">
                </div>
                <div class=" col-sm-6  ">
                  <div class="box box-solid cls-descript-box-contain">
                    <div class="box-header with-border">
                      <i class="fa fa-newspaper-o"></i>
                      <h3 class="box-title">{{ __('Description') }}</h3>
                    </div>
                    <div class="box-body">
                      <dl>
                        <dd class="cls-descript-box">
                          <p class="cls-descript-text" id="place-detail-descript">
                            {{ $place->descript }}
                          </p>
                        </dd>
                      </dl>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <div class="box box-solid">
                    <h2 class="page-header">{{ __("Hotel") }} 
                      <span class="text-info small" id="count-hotels">
                        (<a href="{{ route('hotel.index', ['place_id' => $place->id]) }}">
                          {{ $totalHotels .  __(" hotel in ") . $place->name }}</a>)
                      </span>
                    </h2>
                  </div>   
                </div>   
              </div>
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
