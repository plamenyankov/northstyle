@extends('layouts.backend')
@section('title','Атрибути')

@section('content')
    <a href="{{route($base . 'create', $store->id->value())}}" class="btn btn-primary">Създай нов атрибут</a>

	@if (count($items))
    <table class="table table-hover">
        <thead>
        <tr>
			<th>ID</th>
            <th>Име</th>
			<th>Етикет</th>
            <th>Редактирай</th>
            <th>Изтрий</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td><a href="{{route($base . 'edit',$item->id->value())}}">{{$item->id}}</a></td>
				<td>{{$item->name}}</td>
                <td>{{$item->label}}</td>
                <td><a href="{{route($base . 'edit', array(
					'store_id' => $store->id->value(),
					'attribute_set_id' => $attributeSet->id->value(),
					'attribute_id' => $item->id->value()
				))}}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td>
                    <a href="{{route($base . 'confirm_delete', array('store_id' => $store->id->value(), 'attribute_set_id' => $attributeSet->id->value(), 'attribute_id' => $item->id->value()))}}">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

	{!! $paginate->render() !!}

	@else
		<div class="alert alert-info">Нямате съществуващи атрибути.</div>
	@endif
@endsection