@extends('backend.layouts.main')

@section('title', @trans("admin_home.home_title"))

@section('content')
  <div class="content-wrapper">
    <div class="content-error-page-admin">
      <h1 class="title-error">{{trans('errors.404.backend.title')}}</h1>
      <!-- end .message -->
      <div class="content-error">{{trans('errors.404.backend.content')}}</div>
    </div>
   </div>
@endsection
