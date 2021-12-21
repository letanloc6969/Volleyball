@extends('layouts.admin')

@section('title')
    <title>Setting Index</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/setting/indexSetting/indexSetting.css') }}">
@endsection

@section('js')
    <script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
    <script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
    @include('partials.content-header',['name'=>'Setting','key'=>'List'])
    <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="btn-group float-right">
                            <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                                Add Setting
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu">
                                @can('setting-add')
                                <li><a href="{{ route('settings.create') . '?type=Text' }}">Text</a></li>
                                <li><a href="{{ route('settings.create') . '?type=Textarea' }}">Textarea</a></li>
                                @endcan
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên Slider</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            <tr>
                            @foreach($settings as $setting)
                                <tr>
                                    <th scope="row">{{ $setting->id }}</th>
                                    <td>{{ $setting->config_key }}</td>
                                    <td>{{ $setting->config_value }}</td>

                                    <td>
                                        @can('setting-edit')
                                        <a href="{{ route('settings.edit', ['id'=>$setting->id]) . '?type=' . $setting->type }}"
                                           class="btn btn-default">Sửa</a>
                                        @endcan
                                            @can('setting-add')
                                            <a data-url="{{ route('settings.delete', ['id'=>$setting->id])}}"
                                           class="btn btn-danger action_delete">Xóa</a>
                                                @endcan
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>

                        <div class="col-md-12">{{ $settings->links() }}</div>

                    </div>

                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection



