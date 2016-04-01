@extends('layouts.backend')
@section('title','Потвърждение за изтриване на атрибут')

@section('content')
    {!! Form::open([
		'method'=>'delete',
		'url'=> $formUrl
	]) !!}
    <div class="alert alert-danger">
        <strong>Внимание!</strong> Този атрибут ще бъде изтрит. Това действие е крайно. Сигурни ли сте?
    </div>
    {!! Form::submit('Да, трий!',['class'=>'btn btn-danger']) !!}
    <a href="{{route('backend.shop.store.attribute_set.edit', array('store_id' => $store->id->value(), 'attribute_set_id' => $attributeSet->id->value()))}}" class="btn btn-success"><strong>Не</strong></a>
    {!! Form::close() !!}
@endsection