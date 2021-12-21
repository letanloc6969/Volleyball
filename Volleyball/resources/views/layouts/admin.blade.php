<!DOCTYPE html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">


@yield('title')

<!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    @yield('css')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    @include('partials.header')

    @include('partials.sidebar')

    @yield('content')

    @include('partials.footer')
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>
<!-- jQuery -->
<script src="//code.jquery.com/jquery.js"></script>
<!-- DataTables -->
<script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<!-- App scripts -->

<script type="text/javascript">
    $(document).ready(function () {
        $('.choose').on('change', function () {
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if (action == 'city') {
                result = 'province';
            } else {
                result = 'wards';
            }
            $.ajax({
                url: '{{route('delivery.add')}}',
                method: 'POST',
                data: {action: action, ma_id: ma_id, _token: _token},
                success: function (data) {
                    $('#' + result).html(data);
                }
            });
        });

        $('.add_delivery').click(function () {
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{route('delivery.store')}}',
                method: 'POST',
                data: {city: city, province: province, wards: wards, fee_ship: fee_ship, _token: _token},
                success: function (data) {
                    fetch_delivery();
                }
            });
        });

        fetch_delivery();
        function fetch_delivery() {
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{route('delivery.feeship')}}',
                method: 'POST',
                data: {_token:_token},
                success: function (data) {
                    $('#load_delivery').html(data);
                }
            });
        }

        // on.('blur') có tác dụng sau khi sửa nội dung thì nhấp chuột vào 1 nơi bất kì sẽ tự động lưu nội dung lại
        // blur thì không cần gửi _token
        // data: dựa vào feeship_id để chỉnh sửa giá trị trong input
        // data sẽ được gửi đến Controller để cập nhật vào CSDL
        $(document).on('blur', '.fee_feeship_edit', function () {
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: '{{route('delivery.update')}}',
                method: 'POST',
                data: {feeship_id: feeship_id, fee_value: fee_value,_token:_token},
                success: function (data) {
                    fetch_delivery();
                }
            });

        });

    })
</script>
@stack('scripts')
@yield('js')
</body>
</html>
