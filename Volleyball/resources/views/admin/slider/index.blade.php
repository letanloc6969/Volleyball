@extends('layouts.admin')

@section('title')
    <title>Slider Index</title>
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
    @include('partials.content-header',['name'=>'Slider','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <a href="{{ route('sliders.create') }}" class="btn btn-success float-right">Add</a>
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Description</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sliders as $slider)
                                <tr>
                                    <th scope="row">{{ $slider->id}}</th>
                                    <td>{{ $slider->name }}</td>
                                    <td>{{ $slider->description }}</td>
                                    <td>
                                       <img class="image_slider_150_130" src="{{ $slider->image_path }}">
                                    </td>
                                    <td>
                                        <a href="{{ route('sliders.edit',['id'=>$slider->id]) }}" class="btn btn-default">Sửa</a>
                                        <a data-url="{{ route('sliders.delete',['id'=>$slider->id]) }}"
                                           class="btn btn-danger action_delete">Xóa</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="col-md-12">{{ $sliders->links() }}</div>


                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



