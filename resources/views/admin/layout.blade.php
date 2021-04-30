<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <title>Alan</title>
</head>
<body>
@include('admin.navigation')
<div class="container">
    @include('messages')
    <h1 class = "mt-5 ml-n3">@yield('header')</h1>
    @yield('content')
</div>
</body>
</html>
