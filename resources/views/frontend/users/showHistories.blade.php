@extends('frontend.layouts.partials.master')
@section('title','Hitory Booking Room')
@section('customcss')
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/historyBooking.css') }}">
@endsection
@section('content')
  <section class ='historyBooking'>
    <div class="container">
      <div class="row">
        
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">History Booking Room</h3>
            </div>
            <div class="panel-body">
                  <table class="table table-user-information">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>1111</th>
                        <th colspan="2">Option</th>
                      </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i<10; $i++)
                      <tr>
                        <td>AAA</td>
                        <td>BBB</td>
                        <td>
                          <div  class="form-Edit">
                            <a href="/editHistory" class="btn btn-success" data-original-title="Edit this!" data-toggle="tooltip">
                              <span class="fa fa-edit"></span>
                            </a>
                          </div>
                          <form class = "form-DelHistory" method="" action="">
                            <a data-original-title="Delete!" data-toggle="tooltip" href="" onclick="return confirm('AAAA?')" class="btn btn-danger">
                              <span class="fa fa-times"></span>
                            </a>
                          </form>
                        </td>
                      </tr>
                    @endfor
                    </tbody>
                  </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
@section('customjs')
<script type="text/javascript" src ="{{asset('frontend/js/userProfile.js')}}"></script>
@endsection
