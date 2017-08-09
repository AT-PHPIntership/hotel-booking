@extends('frontend.layouts.master')

@section('content')
  <div class="container">
    <main class="main-page-error">
      <h1>{{__('404 - Page Not found')}}</h1>
      <p>{{__('Sorry...You requested the page that is no longer there')}}</p>
    </main>    
  </div>   
@endsection
