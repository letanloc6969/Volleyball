@extends('layouts.admin')

@section('title')
    <title>Edit User</title>
@endsection

@section('css')
    <link href="{{ asset('vendors/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{ asset('admins/user/add.css') }}" rel="stylesheet"/>

@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('admins/user/add.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header', ['name'=>'User','key'=>'Edit'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-6">
                        <form action="{{ route('users.update',['id'=>$user->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên User</label>
                                <input type="text"
                                       class="form-control "
                                       name="name"
                                       placeholder="Nhập tên"
                                       value="{{ $user->name }}">
                            </div>

                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"
                                       class="form-control "
                                       name="email"
                                       placeholder="Nhập email"
                                       value="{{ $user->email }}">
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password"
                                       class="form-control "
                                       name="password"
                                       placeholder="Nhập password"
                                >
                            </div>

                            {{-- foreach qua tất cả id của bảng Role nếu trùng với id của bảng trung gian Role_User thì selected
                                bởi $roleOfUser đã kết nối 2 bảng Role và User thông qua bảng trung gian trong
                             Laravel Helper contains(chứa đựng) --}}
                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_init" multiple>
                                    @foreach($roles as $role)
                                        <option {{ $roleOfUser->contains('id',$role->id)? 'selected' : '' }}
                                            value="{{ $role->id }}"> {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>

                            <button type="submit" class="btn btn-primary">Thêm User</button>
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



