@extends('layouts.admin')

@section('title')
    <title>User Index</title>
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
    @include('partials.content-header',['name'=>'User','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @can('user-add')
                            <a href="{{ route('users.create') }}" class="btn btn-success float-right">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên User</th>
                                <th scope="col">Email</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <th scope="row">{{ $user->id}}</th>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @can('user-edit')
                                            <a href="{{ route('users.edit',['id'=>$user->id]) }}"
                                               class="btn btn-default">Sửa</a>
                                        @endcan
                                        @can('user-delete')
                                            <a data-url="{{ route('users.delete', ['id'=>$user->id]) }}"
                                               class="btn btn-danger action_delete">Xóa</a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="col-md-12">{{ $users->links() }}</div>
                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



