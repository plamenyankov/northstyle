@extends('layouts.backend')
@section('title',$product->id->value()?$product->title:'Създай нов продукт')


@section('content')
    {!! Form::model($product,[
    'method'=>$product->id->value()?'put':'post',
    'route'=>$product->id->value()?[fr($base . 'update'),$product->id]:[fr($base . 'store')]
    ]) !!}
    <fieldset class="step1">
		<legend>Основни настройки</legend>
		<div class="form-group">
			{!! Form::label('title', 'Заглавие') !!}
			{!! Form::text('title',null,['class'=>'form-control']) !!}
		</div>
        {!! Form::label('attribute_set', 'Избери множество') !!}
        {!! Form::select('attribute_set',$attribute_sets,null,['class'=>'form-control']) !!}
    </fieldset>

    <fieldset class="step2 form-group">
		<legend>Допълнителни</legend>
    </fieldset>

    {!! Form::submit($product->id->value()?'Запази продукти':'Създай нов продукт',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@endsection