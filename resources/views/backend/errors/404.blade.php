@extends('backend.layouts.main')

@section('title', __("Home page"))

@section('content')
  <div class="content-wrapper">
    <div class="content-error-page-admin">
      <h1 class="title-error">{{__('404 - Page Not found')}}</h1>
      <div class="content-error">{{__('Sorry...You requested the page that is no longer there')}}</div>
    </div>
   </div>
@endsection
