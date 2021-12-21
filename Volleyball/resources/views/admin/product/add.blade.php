@extends('layouts.admin')

@section('title')
    <title>Thêm sản phẩm</title>
@endsection

@section('css')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/add/add.css')}}" rel="stylesheet"/>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Product','key'=>'Add'])
    <!-- /.content-header -->

        <!-- Thẻ div chứa Validate dùng để bắt lỗi khi Submit Form -->

    <!--   <div class="col-md-12">
            @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
@foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
                        @endforeach
            </ul>
        </div>
@endif
        </div>
    -->

        <!-- Main content -->
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Nhập tên sản phẩm"
                                       value="{{ old('name') }}">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text"
                                       class="form-control @error('price') is-invalid @enderror"
                                       name="price"
                                       placeholder="Nhập giá sản phẩm"
                                       value="{{ old('price') }}">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh đại diện của sản phẩm</label>
                                <input type="file"
                                       class="form-control-file"
                                       name="feature_image_path" ;
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh chi tiết của sản phẩm</label>
                                <input type="file"
                                       multiple
                                       class="form-control-file"
                                       name="image_path[]" ;
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror"
                                        name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
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
                                    @endforeach
                                    @foreach($product_size as $item)
                                        <label>
                                            <input name="quantity" type="text">
                                            {{ $item->quantity_product }}
                                        </label>
                                        @endforeach
                                </div>

                                <label>Nhập Size cho quần áo</label>
                                <div class="checkbox">
                                    @foreach($clothes as $clothesSize)
                                        <label>
                                            <input name="clothes_size[]" type="checkbox" value="{{ $clothesSize->id }}" >
                                            {{ $clothesSize->size }}
                                        </label>
                                        @foreach($product_size as $item)
                                            <label>
                                                <input name="quantity" type="text">
                                                {{ $item->quantity_product }}
                                            </label>
                                        @endforeach
                                    @endforeach

                                </div>
                            </div>
                            <div class="form-group">
                            <input name="view_count" type="hidden" value="1">
                            </div>

                            <div class="form-group">
                            <lavel>Số lượng</lavel>
                            <input name="quantity" type="text">
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->

                <div class="col-md-12">
                    <div class="form-group">
                        <label>Nhập nội dung</label>
                        <textarea class="form-control tinymce_editor_init @error('contents') is-invalid @enderror"
                                  name="contents" rows="15">
                            {{ old('contents') }}
                        </textarea>
                    </div>
                    @error('contents')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
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

