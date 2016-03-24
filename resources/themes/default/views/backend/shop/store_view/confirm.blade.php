@extends('layouts.backend')
@section('title','Потвърждение за изтриване на изглед')

@section('content')
    {!! Form::open([
		'method'=>'delete',
		'url'=> $formUrl
	]) !!}
    <div class="alert alert-danger">
        <strong>Внимание!</strong> Този изглед ще бъде изтрит. Това действие е крайно. Сигурни ли сте?
    </div>
    {!! Form::submit('Да, трий!',['class'=>'btn btn-danger']) !!}
    <a href="{{route('backend.shop.store.store_view.index', array('store_id' => $store->id->value()))}}" class="btn btn-success"><strong>Не</strong></a>
    {!! Form::close() !!}
@endsection