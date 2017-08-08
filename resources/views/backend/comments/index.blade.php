@extends('backend.layouts.main')
@section('title', 'List comment')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      {{ trans('admin_comment.title') }}
      <small>{{ trans('admin_comment.small') }}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>{{ trans('admin_comment.home') }}</a></li>
      <li class="active">{{ trans('admin_comment_list.head') }}</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">{{ trans('admin_comment.head') }}</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
          {{-- message notifi --}}
          @include('flash::message')
        
            <table id="list-table" class="table table-bordered table-striped">
              <thead>
                <tr align="center">
                  <th>{{ trans('admin_comment.col_id') }}</th>
                  <th>{{ trans('admin_comment.col_username') }}</th>
                  <th>{{ trans('admin_comment.col_full_name') }}</th>
                  <th>{{ trans('admin_comment.col_comment') }}</th>
                  <th>{{ trans('admin_comment.col_hotel_name') }}</th>
                  <th>{{ trans('admin_comment.col_total_rating') }}</th> 
                  <th>{{ trans('admin_comment.col_created_at') }}</th> 
                  <th>{{ trans('admin_comment.col_options') }}</th> 
                </tr>
              </thead>
              <tbody>
                @foreach($ratingComments as $objRatingComment)
                  <tr align="left">
                    <td>{{ $objRatingComment->id }}</td>
                    <td>{{ $objRatingComment->users->username }}</td>
                    <td>{{ $objRatingComment->users->full_name }}</td>
                    <td>{{ $objRatingComment->comment }}</td>
                    <td>{{ $objRatingComment->hotels->name }}</td>
                    <td>{{ $objRatingComment->total_rating }}</td> 
                    <td>{{ $objRatingComment->created_at }}</td> 
                    <td align="center">
                      <form method="POST" action="{{ route('comment.destroy', $objRatingComment->id) }}">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="user_id" value="{{ $objRatingComment->id }}">
                        {!! csrf_field() !!}
                        {{ method_field('DELETE') }}
                        <button class="glyphicon glyphicon-trash" onclick="return confirm('Confirm deletion! {{ $objRatingComment->id }}');" type="submit" class="btn">
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