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
                        <button class="glyphicon glyphicon-trash" onclick="
                        return confirm('{{ __('Confirm deletion!')}} ID {{ $objRatingComment->id }}');" type="submit" class="btn">
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