<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    @include('admin.credentials.head')
</head>

<body>
    @include('admin.credentials.sidebar')
    @yield('content')
    @include('admin.credentials.footer')
    @include('admin.credentials.script')

    
</body>
</html>