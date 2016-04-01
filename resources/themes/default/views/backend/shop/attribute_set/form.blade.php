@extends('layouts.backend')

@section('content')
<div class="row">
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">{{ $item->id->value()? 'Редактирай множество' : 'Създай ново множество' }}</h3>
			</div>
			<div class="panel-body">
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
						<label for="label">Етикет</label>
						{!! Form::text('label',null,['class'=>'form-control']) !!}
					</div>
				</fieldset>

				{!! Form::submit($submitLabel, ['class'=>'btn btn-primary']) !!}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Атрибути</h3>
			</div>
			<div class="panel-body">
				<a href="{{ $createAttributeUrl }}" class="">Добави</a>

				@if (count($item->attributes))
					<table class="table table-hover">
						<thead>
							<tr>
								<th>ID</th>
								<th>Име</th>
								<th>Действия</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($item->attributes as $attributeDO)
							<tr>
								<td>{{ $attributeDO->id->value() }}</td>
								<td>{{ $attributeDO->name }}</td>
								<td><a href="{{ $attributeDO->edit_url }}" class="view-attribute-link"><i class="">Виж</i></td>
							</tr>
							@endforeach
						</tbody>
					</table>
				@else
				<div class="alert alert-info">Към това множество няма добавени атрибути. Натиснете <a href="{{ $createAttributeUrl }}" class="">тук</a> за да добавите един.</div>
				@endif
			</div>
		</div>
	</div>
</div>
@endsection