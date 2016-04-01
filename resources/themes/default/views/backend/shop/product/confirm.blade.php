@extends('layouts.backend')
@section('title','Потвърждение за изтриване на продукт')

@section('content')
    {!! Form::open([
		'method'=>'delete',
		'url'=> $formUrl
	]) !!}
    <div class="alert alert-danger">
        <strong>Внимание!</strong> Този продукт ще бъде изтрит. Това действие е крайно. Сигурни ли сте?
    </div>
    {!! Form::submit('Да, трий!',['class'=>'btn btn-danger']) !!}
    <a href="{{$indexUrl}}" class="btn btn-success"><strong>Не</strong></a>
    {!! Form::close() !!}
@endsection