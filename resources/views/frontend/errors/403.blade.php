@extends('frontend.layouts.master')

@section('content')
  <div class="container text-center">
    <main class="main-page-error">
      <h1>{{__('403 - ')}} {{$message}}</h1>
      <h3>{{__("Sorry...You don't have access to this request")}}</h3>
    </main>    
  </div>   
@endsection