<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') &mdash; news</title>

    <link rel="stylesheet" href="{{theme("css/backend.css")}}"/>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="nav-bar-header"><a href="/" class="navbar-brand">MMA</a></div>
        <ul class="nav navbar-nav">
            <li><a href="#">items</a></li>
            <li><a href="#">items</a></li>
            <li><a href="#">items</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><span class="navbar-text">Hello, Plamen</span></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>@yield('title')</h3>
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>