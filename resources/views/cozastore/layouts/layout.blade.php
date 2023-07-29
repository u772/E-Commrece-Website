<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="title" content="@yield('meta_title')">
    <meta name="keywords" content="@yield('meta_keywords')">
    <title>@yield('meta_title')</title>
    @include('cozastore.credentials.header')
</head>

<body>
    @include('cozastore.credentials.navbar')
    @yield('content')

    @include('cozastore.credentials.footer')
    @include('cozastore.credentials.script')
</body>
</html>
