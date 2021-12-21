@extends('layouts.admin')

@section('title')
    <title>Danh mục sản phẩm</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'Index','key'=>'list'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="container">
            <a href="{{ URL::to('admin/insert-coupon') }}" class="btn btn-success float-right">Add</a>
            <table class="table table-bordered" id="datatable">
                <thead>
                <tr>
                    <th>Tên coupon</th>
                    <th>mã coupon</th>
                    <th>số lượng</th>
                    <th>số tiền giảm</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($coupon as $key => $cou)
                    <tr>
                        <td>{{ $cou->coupon_name}}</td>
                        <td>{{ $cou->coupon_code}}</td>
                        <td>{{ $cou->coupon_time}}</td>
                        <td>${{ $cou->coupon_number}}</td>
                        <td>
                            <a onclick="return confirm('bạn có chắc xóa mã không?')" href="{{URL::to('admin/delete-coupon/'.$cou->coupon_id)}}" class="active styling-edit" ui-toggle-class="">
                                <i class="fa fa-times text danger text"></i>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.content-wrapper -->
@endsection



