@extends('layouts.backend')
@section('title',$item->id->value()?$item->label:'Създай нов магазин')

@section('content')
    {!! Form::model($item,[
    'method'=>$item->id->value()?'put':'post',
    'route'=>$item->id->value()?[fr($base . 'update'),$item->id]:[fr($base . 'store')]
    ]) !!}
    <fieldset class="step1 form-group">
		<div class="form-group">
			{!! Form::label('label', 'Име') !!}
			{!! Form::text('label',null,['class'=>'form-control']) !!}
		</div>
    </fieldset>

    {!! Form::submit($item->id->value()?'Запази магазин':'Създай нов магазин',['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@endsection