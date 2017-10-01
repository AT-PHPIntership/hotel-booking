@extends('frontend.layouts.master')
@section('customcss')
<link rel="stylesheet" href="{{ asset('frontend/css/stylecustom.css') }}">
@endsection
@section('title', __($staticPage->title))
@section('content')
<section class="rooms mt50 border-left">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h2 class="lined-heading">
            <span class="relative-header text-center">
              {{ __($staticPage->title) }}
            </span>
          </h2>
        </div> 
      </div>
      <div class="wrapper col-sm-12">
        <div> 
          <img class="pull-left cls-img-static-page" src="{{ asset(config('image.static_page_img'))}}" alt="Snorlax">
          <div class="content-static-page">{!! $staticPage->content !!}</div> 
        </div>  
      </div>
    </div>
</section>
</div>
@endsection
