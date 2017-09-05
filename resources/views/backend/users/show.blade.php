@extends('backend.layouts.main')

@section('title', __('SHOW USER'))

@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    @if(isset($user))
      <section id="content">
        <div class="col-md-12 profile">
          <div class="col-md-4 text-center">
            <img alt="user-profile" class="img-circle"
               src="{{ asset('images/default/profile.png') }}">
            <input type="text" class="form-control text-center fz-20 mt-20" name="username" value="{{ $user->username }}" readonly>
            <div class="mt-20">
              <a href="{{ URL::previous() }}">
                <button type="button" class="btn btn-warning btn-custom btn-lg">{{ __('Back') }}</button>
              </a>
              <a href="{{ route('user.edit', $user->id) }}">
                <button type="button" class="btn btn-primary btn-custom btn-lg ml-5per">{{ __('Edit') }}</button>
              </a>
            </div>
          </div>
          <div class="col-md-8 mt-20">
            <div class="title-header text-center">
              {{ __('User Information') }}
            </div>
            <div class="col-md-12">
              <div class="col-md-2 fz-16 mt-20">{{ __('Full name') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20">{{ $user->full_name }}</div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2 fz-16 mt-20">{{ __('Email') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20">{{ $user->email }}</div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="col-md-2 fz-16 mt-20">{{ __('Phone') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20">{{ $user->phone }}</div>
              </div>
            </div>
            <div class="col-md-5">
              <div class="col-md-2 fz-16 mt-20">{{ __('Role') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20 col-md-offset-2">{{  $user->role }}</div>
              </div>
            </div>
            <div class="col-md-5 col-md-offset-1">
              <div class="col-md-2 fz-16 mt-20">{{ __('Status') }}</div>
              <div class="col-md-8">
                <div class="form-control text-center fz-16 mt-20 col-md-offset-2">{{ $user->status }}</div>
              </div>
            </div>
            <div class="mt-20 text-center">
            <button type="button" class="btn btn-link btn-custom btn-lg mt-20" data-toggle="collapse" data-target="#ratingInfomations">{{ __('History rating comment') }}</button>
            <button type="button" class="btn btn-link btn-custom btn-lg mt-20" data-toggle="collapse" data-target="#reservationInfomations">{{ __('History booking room') }}</button>
          </div>
          </div>
        </div>
      </section>
      <section id="extra-information">
        <div class="row collapse" id="ratingInfomations">
            <div class="box col-md-12 mt-20">
              <div class="box-header text-center">
                  <h3 class="title-header text-cente">{{ __('Rating Comment') }}</h3>
              </div>
              @if(!$user->ratingComments)
                <h3>{{ __('No Rating Comment') }}</h3>
              @else
                <table id="list-table" class="table table-bordered table-responsive table-striped">
                  <thead>
                    <tr align="center">
                      <th class="text-center">{{ __('ID') }}</th>
                      <th class="text-center">{{ __('Comment') }}</th>
                      <th class="text-center">{{ __('Hotel Name') }}</th>
                      <th class="text-center">{{ __('Total Rating') }}</th> 
                      <th class="text-center">{{ __('Created At') }}</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($user->ratingComments as $ratingComment)
                      <tr align="left">
                        <td class="text-center">{{ $ratingComment->id }}</td>
                        <td class="content-comment">{{ $ratingComment->comment }}</td>
                        <td class="text-center"><a href="{{ route('hotel.show', $ratingComment->hotel->id) }}">{{ $ratingComment->hotel->name }}</a></td>
                        <td class="text-center">{{ $ratingComment->total_rating }}</td> 
                        <td class="text-center">{{ $ratingComment->created_at }}</td> 
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              @endif
          </div>
        </div>

        <div class="row collapse" id="reservationInfomations">
            <div class="box col-md-12 mt-20">
              <div class="box-header text-center">
                  <h3 class="title-header text-cente">{{ __('Reservation') }}</h3>
              </div>
              @if(!$user->reservations)
                <h3>{{ __('No Reservation') }}</h3>
              @else
                <table id="list-table" class="table table-bordered table-responsive table-striped">
                  <thead>
                    <tr>
                    <th class="text-center">{{__('Id')}}</th>
                    <th class="text-center">{{__('Rooms Name')}}</th>
                    <th class="text-center">{{__('Check in')}}</th>
                    <th class="text-center">{{__('Check out')}}</th>
                    <th class="text-center">{{__('Status')}}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user->reservations as $reservation)
                    <tr>
                      <td class="text-center">{{$reservation->id}}</td>
                      <td class="text-center">
                        <a href="{{ route('room.show', [$reservation->room->hotel_id, $reservation->room->id]) }}" id="id-room-detail">
                          {{$reservation->room->name}}
                        </a>
                      </td>
                      <td class="text-center">{{$reservation->checkin_date}}</td>
                      <td class="text-center">{{$reservation->checkout_date}}</td>
                      <td class="text-center">{{$reservation->status_label}}</td>
                    </tr>
                  @endforeach
                </tbody>
                </table>
              @endif
          </div>
        </div>
      </section>
    @else
        <h1 class="text-center title-page">{{ __('Nothing to show!') }}</h1>
    @endif
  </div>
@endsection
