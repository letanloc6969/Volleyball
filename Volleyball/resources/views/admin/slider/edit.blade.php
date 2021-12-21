@extends('layouts.admin')

@section('title')
    <title>Sua Slider</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/slider/add/add.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Slider','key'=>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form action="{{ route('sliders.update',['id'=>$slider->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên Slider</label>
                                <input type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name"
                                       placeholder="Nhập tên Slider"
                                       value="{{ $slider->name }}"
                                       ">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Nội dung Slider</label>
                                <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">
                                    {{ $slider->description }}
                                </textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Hình ảnh Slider</label>
                                <input type="file"
                                       class="form-control @error('image_path') is-invalid @enderror"
                                       name="image_path" ;
                                >

                                <div class="col-md-4 ">
                                    <div class="row">
                                        <img class="image_slider" src="{{$slider->image_path}}">
                                    </div>
                                </div>

                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Sua Slider</button>
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



