@extends('layouts.admin')

@section('title')
    <title>Sửa Vai Trò</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/role/add/add.css') }}">

@endsection

{{-- Khi class"checkbox_wrapper" thực hiện sự kiện on(Click) thì prop('checked', $(this).prop('checked')) sẽ True
Sẽ tìm đến cha của class"card" nào có con là class"checkbox_children" để Checked
$(this).prop('checked') trả về giá trị true/false --}}
@section('js')
    <script src="{{ asset('admins/role/add/add.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'Role','key'=>'Add'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form action="{{ route('roles.update', ['id'=>$role->id])}}" method="post" enctype="multipart/form-data"
                          style="width: 100%">
                        <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Tên Vai Trò</label>
                                <input type="text"
                                       class="form-control "
                                       name="name"
                                       placeholder="Nhập tên Vai trò"
                                       value="{{ $role->name }}">
                            </div>

                            <div class="form-group">
                                <label>Mô tả vai trò</label>
                                <textarea name="display_name" class="form-control " rows="4">
                                    {{ $role->display_name }}
                                </textarea>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label>
                                <input type="checkbox" class="checkall">
                            </label>
                            Chọn tất cả
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                {{-- Lấy ra tên của những thằng cha trong bảng Permission(Quyền hạn)--}}
                                @foreach($permissionsParent as $permissionsParentItem)
                                    <div class="card border-primary mb-3 col-md-12">
                                        <div class="card-header">
                                            <label>
                                                <input value="" type="checkbox" class="checkbox_wrapper">
                                            </label>
                                            Module {{ $permissionsParentItem->name }}
                                        </div>

                                        <div class="row">
                                            {{-- Trỏ đến phương thức trung gian ở Model Permission để lấy name của các con của nó
                                                cha và con đều ở cùng 1 table nên không có bảng trung gian
                                            --}}

                                            <!-- Phương thức contains dùng để check true/false
                                                                        Ta lấy ra id của PermissionChecked để so với id PermissionChildren
                                                                        sau mỗi vòng lặp nếu giống id thì sẽ Checked vào input-->
                                            @foreach($permissionsParentItem->permissionsChildrent as $permissionsChildrentItem)
                                                <div class="card-body text-primary col-md-3">
                                                    <h5 class="card-title">
                                                        <label>
                                                            <input name="permission_id[]" class="checkbox_children"
                                                                   {{ $permissionsChecked->contains('id',$permissionsChildrentItem->id) ? 'checked' : '' }}
                                                                   value="{{ $permissionsChildrentItem->id }}"
                                                                   type="checkbox">
                                                        </label>
                                                        {{ $permissionsChildrentItem->name }}
                                                    </h5>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Sửa Vai Trò</button>
                    </form>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



