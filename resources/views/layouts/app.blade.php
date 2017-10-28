<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link rel="stylesheet"
    @if (App::environment() === 'local')
        href="{{ asset('/css/app.css') }}"
    @else
        href="{{ secure_asset('/css/app.css') }}"
    @endif
    >
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"--}}
          {{--integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">--}}

    <title>Page Analyzer - @yield('title')</title>
</head>

<body>
<div class="container">
    <p>
        @yield('content')
    </p>
</div>

<!-- Optional JavaScript -->
<script
        @if (App::environment() === 'local')
        src="{{ asset('/js/app.js') }}"
        @else
        src="{{ secure_asset('/js/app.js') }}"
        @endif
></script>

</body>
</html>
