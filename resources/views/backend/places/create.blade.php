@extends('backend.layouts.main')

@section('title','Add place')

@section('content')
  <div class="content-wrapper">
    <h1 class="title_page text-success">
      {{__("Add place")}}
    </h1>
    <!-- Main content -->
    <section class="content">
      <div class="row margin_center">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{__("Enter infomation")}}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{!!route('place.store')!!}" enctype="multipart/form-data"
              method="POST">
              {!! csrf_field()!!}
              <div class="box-body">
                <div class="form-group" {{ $errors->has('name') ? ' has-error' : '' }}>  
                  <label for="input-name">{{__("Name")}}</label>
                  <input type="text" class="form-control" id="name"
                    placeholder="{{__('Enter Name')}}" name="name" >
                  @if($errors->first('name'))
                    <span class="msg msg-warning help-block">{{__($errors->first('name'))}}</span>
                  @endif  
                </div>

                <div class="form-group has-feedback" 
                  {{ $errors->has('descript') ? ' has-error' : '' }}>
                  <label for="input-descript">{{__("Descript")}}</label>
                  <input type="text" class="form-control" id="descript" 
                    placeholder="{{__('Enter Descript')}}" name="descript" >
                  @if($errors->first('descript'))
                    <span class="msg msg-warning help-block">{{$errors->first('descript')}}</span>
                  @endif  
                  <span class="glyphicon glyphicon-ok form-control-feedback"></span>
                </div>

                <div class="form-group col-md-6 center-block" 
                  {{ $errors->has('name') ? ' has-error' : '' }}>  
                  <label for="input-file">{{__("Image")}}</label>
                  <input type="file" class="form-control" value=""
                    id="input-file" name="image" >
                  @if($errors->first('image'))
                    <span class="msg msg-warning help-block">{{$errors->first('image')}}</span>
                  @endif
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="reset" class="btn btn-warning">{{__("Reset")}}</button>
                <button type="submit" class="btn btn-primary">{{__("Submit")}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>   
    </section> 
  </div>   
@endsection
