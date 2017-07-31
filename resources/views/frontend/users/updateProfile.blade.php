@extends('frontend.layouts.partials.master')
@section('title', 'Edit User Profile')
@section('customcss')
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/updateProfile.css') }}">
@endsection
@section('content')
   <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">UPDATE PROFILE</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                <div class=" col-md-9 col-lg-9 "> 
                  <form  action="" method="POST" class="form-horizontal">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group" >
                      <label class="control-label col-md-2">FullName:</label>
                      <div class="col-md-10">
                        <input type="text" name="idBook" class="form-control" value="">
                      </div>
                    </div>  
                    <div class="form-group" >
                      <label class="control-label col-md-2">Phone</label>
                      <div class="col-md-10">
                        <input type="text" name="bookname" class="form-control" value=" ">
                      </div>
                    </div>
                    <div class="form-group" >
                      <label class="control-label col-md-2">Password</label>
                      <div class="col-md-10">
                        <input type="password" name="password" class="form-control" value="">
                      </div>
                    </div>  
                        <div class="footer-btnSubmit">
                          <button type ="submit" class="btn btn-success center-block" data-original-title="OK" data-toggle="tooltip">
                            <span class="fa fa-check-square-o"></span>
                          </a>
                        </div>
                      <div class="footer-btnCancer">
                        <a href="/user" class="btn btn-danger center-block" data-original-title="Cancer" data-toggle="tooltip">
                          <span class="fa fa-times"></span>
                        </a>
                    </div>
                    </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
@section('customjs')
<script type="text/javascript" src ="{{asset('frontend/js/userProfile.js')}}"></script>
@endsection