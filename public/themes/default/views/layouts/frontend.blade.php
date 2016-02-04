<!doctype html>
<html lang="bg">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{theme('css/frontend.css')}}"/>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header"><a href="/" class="navbar-brand">Northstyle</a></div>
        <ul class="nav navbar-nav">
            @include('partials.navigation')
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">@yield('content')</div>
    </div>
</div>
</body>
</html>