<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @css('admin/app.css')
@stack('css')
</head>
<body>
<div id="app">
    @yield('content')
</div>
@cdnJS('https://kit.fontawesome.com/43a92eac72.js')
@stack('js')
</body>
</html>
