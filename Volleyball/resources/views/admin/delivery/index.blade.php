@extends('layouts.admin')

@section('title')
    <title>Delivery Index</title>
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
    @include('partials.content-header',['name'=>'Delivery','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Chọn tỉnh/thành phố</label>
                                <select name="city" id="city" class="form-control choose city">
                                    <option>--Chọn tỉnh/thành phố--</option>
                                    @foreach($city as $thanhpho)
                                        <option value="{{$thanhpho->matp}}">{{ $thanhpho->name_city }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn quận huyện</label>
                                <select name="province" id="province" class="form-control province choose">
                                    <option>--Chọn tỉnh/thành phố--</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn xã phường</label>
                                <select name="wards" id="wards" class="form-control wards">
                                    <option>--Chọn tỉnh/thành phố--</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Phí vận chuyển</label>
                                <input type="text"
                                       class="form-control fee_ship"
                                       name="fee_ship"
                                >
                            </div>

                            <button type="button" class="btn btn-primary add_delivery">Thêm phí vận chuyển</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
            <br>
            <div id="load_delivery">
                <!-- NỘI DUNG AJAX VÀO ĐÂY!!! -->
            </div>
        </div>
        <!-- /.content -->

    </div>

    <!-- /.content-wrapper -->
@endsection



