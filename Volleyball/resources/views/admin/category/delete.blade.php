
@extends('layouts.admin')

@section('title')
    <title>Xóa danh mục</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'category','key'=>'Delete'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form action="{{route('categories.deleted',['id'=>$category->id])}}" method="post">
                            @csrf
                            <h1>Bạn có muốn xóa danh mục này?</h1>

                            <div class="form-group">
                                <label>Tên danh mục</label>
                                <input type="text"
                                       class="form-control"
                                       value="{{ $category->name }}"
                                       name="name";
                                >
                            </div>

                            <div class="form-group">
                                <label >Danh mục cha</label>
                                <select class="form-control" name="parent_id" ">
                                <option value="0">Chọn danh mục cha</option>
                                {!! $htmlOption !!}
                                </select>
                            </div>

                            <button type="submit" class="btn btn-danger">Xóa</button>
                            <a href="#" class="btn btn-default">Không</a>
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



