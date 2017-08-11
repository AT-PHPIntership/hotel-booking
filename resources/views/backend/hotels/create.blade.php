@extends('backend.layouts.main')
@section('title', __('Create Hotel'))
@section('content')
  <div class="content-wrapper">
    <h1 class="title_page">{{__('Add hotel')}}</h1>
    <section class="content">
      <div class="row margin_center">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">{{__('Fill in form, please!')}}</h3>
            </div>
            <form role="form" method="POST" action="{{ route('hotel.store') }}" >
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
                    <select class="form-control" name="place">
                      <option value="">Choose Place</option>
                      @foreach($places as $place)
                        <option value="{{ $place->id }}">{{ $place->name }}</option>
                      @endforeach
                    </select>
                    @if($errors->first('place'))
                      <span class="text-danger">{{ $errors->first('place') }}</span>
                    @endif
                  </div>
                   {{-- select star --}}
                  <div class="form-group" {{ $errors->has('star') ? ' has-error' : '' }}>
                    <select class="form-control" name="star">
                      <option value="">Star</option>
                      @for($i = 1; $i <= 5; $i++ )
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
                {{-- upload image --}}
                <div class="form-group">
                  <input type="file" class="form-control" name='imgs[]' id="img-upload" multiple placeholder="{{ __('Images') }}" value="{{ old('img') }}">
                   <div id="preview-img">
                     
                   </div>
                </div>
              </div>
              <div class="box-footer btn-add-news">
                <button type="reset" class="btn btn-primary">
                  {{__('Reset')}}
                </button>
                <button type="submit" class="btn btn-primary" id="js-bt-submit">
                  {{__('Submit')}}
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection