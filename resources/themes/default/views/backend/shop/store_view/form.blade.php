@extends('layouts.backend')
@section('title',$item->id->value()?$item->label:'Създай нов изглед')

@section('content')
    {!! Form::model($item,[
		'method'=> $formMethod,
		'url'=> $formUrl
    ]) !!}
    <fieldset class="step1 form-group">
		<div class="form-group">
			{!! Form::label('label', 'Име') !!}
			{!! Form::text('label',null,['class'=>'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('language_code', 'Език') !!}
			{!! Form::select('language_code', $languagesOptions, $item->language->code, ['class'=>'form-control']) !!}
		</div>
    </fieldset>

    {!! Form::submit($submitLabel, ['class'=>'btn btn-primary']) !!}

    {!! Form::close() !!}
@endsection