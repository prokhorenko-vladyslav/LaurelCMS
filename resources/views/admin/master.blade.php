<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @cdnCss('https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i&display=swap&subset=cyrillic')
    @css('admin/app.css')
@stack('css')
</head>
<body>
<div id="app">
    @yield('content')
</div>
@cdnJS('https://kit.fontawesome.com/43a92eac72.js')
@cdnJS('https://code.jquery.com/jquery-3.2.1.min.js')
@cdnJS('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js')
@cdnJS('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js')
@stack('js')
<script>
    document.write('<script src="http://' + (location.host || 'localhost').split(':')[0] +
        ':35729/livereload.js?snipver=1"></' + 'script>')
</script>
</body>
</html>
