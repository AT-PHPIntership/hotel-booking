@extends('backend.layouts.main')
@section('title', 'List comment')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      {{ __('List comment & rating') }}
      <small>{{ __('Admin') }}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>{{ __('Home') }}</a></li>
      <li class="active">{{ __('List comment & rating') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ __('Table detail') }}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          {{-- message notifi --}}
          @include('flash::message')
          @include('backend.layouts.partials.modal')
            <table id="list-table" class="table table-bordered table-striped">
              <thead>
                <tr align="center">
                  <th>{{ __('No.') }}</th>
                  <th>{{ __('Username') }}</th>
                  <th>{{ __('Full Name') }}</th>
                  <th>{{ __('Comment') }}</th>
                  <th>{{ __('Hotel Name') }}</th>
                  <th>{{ __('Total Rating') }}</th> 
                  <th>{{ __('Created At') }}</th> 
                  <th>{{ __('Options') }}</th> 
                </tr>
              </thead>
              <tbody>
                @foreach($ratingComments as $ratingComment)
                  <tr align="left">
                    <td>{{ $ratingComment->id }}</td>
                    <td><a href="{{ route('user.show', $ratingComment->user->id) }}">{{ $ratingComment->user->username }}</a></td>
                    <td>{{ $ratingComment->user->full_name }}</td>
                    <td>{{ $ratingComment->comment }}</td>
                    <td><a href="{{ route('hotel.show', $ratingComment->hotel->id) }}">{{ $ratingComment->hotel->name }}</a></td>
                    <td>{{ $ratingComment->total_rating }}</td> 
                    <td>{{ $ratingComment->created_at }}</td> 
                    <td align="center">
                      <form class="delete-item" method="POST" action="{{ route('comment.destroy', $ratingComment->id) }}">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <button type="submit" class="news-btn fa fa-trash-o btn-delete-item pull-left"  
                        data-original-title="Delete" data-toggle="tooltip"  data-title="{{ __('Confirm deletion!') }}"
                        data-confirm="{{ __('Are you sure you want to delete?') }}">
                        </button>
                      </form>
                    </td>
                  </tr>
                @endforeach
             </tbody>
            </table>
            {!! $ratingComments->render() !!}
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection