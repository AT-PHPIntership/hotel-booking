@extends('backend.layouts.master')

@section('title','Room')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Buồng phòng khách sạn
        <small>Room</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Trang chủ</a></li>
        <li class="active">Buồng phòng</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Danh sách Phòng</h3>
            </div>
            <div class="float-left">
              <a href="">
              <span>Thêm Phòng <img src="../../hotel_admin/dist/img/plus-small.gif" alt="ThemTin"></span>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Describe</th>
                  <th>Price</th>
                  <th>Size</th>
                  <th>Total</th>
                  <th>Bed</th>
                  <th>Direction</th>
                  <th>Max_Guest</th>
                  <th>Hotel</th>
                  <th>Function</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dít/img/pencil.gì" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dít/img/bin.gì" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
                <tr>
                  <td>1</td>
                  <td>Phòng VIP 101</td>
                  <td>Cạnh biển, có thể ngắm bình minh lúc bão, nhìn thấy các hiện tượng tự nhiên như sóng thần, lốc xoáy,...</td>
                  <td>300$/ đêm</td>
                  <td> 15 m2</td>
                  <td> 5 phòng</td>
                  <td> 2 giường</td>
                  <td>Hướng 1 giờ</td>
                  <td>3 người</td>
                  <td>Thousand Star Hotel</td>
                  <td align="center">
                    <a href="">Sửa <img src="../../hotel_admin/dist/img/pencil.gif" alt="edit" /></a>
                    <a href="">Xóa <img src="../../hotel_admin/dist/img/bin.gif" width="16" height="16" alt="delete" /></a>
                  </td>
                </tr>
              </table>
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

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <!-- /.control-sidebar-menu -->
  @include('backend.layouts.partials.infor'
      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

@endsection