@extends('layouts.backend')
@section('title',$item->id->value()?$item->label:'Създай ново множество')

@section('content')
	<div class="row">
		<div class="col-md-3">
			{!! Form::model($item,[
				'method'=> $formMethod,
				'url'=> $formUrl
			]) !!}
			<fieldset class="step1 form-group">
				<div class="form-group">
					{!! Form::label('name', 'Име') !!}
					{!! Form::text('name',null,['class'=>'form-control']) !!}
				</div>

				<div class="form-group">
					<label for="label">Етикет <a href="#" title="Добави стойност" class="update-value-link" data-name="label"><i class="glyphicon glyphicon-plus"></i></a></label>
					{!! Form::text('label',null,['class'=>'form-control']) !!}
				</div>
			</fieldset>

			{!! Form::submit($submitLabel, ['class'=>'btn btn-primary']) !!}

			{!! Form::close() !!}
		</div>
	</div>
@endsection