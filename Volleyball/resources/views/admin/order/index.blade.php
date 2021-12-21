@extends('layouts.admin')

@section('title')
    <title>Order Index</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/indexSlider/indexSlider.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'Order','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('orders.search') }}" class="form-inline" method="POST" >
                        <legend>Tìm kiếm đơn hàng</legend>
                        @csrf
                        <div class="form-group mx-sm-2 mb-2">
                            <input type="text" class="form-control" name="order_search"
                                   placeholder="Id,User Id,Trạng thái,...">
                        </div>

                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </form>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">User Id</th>
                                <th scope="col">Ngày đặt hàng</th>
                                <th scope="col">Trạng thái đơn hàng</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <th scope="row">{{ $order->id}}</th>
                                    <td>{{ $order->user_id }}</td>
                                    <td>{{ $order->created_at }}</td>
                                    <td>
                                        @if( $order->status == 0)
                                            <span class="text-warning">CHỜ XỬ LÝ</span>
                                        @elseif( $order->status == 1)
                                            <span class="text-info">ĐANG GIAO HÀNG</span>
                                        @elseif( $order->status == 2)
                                            <span class="text-primary">ĐÃ HOÀN THÀNH</span>
                                        @else
                                            <span class="text-danger">HỦY GIAO HÀNG</span>
                                        @endif
                                    </td>
                                    <td>${{ $order->total }}</td>
                                    <td>
                                        @can('user-edit')
                                            <a href="{{route('orders.confirm',['id'=>$order->id])}}"
                                               class="btn btn-default">Duyệt đơn</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="col-md-12">
                            {{ $orders->links() }}
                        </div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



