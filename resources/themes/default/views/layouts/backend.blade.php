<!doctype html>
<html lang="bg">
<head>
    <meta charset='UTF-8'>
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ theme("css/backend.css") }}" />
	<link rel="stylesheet" href="{{ theme("css/backend_new.css") }}" />
    <script src="{{theme('js/app.js')}}"></script>
</head>
<body>
	<div class="modals-section">
		@include('modals.update-object-value')

		@include('modals.add-object-attribute')

		@yield('modals')
	</div>

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
			<div class="nav-bar-header"><a href="/" class="navbar-brand">Northstyle</a></div>
			<ul class="nav navbar-nav">
				<li>
					<a class="dropdown-toggle" data-toggle="dropdown" href="{{route('backend.core.user.index')}}">Система <b class="caret"></b></a>
					<ul class="dropdown-menu multi-level">
						<li><a href="{{route('backend.core.user.index')}}">Потребители</a></li>
						<li><a href="{{route('backend.shop.store.index')}}">Магазини</a></li>
						<li><a href="{{route('backend.shop.store.index')}}">Настройки</a></li>
					</ul>
				</li>
				@if (isset($currentStore))
				<li>
					<a class="dropdown-toggle" data-toggle="dropdown" href="{{route('backend.shop.index')}}">Магазин <b class="caret"></b></a>
					<ul class="dropdown-menu multi-level">
						<li><a href="{{route('backend.shop.store.store_view.index', $currentStore->id->value())}}">Изгледи</a></li>
						<li><a href="{{route('backend.shop.store.attribute_set.index', $currentStore->id->value())}}">Атрибути - Множества</a></li>
						<li><a href="{{route('backend.shop.store.product.index', $currentStore->id->value())}}">Продукти</a></li>
					</ul>
				</li>
				@endif
				<li>
					<a class="dropdown-toggle" data-toggle="dropdown" href="{{route('backend.content.index')}}">Съдържание <b class="caret"></b></a>
					<ul class="dropdown-menu multi-level">
						<li><a href="{{route('backend.content.page.index')}}">Страници</a></li>
						<li><a href="{{route('backend.content.blog_post.index')}}">Блог Статии</a></li>
					</ul>
				</li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><span class="navbar-text">Здравей, {{$admin->name}}</span></li>
				<li><a href="{{lr('/auth/logout')}}">Изход</a></li>
			</ul>
		</div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="accessible-stores clearfix">
					<form class="pull-right" action="{{ route('backend.dashboard.set_store') }}">
						<select name="current_store" class="accessible-stores">
							@foreach ($accessibleStoresDropdownOptions as $id => $label)
							<option value="{{ $id }}" @if ($currentStore && $id == $currentStore->id->value()) selected @endif>{{ $label }}</option>
							@endforeach
						</select>
						<button type="submit">Go</button>
					</form>
				</div>

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