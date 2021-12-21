@extends('layouts.admin')

@section('title')
    <title>Danh mục sản phẩm</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'Index','key'=>'list'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('category-add')
                            <a href="{{route('categories.create')}}" class="btn btn-success float-right">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{ $category->id}}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        @can('category-edit')
                                            <a href="{{route('categories.edit',['id'=>$category->id])}}"
                                               class="btn btn-default">Sửa</a>
                                        @endcan

                                        @can('category-delete')
                                            <a href="{{route('categories.delete',['id'=>$category->id])}}"
                                               class="btn btn-danger">Xóa</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>

                        <div class="col-md-12">{{ $categories->links() }}</div>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



