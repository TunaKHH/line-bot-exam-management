<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('css/adminlte.css') }}">
    @yield('css')
</head>

<body class="hold-transition @yield('body-class')">
    <div class="wrapper">
        @yield('content')
    </div>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/adminlte.js') }}"></script>
    @yield('js')
</body>

</html>
