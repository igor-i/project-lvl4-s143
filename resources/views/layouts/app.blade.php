<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="{{ asset('/css/app.css') }}"  rel="stylesheet">

    <title>Page Analyzer - @yield('title')</title>
</head>

<body>
    <div class="container">
        <p>
            @yield('content')
        </p>
    </div>

<!-- Optional JavaScript -->
<script src="{{ asset('/js/app.js') }}"></script>

</body>
</html>
