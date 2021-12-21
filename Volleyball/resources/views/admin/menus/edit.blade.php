@extends('layouts.admin')

@section('title')
    <title>Sửa Menu</title>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Menu','key'=>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form action="{{ route('menus.update',['id'=>$menuFollowIdEdit->id]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Tên Menu</label>
                                <input type="text"
                                       class="form-control"
                                       name="name" ;
                                       value="{{ $menuFollowIdEdit->name }}"
                                >
                            </div>

                            <div class="form-group">
                                <label>Chọn Menu cha</label>
                                <select class="form-control" name="parent_id">
                                    <option value="0">Chọn danh mục cha</option>
                                    {!! $optionSelect !!}
                                </select>
                            </div>


                            <button type="submit" class="btn btn-primary">Edit Menu</button>
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



