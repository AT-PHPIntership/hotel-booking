@extends('backend.layouts.main')
@section('title', __('Create Hotel'))
@section('content')
  <div class="content-wrapper">
    <section class="content">
    <h1 class="title-page">{{__('Create hotel')}}</h1>
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter information') }}</h3>
            </div>
            <form role="form" method="POST" action="{{ route('hotel.store') }}" enctype="multipart/form-data" >
              {{csrf_field()}}
              <div class="box-body"> 
                {{-- input hotel name --}}
                <div class="form-group" {{ $errors->has('name') ? ' has-error' : '' }}>
                  <input type="text" class="form-control" name="name" placeholder="{{ __('Hotel name') }}" value="{{ old('name') }}">
                  @if($errors->first('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                {{-- input address --}}
                <div class="form-group" {{ $errors->has('address') ? ' has-error' : '' }}>
                  <input type="text" class="form-control" name="address" placeholder="{{ __('Address') }}" value="{{ old('address') }}">
                  @if($errors->first('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                  @endif
                </div>
                {{-- select place adn star --}}
                <div class="form-inline">
                  {{-- place select --}}
                  <div class="form-group" {{ $errors->has('place') ? ' has-error' : '' }}>
                    <select class="form-control" name="place_id">
                      <option value="">Choose Place</option>
                      @foreach($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                      @endforeach
                    </select>
                    @if($errors->first('place_id'))
                      <span class="text-danger">{{ $errors->first('place_id') }}</span>
                    @endif
                  </div>
                   {{-- select star --}}
                  <div class="form-group" {{ $errors->has('star') ? ' has-error' : '' }}>
                    <select class="form-control" name="star">
                      <option value="">Star</option>
                      @for($i = App\Model\Hotel::STAR_MIN; $i <= App\Model\Hotel::STAR_MAX; $i++ )
                        <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                    </select>
                    @if($errors->first('star'))
                      <span class="text-danger">{{$errors->first('star')}}</span>
                    @endif
                  </div>
                </div>
                {{-- introduce --}}
                <label></label>
                <div class="form-group" {{ $errors->has('introduce') ? ' has-error' : '' }}>
                  <textarea class="form-control" name="introduce" placeholder="{{ __('Introduction about hotel') }}" value="{{ old('introduce') }}"></textarea>
                  @if($errors->first('introduce'))
                    <span class="text-danger">{{$errors->first('introduce')}}</span>
                  @endif
                </div>
                {{-- Services --}}
                <div class="form-group">
                <p><b>{{ __('Choose Services') }}</b></p>
                  @foreach($services as $service)
                    <div class="checkbox-inline">
                      <label><input type="checkbox" name="services[]" onclick="" value="{{ $service->id }}">{{ $service->name }}</label>
                    </div>
                  @endforeach
                </div>
                <div class="form-group {{ $errors->has('images.*') || $errors->has('images') ? ' has-error' : '' }}"> 
                  <label for="input-file">{{ __("Images") }}</label>
                  <input type="file" class="form-control" name="images[]" id="multiple-image" multiple>
                  <small class=" text-danger">{{ $errors->first('images.*') . $errors->first('images') }}</small>
                  <div id="showImage" class="mt-20">
                    <img class="img-place" id="default-image" src="{{ asset(config('image.default_thumbnail')) }}">
                  </div>
                </div>
              </div>
              <div class="box-footer">
                <a class="btn btn-default btn-custom" href="javascript:history.back()">
                  {{ __('Back') }}
                </a>
                <button type="reset" class="btn btn-warning btn-custom">
                  {{ __('Reset') }}
                </button>
                <button type="submit" class="btn btn-primary btn-custom pull-right" id="js-bt-submit">
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