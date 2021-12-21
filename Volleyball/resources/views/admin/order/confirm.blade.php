@extends('layouts.admin')

@section('title')
    <title>Order Detail</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Order','key'=>'Detail'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form action="{{ route('orders.update',['id'=>$orders->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                            </div>
                            <div class="form-group">
                                <label>Tên người mua</label>
                                <input type="text"
                                       class="form-control"
                                       name="name" ;
                                       value="{{$orders->name}}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text"
                                       class="form-control"
                                       name="address" ;
                                       value="{{$orders->address}}"
                                >
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text"
                                       class="form-control"
                                       name="phone" ;
                                       value="{{$orders->phone}}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Ghi chú</label>
                                <textarea name="note" class="form-control">{{$orders->note}}</textarea>
                            </div>

                            <div class="form-group">
                                <label>Hình thức thanh toán</label>
                                <input type="text"
                                       class="form-control"
                                       name="payments" ;
                                       value="{{$orders->payments}}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Ngày đặt hàng</label>
                                <input type="text"
                                       class="form-control"
                                       name="created_at" ;
                                       value="{{$orders->created_at}}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Tổng tiền</label>
                                <input type="text"
                                       class="form-control"
                                       name="total" ;
                                       value="${{$orders->total}}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Trạng thái đơn hàng : </label>
                                <select name="status">
                                    <option selected>@if($orders->status == 0)
                                            <span>CHỜ XỬ LÝ</span>
                                        @elseif( $orders->status == 1)
                                            <span >ĐANG GIAO HÀNG</span>
                                        @elseif( $orders->status == 2)
                                            <span>ĐÃ HOÀN THÀNH</span>
                                        @endif
                                    </option>

                                    <option value="0" @if($orders->status == 0) disabled @endif>CHỜ XỬ LÝ</option>
                                    <option value="1" @if($orders->status == 1) disabled @endif>ĐANG GIAO HÀNG</option>
                                    <option value="2" @if($orders->status == 2) disabled @endif>ĐÃ HOÀN THÀNH</option>

                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Cập nhật đơn hàng</button>
                        </form>
                    </div>

                    <div class="col-md-12"><br><br>
                        <h3>Thông tin Đơn hàng</h3>
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Size</th>
                                <th scope="col">Số lượng</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Thành tiền</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order_product as $order)
                                <tr>
                                    <th scope="row"><img style="height: 80px;width: 80px;object-fit: contain" src="{{ $order->feature_image_path }}"></th>
                                    <td>{{ $order->name }}</td>
                                    <td>{{ $order->size }}</td>
                                    <td>{{ $order->quantity }}</td>
                                    <td>${{ $order->price }}</td>
                                    <td>{{ $order->quantity*$order->price }}</td>
{{--                                    <td>--}}
{{--                                        @can('user-edit')--}}
{{--                                            <a href="{{route('orders.confirm',['id'=>$order->id])}}"--}}
{{--                                               class="btn btn-default">Kiểm tra</a>--}}
{{--                                        @endcan--}}
{{--                                    </td>--}}
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <h3 class="text-success">Tổng tiền đơn hàng: ${{$orders->total}}</h3>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection
