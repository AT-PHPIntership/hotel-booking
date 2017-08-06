@extends('backend.layouts.main')
@section('title', 'List hotels')
@section('content')
<div class="content-wrapper">
  <section class="content-header">
    <h1>
      {{ trans('admin_hotel.title') }}
      <small>{{ trans('admin_hotel.head_list') }}</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>{{ trans('admin_hotel.home') }}</a></li>
      <li class="active">{{ trans('admin_hotel.title') }}</li>
    </ol>
  </section>

 <!-- Main content -->
 <section class="content">
   <div class="row">
     <div class="col-xs-12">
       <div class="box">
         <div class="box-header">
           <h3 class="box-title">{{ trans('admin_hotel.title') }}</h3>
           @include('flash::message')
         </div>
         <div class="float-left">
           <a class="btn btn-primary" href="{{ route('hotel.create') }}">
           {{ trans('admin_hotel.link_add_hotel') }}
           </a>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
           <table id="list-table" class="table table-bordered table-striped">
             <thead>
             <tr align="center">
               <th>{{ trans('admin_hotel.id') }}</th>
               <th>{{ trans('admin_hotel.col_name') }}</th>
               <th>{{ trans('admin_hotel.col_address') }}</th>
               <th>{{ trans('admin_hotel.col_place') }}</th>
               <th>{{ trans('admin_hotel.col_star') }}</th>
               <th>{{ trans('admin_hotel.col_total_room') }}</th>
               <th>{{ trans('admin_hotel.col_create_at') }}</th>
               <th>{{ trans('admin_hotel.col_update_at') }}</th>
               <th>{{ trans('admin_hotel.col_options') }}</th>
             </tr>
             </thead>
             <tbody>
               @foreach ($hotels as $item)
                   <tr>
                     <td>{{ $item->id }}</td>
                     <td>{{ $item->name }}
                     <td>{{ $item->address }}</td>
                     <td>{{ $item->place->name }}</td>
                     <td>{{ $item->star }}</td>
                     <td>{{ $item->rooms->count()}}
                     <td>{{ $item->created_at }}</td>
                     <td>{{ $item->updated_at }}</td>
                     <td align="center">
                       <button class="glyphicon glyphicon-edit" class="btn"></button>
                       <form method="POST" action="{{ route('hotel.destroy', $item->id) }}">
                         <input type="hidden" name="_method" value="DELETE">
                         <input type="hidden" name="user_id" value="">
                         {!! csrf_field() !!}
                         {!! method_field('DELETE') !!}
                         <button class="glyphicon glyphicon-trash" onclick="return confirm({{ trans('admin_hotel.message_comfirm_delete') }});" type="submit" class="btn">
                         </button>
                       </form> 
                     </td>
                   </tr>
                  @endforeach
            </tbody>
           </table>
            {{-- {!! $hotels->render() !!} --}}
         </div>
         <!-- /.box-body -->
       </div>
       <!-- /.box -->
     </div>
     <!-- /.col -->
   </div>
   <!-- /.row -->
 </section>
@endsection