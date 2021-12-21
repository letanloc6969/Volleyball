@extends('layouts.admin')

@section('title')
    <title>Product Index</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/indexProduct/listProduct.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

    @include('partials.content-header',['name'=>'Product','key'=>'list'])

    <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('products.search') }}" class="form-inline" method="POST" >
                        <legend>Tìm kiếm sản phẩm</legend>
                        @csrf
                        <div class="form-group mx-sm-2 mb-2">
                            <input type="text" class="form-control" name="product_search"
                                   placeholder="Nhập Id,Tên sp,Giá,...">
                        </div>

                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                    </form>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên sản phẩm</th>
                                <th scope="col">Giá</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($search_product as $productItem)
                                <tr>
                                    <th scope="row">{{ $productItem->id}}</th>
                                    <td>{{ $productItem->name }}</td>
                                    <td>{{ number_format($productItem->price) }}</td>
                                    <td>
                                        <img class="product_image_150_100" src="{{ $productItem->feature_image_path }}">
                                    </td>
                                    {{--                                     Hàm optional() hoạt động khi Danh mục(Một) không có id mà Sản phẩm(Nhiều) trỏ tới--}}
                                    {{--                                     Giúp tránh LỖI không tìm thấy id bên MỘT và vẫn trả về giá trị rỗng--}}
                                    <td>{{ optional($productItem->category)->name }}</td>

                                    <td>
                                        <a href="{{ route('products.edit',['id'=>$productItem->id]) }}"
                                           class="btn btn-default">Sửa</a>

                                        @can('product-delete')
                                            <a data-url="{{ route('products.delete',['id'=>$productItem->id]) }}"
                                               class="btn btn-danger action_delete">Xóa</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                </div><!--features_items-->

                <!--features_items-->

                <!--/category-tab-->

            </div>


            <div class="col-md-12">
                {{--                        <table class="table">--}}
                {{--                            <thead>--}}
                {{--                            <tr>--}}
                {{--                                <th scope="col">#</th>--}}
                {{--                                <th scope="col">Tên sản phẩm</th>--}}
                {{--                                <th scope="col">Giá</th>--}}
                {{--                                <th scope="col">Hình ảnh</th>--}}
                {{--                                <th scope="col">Danh mục</th>--}}
                {{--                                <th scope="col">Action</th>--}}
                {{--                            </tr>--}}
                {{--                            </thead>--}}
                {{--                            <tbody>--}}
                {{--                            @foreach($products as $productItem)--}}
                {{--                                <tr>--}}
                {{--                                    <th scope="row">{{ $productItem->id}}</th>--}}
                {{--                                    <td>{{ $productItem->name }}</td>--}}
                {{--                                    <td>{{ number_format($productItem->price) }}</td>--}}
                {{--                                    <td>--}}
                {{--                                        <img class="product_image_150_100" src="{{ $productItem->feature_image_path }}">--}}
                {{--                                    </td>--}}
                {{--                                    --}}{{--                                     Hàm optional() hoạt động khi Danh mục(Một) không có id mà Sản phẩm(Nhiều) trỏ tới--}}
                {{--                                    --}}{{--                                     Giúp tránh LỖI không tìm thấy id bên MỘT và vẫn trả về giá trị rỗng--}}
                {{--                                    <td>{{ optional($productItem->category)->name }}</td>--}}

                {{--                                    <td>--}}
                {{--                                        <a href="{{ route('products.edit',['id'=>$productItem->id]) }}"--}}
                {{--                                           class="btn btn-default">Sửa</a>--}}

                {{--                                        @can('product-delete')--}}
                {{--                                            <a data-url="{{ route('products.delete',['id'=>$productItem->id]) }}"--}}
                {{--                                               class="btn btn-danger action_delete">Xóa</a>--}}
                {{--                                        @endcan--}}
                {{--                                    </td>--}}
                {{--                                </tr>--}}
                {{--                            @endforeach--}}
                {{--                            </tbody>--}}
                {{--                        </table>--}}
            </div>
            {{--                    <div class="col-md-12">{{ $products->appends($_GET)->links() }}</div>--}}
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
