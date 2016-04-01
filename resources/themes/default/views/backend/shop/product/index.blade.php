@extends('layouts.backend')

@section('title','Продукти')

@section('modals')
	@parent 
	@include('modals.choose-attribute-set', array('createProductUrl' => $createProductUrl, 'attribute_sets' => $store->attribute_sets))
@endsection

@section('content')
    <a href="#" data-href="{{route($base . 'create', $store->id->value())}}" class="btn btn-primary" data-toggle="modal" data-target="#chooseAttributeSetModal">Създай нов продукт</a>

	@if (count($items))
    <table class="table table-hover">
        <thead>
        <tr>
			<th>ID</th>
			<th>Множество атрибути</th>
            <th>Редактирай</th>
            <th>Изтрий</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td><a href="{{route($base . 'edit',$item->id->value())}}">{{ $item->id }}</a></td>
				<td>{{ $item->attribute_set->label }}</td>
                <td><a href="{{route($base . 'edit', array('store_id' => $store->id->value(), 'attribute_set_id' => $item->id->value()))}}">
                        <span class="glyphicon glyphicon-edit"></span>
                    </a></td>
                <td>
                    <a href="{{route($base . 'confirm_delete', array('store_id' => $store->id->value(), 'attribute_set_id' => $item->id->value()))}}">
                        <span class="glyphicon glyphicon-remove"></span>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

	{!! $paginate->render() !!}

	@else
		<div class="alert alert-info">Нямате съществуващи продукти.</div>
	@endif
@endsection