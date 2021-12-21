@extends('layouts.admin')

@section('title')
    <title>Sửa sản phẩm</title>
@endsection

@section('css')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Product','key'=>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <form action="{{ route('products.update',['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text"
                                       class="form-control"
                                       name="name"
                                       placeholder="Nhập tên sản phẩm"
                                       value="{{ $product->name }}" ;
                                >
                            </div>

                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text"
                                       class="form-control"
                                       name="price" ;
                                       placeholder="Nhập giá sản phẩm"
                                       value="{{ $product->price }}" ;
                                >
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh đại diện của sản phẩm</label>
                                <input type="file"
                                       class="form-control-file"
                                       name="feature_image_path"
                                >
                                <div class="col-md-12 image_product_container">
                                    <div class="row">
                                        <img class="image_product_edit" src="{{ $product->feature_image_path }}" alt="">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label>Hình ảnh chi tiết của sản phẩm</label>
                                <input type="file"
                                       multiple
                                       class="form-control-file"
                                       name="image_path[]" ;
                                >
                                <div class="col-md-12 container_image_detail ">
                                    <div class="row">
                                        @foreach($product->productImage as $productItemImage)
                                            <div class="col-md-3">
                                                <img class="image_detail_product"
                                                     src="{{$productItemImage->image_path}}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagItem)
                                        <option value="{{$tagItem->name}}" selected> {{$tagItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Nhập Size cho giày dép</label>
                                <div class="checkbox">
                                    @foreach($shoes as $shoesSize)
                                        <label>
                                            <input name="shoes_size[]" type="checkbox" value="{{ $shoesSize->id }}">
                                            {{ $shoesSize->size }}
                                        </label>
                                        @foreach($product_size as $item)
                                            <label>
                                                <input name="quantity" type="text" value="{{ $item->quantity_product }}">
                                            </label>
                                        @endforeach
                                    @endforeach
                                </div>

                                <label>Nhập Size cho quần áo</label>
                                <div class="checkbox">
                                    @foreach($clothes as $clothesSize)
                                        <label>
                                            <input name="clothes_size[]" type="checkbox" value="{{ $clothesSize->id }}" >
                                            {{ $clothesSize->size }}
                                            @foreach($product_size as $item)
                                                <label>
                                                    <input name="quantity" type="text" value="{{ $item->quantity_product }}">
                                                </label>
                                            @endforeach
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Số lượng</label>
                                <input name="quantity" type="text">
                            </div>

                        </div>
                        <!-- /.row -->
                    </div><!-- /.container-fluid -->

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Nhập nội dung</label>
                            <textarea class="form-control tinymce_editor_init" name="contents"
                                      rows="15">{{ $product->content }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Sửa sản phẩm</button>
                    </div>

                </div>
        </form>

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="https://cdn.tiny.cloud/1/pkadbrxuu6bvfq9c8mkv9uqzne3sk4zamzsk9rnr9kj8z0wd/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection

