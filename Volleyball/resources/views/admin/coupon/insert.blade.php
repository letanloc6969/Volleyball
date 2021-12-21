
@extends('layouts.admin')

@section('title')
    <title>Thêm Coupon</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Coupon','key'=>'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form action="{{URL::to('admin/insert-coupon-code')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên mã giảm giá</label>
                                <input type="text"
                                       class="form-control"
                                       name="coupon_name";
                                       placeholder="Nhập tên mã giảm giá">

                            </div>
                            <div class="form-group">
                                <label>Mã giảm giá</label>
                                <input type="text"
                                       class="form-control"
                                       name="coupon_code";
                                       placeholder="Nhập mã giảm giá">

                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input type="text"
                                       class="form-control"
                                       name="coupon_time";
                                       placeholder="Nhập số lượng">

                            </div>
                            <div class="form-group">
                                <label>Số tiền giảm</label>
                                <input type="text"
                                       class="form-control"
                                       name="coupon_number";
                                       placeholder="Nhập số tiền giảm">

                            </div>


                            <button type="submit" name="add_coupon" class="btn btn-primary" >Submit</button>
                            <a href="{{ URL::to('admin/list-coupon') }}">List </a>
                        </form>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



