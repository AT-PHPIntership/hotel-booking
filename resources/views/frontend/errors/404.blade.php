@extends('frontend.layouts.master')

@section('content')
  <div class="container">
    <main class="main-page-error">
      <h1>{{trans('errors.404.frontend.title')}}</h1>
      <p>{{trans('errors.404.frontend.content')}}</p>
    </main>    
  </div>   
@endsection
