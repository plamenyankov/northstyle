@extends('layouts.backend')
@section('title','Потребители')

@section('content')
    <a href="{{route($base . 'create')}}" class="btn btn-primary">Създай нов потребител</a>

	@if (count($products))
    <table class="table table-hover">
        <thead>
        <tr>
			<th>ID</th>
            <th>Име</th>
			<th>Цвят</th>
			<th>Цена</th>
            <th>Редактирай</th>
            <th>Изтрий</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
                <td><a href="{{route($base . 'edit',$product->id->value())}}">{{$product->id}}</a></td>
                <td>{{$product->name}}</td>
				<td>{{$product->attributes->color}}</td>
				<td>{{$product->attributes->price}}</td>
                <td><a href="{{route($base . 'edit',$product->id->value())}}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td>
                    <a href="{{route($base . 'confirm_delete', $product->id->value())}}">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
	
	{!! $paginate->render() !!}

	@else
		<div class="alert alert-info">Няма съществуващи продукти.</div>
	@endif
@endsection