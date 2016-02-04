<!doctype html>
<html lang="bg">
<head>
    <meta charset='UTF-8'>
    <title>@yield('title') &mdash; news</title>

    <link rel="stylesheet" href="{{theme("css/backend.css")}}"/>
    <script src="{{theme('js/all.js')}}"></script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="nav-bar-header"><a href="/" class="navbar-brand">Northstyle</a></div>
        <ul class="nav navbar-nav">
            {{--<li><a href="{{route('backend.dashboard')}}">Dashboard</a></li>--}}
            <li><a href="{{route('backend.users.index')}}">Потребители</a></li>
            <li><a href="{{route('backend.pages.index')}}">Страници</a></li>
            <li><a href="{{route('backend.blog.index')}}">Блог</a></li>
            <li><a href="{{route('backend.articles.index')}}">Артикали</a></li>
            <li><a href="{{route('backend.sofa.index')}}">Дивани</a></li>
            <li><a href="{{route('backend.category.index')}}">Категории</a></li>

        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><span class="navbar-text">Hello, {{$admin->name}}</span></li>
            <li><a href="{{lr('/auth/logout')}}">Logout</a></li>
        </ul>
    </div>
</nav>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>@yield('title')</h3>
            @if($errors->any())
                <div class="alert alert-danger">
                    <strong>Имате грешка!</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach

                    </ul>
                </div>
            @endif
            @if($status)
                <div class="alert alert-info">{{$status}}</div>
            @endif
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>