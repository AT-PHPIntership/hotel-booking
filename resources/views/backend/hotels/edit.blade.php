@extends('backend.layouts.main')
@section('title', __('Create Hotel'))
@section('content')
  <div class="content-wrapper">
    <section class="content">
    <h1 class="title-page text-success">{{__('Update hotel')}}</h1>
      <div class="row margin-center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title lead">{{ __('Enter information') }}</h3>
            </div>
            <form role="form" method="POST" action="{{ route('hotel.update', $hotel->id) }}" enctype="multipart/form-data" >
              {{csrf_field()}}
              {{method_field('PUT')}}
              <input type="hidden" value="{{ $hotel->id }}" name="id">
              <div class="box-body">
                @include('flash::message') 
                {{-- input hotel name --}}
                <div class="form-group" {{ $errors->has('name') ? ' has-error' : '' }}>
                  <label>{{ __('Name') }}</label>
                  <input type="text" class="form-control" name="name" value="{{ $hotel->name }}">
                  @if($errors->first('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
                {{-- input address --}}
                <div class="form-group" {{ $errors->has('address') ? ' has-error' : '' }}>
                  <label>{{ __('Address') }}</label>
                  <input type="text" class="form-control" name="address" value="{{ $hotel->address }}">
                  @if($errors->first('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                  @endif
                </div>
                {{-- select place adn star --}}
                <div class="form-inline">
                  {{-- place select --}}
                  <div class="form-group" {{ $errors->has('place') ? ' has-error' : '' }}>
                    <p><strong>{{ __('Place') }}</strong></p>
                    <select class="form-control" name="place_id">
                      <option value="">{{ __('Choose Place') }}</option>
                      @foreach($places as $place)
                        <option value="{{ $place->id }}" {{ $hotel->place_id == $place->id ? 'selected' : '' }}>{{ $place->name }}</option>
                      @endforeach
                    </select>
                    @if($errors->first('place_id'))
                      <span class="text-danger">{{ $errors->first('place_id') }}</span>
                    @endif
                  </div>
                   {{-- select star --}}
                  <div class="form-group ml-5per" {{ $errors->has('star') ? ' has-error' : '' }}>
                    <p><strong>{{ __('Star') }}</strong></p>
                    <select class="form-control" name="star">
                      <option value="">{{ __('Star') }}</option>
                      @for($i = App\Model\Hotel::STAR_MIN; $i <= App\Model\Hotel::STAR_MAX; $i++ )
                        <option value="{{ $i }}" {{ $hotel->star == $i ? 'selected' : '' }}>{{ $i }}</option>
                      @endfor
                    </select>
                    @if($errors->first('star'))
                      <span class="text-danger">{{ $errors->first('star') }}</span>
                    @endif
                  </div>
                </div>
                {{-- introduce --}}
                <label></label>
                <div class="form-group" {{ $errors->has('introduce') ? ' has-error' : '' }}>
                  <label>{{ __('Introduce') }}</label>
                  <textarea class="ckeditor" name="introduce">{{ $hotel->introduce }}</textarea>
                  @if($errors->first('introduce'))
                    <span class="text-danger">{{ $errors->first('introduce') }}</span>
                  @endif
                </div>
                {{-- Services --}}
                <div class="form-group">
                <p><b>{{ __('Choose Services') }}</b></p>
                  @foreach($services as $service)
                    <div class="checkbox-inline">
                      <label><input {{ ($hotel->hotelServices->contains('service_id', $service->id)) ? 'checked' : ''}} type="checkbox" name="services[]" value="{{ $service->id }}">{{ $service->name }}</label>
                    </div>
                  @endforeach
                </div>
                {{-- old images --}}
                @include('backend.layouts.partials.modal')
                <div class="form-group">
                  <label for="old-images">{{ __('Old Images') }}</label>
                  <div
                    id="old-images"
                    class="col-md-12"
                    data-token="{{ csrf_token() }}"
                    data-title="{{ __('Confirm deletion!') }}"
                    data-confirm="{{ __('Are you sure you want to delete?') }}">
                    @if (isset($hotel->images[0]))
                      @foreach ($hotel->images as $img)
                        <div id="old-img-{{ $img->id }}" class="col-md-3 text-center img-contain">
                          <button
                            data-url="{{ route('image.destroy', $img->id) }}"
                            class="btn-remove-img btn-link fa fa-times fz-20">
                          </button>
                          <img class="img-place" src="{{ asset($img->path) }}">
                        </div>
                      @endforeach
                    @else
                      <div id="old-images" class="text-info">{{ __('No old image') }}</div>
                    @endif
                  </div>
                </div>
                {{-- new images --}}
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