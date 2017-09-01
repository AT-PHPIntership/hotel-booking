@extends('backend.layouts.main')

@section('title', __('Add room'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <h1 class="text-center text-success">
        {{ __('HOTEL NAME: :name', ['name' => $hotel->name]) }}
      </h1>
      <h1 class="text-center text-success">
        @include('flash::message')
        {{ __("Create room") }}
      </h1>
      <div class="row margin-center">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __("Enter infomation") }}</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form action="{!! route('room.store', $hotel->id) !!}" enctype="multipart/form-data"
              method="POST">
              {!! csrf_field() !!}
              <div class="box-body">
                <div class="form-group has-feedback
                  {{ $errors->has('name') ? ' has-error' : '' }}">
                  <label for="name">{{ __('Name') }}</label>
                  <input type="text" class="form-control" name= "name" id="name"
                    placeholder="{{ __('Enter room name') }}" value="{{ old('name') }}">
                  <small class="text-danger">{{ $errors->first('name') }}</small>
                </div>

                <div class="form-group has-feedback
                  {{ $errors->has('descript') ? ' has-error' : '' }}">
                  <label for="descript">{{ __('Description') }}</label>
                  <textarea class="form-control" name= "descript" 
                    id="place-descript" placeholder="Enter description">{{ old('descript') }}</textarea>
                  <small class="text-danger">{{ $errors->first('descript') }}</small>
                </div>
                <div class="form-group col-md-4 has-feedback
                  {{ $errors->has('price') ? ' has-error' : '' }}">
                  <label for="price">{{ __('Price(Vnd)') }}</label>
                  <input type="text" class="form-control" name= "price" 
                    id="price" placeholder="{{ __('Enter price') }}"
                    value="{{ old('price') }}" >
                  <small class="text-danger">{{ $errors->first('price') }}</small>
                </div>
                <div class="form-group col-md-4 ">
                  <label for="size">{{ __('Size(m2)') }}</label>
                  <input type="text" class="form-control" name= "size" 
                    id="size" placeholder="{{ __('Enter size') }}"
                    value="{{ old('size') }}" >
                </div>
                <div class="form-group col-md-4 has-feedback
                  {{ $errors->has('total') ? ' has-error' : '' }}">
                  <label for="total">{{ __('Total') }}</label>
                  <input type="text" class="form-control" name= "total" 
                    id="total" placeholder="{{ __('Enter total') }}"
                    value="{{ old('total') }}" >
                  <small class="text-danger">{{ $errors->first('total') }}</small>
                </div>
                <div class="form-group col-md-4 ">
                  <label for="bed">{{ __('Bed') }}</label>
                  <input type="text" class="form-control" name= "bed" 
                    id="bed" placeholder="{{ __('Enter description of bed') }}"
                    value="{{ old('bed') }}" >
                </div>
                <div class="form-group col-md-4 ">
                  <label for="direction">{{ __('Direction') }}</label>
                  <input type="text" class="form-control" name= "direction" 
                    id="direction" placeholder="{{ __('Enter direction') }}"
                    value="{{ old('direction') }}" >
                </div>
                <div class="form-group col-md-4 has-feedback
                  {{ $errors->has('max_guest') ? ' has-error' : '' }}">
                  <label for="max_guest">{{ __('Max guest') }}</label>
                  <input type="text" class="form-control" name= "max_guest" 
                    id="max_guest" placeholder="{{ __('Enter max guest') }}"
                    value="{{ old('max_guest') }}" >
                  <small class="text-danger">{{ $errors->first('max_guest') }}</small>
                </div>
                <div class="form-group {{ $errors->has('images.*') || $errors->has('images') ? ' has-error' : '' }}"> 
                  <label for="input-file">{{ __("Images") }}</label>
                  <input type="file" class="form-control" name="images[]" id="multiple-image" multiple>
                  <small class=" text-danger">{{ $errors->first('images.*') . $errors->first('images') }}</small>
                  <div id="showImage" class="mt-20">
                    <img class="img-place" id="default-image" src="{{ asset(config('image.no_image')) }}">
                  </div>
                </div>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-default btn-custom" href="{{ URL::previous() }}">
                  {{ __('Back') }}
                </a>
                <button type="reset" class="btn btn-warning btn-custom">
                  {{ __('Reset') }}
                </button>
                <button type="submit" class="btn btn-primary btn-custom pull-right">
                  {{ __('Submit') }}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>   
    </section> 
  </div>   
@endsection
