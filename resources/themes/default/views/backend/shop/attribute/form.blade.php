@extends('layouts.backend')

@section('content')

<div class="js-templates hide">
	<table class="table table-bordered table-striped attribute-options-table">
		<thead>
			<tr>
				<th>Име</th>
				<th>Етикет "Всички"</th>
				@foreach ($store->views as $viewDO)
				<th>Етикет "{{ $viewDO->label }}"</th>
				@endforeach
				<th>Действия</th>
			</tr>
		</thead>
		<tbody>
		</tbody>
	</table>

	<table>
		<tr class="attribute-option-row">
			<td><input type="text" name="options[__id__][name]" value="" /></td>
			<td><input type="text" name="options[__id__][label]" value="" /></td>
			@foreach ($store->views as $viewDO)
			<td>
				<input type="hidden" name="options[__id__][values][label.{{$viewDO->name }}][name]" value="label.{{$viewDO->name }}" />
				<input type="text" name="options[__id__][values][label.{{$viewDO->name }}][value]" value="" />
			</td>
			@endforeach
			<td>
				<a href="#" class="remove-option-link"><i class="glyphicon glyphicon-remove"></i></a>
			</td>
		</tr>
	</table>
</div>

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">{{ $item->id->value()? 'Редактирай' : 'Създай нов' }}</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				{!! Form::model($item,[
					'method'=> $formMethod,
					'url'=> $formUrl,
					'class' => ''
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
					<div class="form-group">
						<label for="label">Опции</label>
						<a href="#" class="add-option-link"><i class="glyphicon glyphicon-plus"></i>Добави опция</a>
						@if (count($item->options))
						<table class="table table-bordered table-striped attribute-options-table">
							<thead>
								<tr>
									<th>Име</th>
									<th>Етикет "Всички"</th>
									@foreach ($store->views as $viewDO)
									<th>Етикет "{{ $viewDO->label }}"</th>
									@endforeach
									<th>Действия</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($item->options as $option)
								<tr>
									<td><input type="text" name="options[{{ $option->id->value() }}][name]" value="{{ $option->name }}" /></td>
									<td><input type="text" name="options[{{ $option->id->value() }}][label]" value="{{ $option->label }}" /></td>
									@foreach ($store->views as $viewDO)
									<td>
										<input type="hidden" name="options[{{ $option->id->value() }}][values][label.{{$viewDO->name }}][name]" value="label.{{$viewDO->name }}" />
										<input type="text" name="options[{{ $option->id->value() }}][values][label.{{$viewDO->name }}][value]" value="@if (isset($option->values['label.' . $viewDO->name])){{ $option->values['label.' . $viewDO->name]->value }} @endif" />
									</td>
									@endforeach
									<td>
										<a href="#" class="remove-option-link"><i class="glyphicon glyphicon-remove"></i></a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
						@endif
					</div>
					<div class="form-group">
						<label for="label">Проверки</label>
						<div class="alert alert-info">За момента не може да се добавят проверки.</div>
						<!--
						<table class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Тип</th>
									<th>Настройки</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>Валиден Email</td>
									<td>N/A</td>
								</tr>
								<tr>
									<td>Дължина на текст</td>
									<td>
										<dl class="validator-settings">
											<dt>минимум: </dt>
											<dd>10 символа</dd>
											<dt>максимум: </dt>
											<dd>50 символа</dd>
										</dl>
									</td>
								</tr>
							</tbody>
						</table>
						-->
					</div>
					<div class="form-group">
						<label for="label">Представяне</label>
						{!! Form::select('representation_id', $attributeRepresentationsDropdownOptions, null, ['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						<label for="label">
							<a href="#" data-toggle="tooltip" data-placement="top" title="Default tooltip"><i class="glyphicon glyphicon-question-sign"></i></a>
							<span class="inner">Стойност по подразбиране</span>
						</label>
						{!! Form::text('default_value', null,['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						<label for="label"><a href="#" data-toggle="tooltip" data-placement="top" title="Default tooltip"><i class="glyphicon glyphicon-question-sign"></i></a> Максимален брой стойности</label>
						{!! Form::text('max_values_count',1,['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						<label for="label"><a href="#" data-toggle="tooltip" data-placement="top" title="Default tooltip"><i class="glyphicon glyphicon-question-sign"></i></a> Задължителен при създаване</label>
						{!! Form::checkbox('required_create',null,['class'=>'form-control']) !!}
					</div>
					<div class="form-group">
						<label for="label"> <a href="#" data-toggle="tooltip" data-placement="top" title="Default tooltip"><i class="glyphicon glyphicon-question-sign"></i></a> Задължителен при поръчка</label>
						{!! Form::checkbox('required_order',null,['class'=>'form-control']) !!}
					</div>
				</fieldset>

				{!! Form::submit($submitLabel, ['class'=>'btn btn-primary']) !!}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<script>
	$.fn.outerHTML = function() {
		// IE, Chrome & Safari will comply with the non-standard outerHTML, all others (FF) will have a fall-back for cloning
		return (!this.length) ? this : (this[0].outerHTML || (
		  function(el){
			  var div = document.createElement('div');
			  div.appendChild(el.cloneNode(true));
			  var contents = div.innerHTML;
			  div = null;
			  return contents;
		})(this[0]));
	}

	function guid() {
		function s4() {
			return Math.floor((1 + Math.random()) * 0x10000)
			  .toString(16)
			  .substring(1);
		}
		return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
	}

	function setupAttributeOptionsTableHandlers($table) {
		$table.on('click', '.remove-option-link', function(event) {
			event.preventDefault();

			$table = $(this).closest('table');

			$(this).parents('tr').remove();

			if (!$table.find('tbody tr').length) {
				$table.remove();
			}
		});
	}

	$(function() {
		setupAttributeOptionsTableHandlers($('.attribute-options-table'));

		$('.add-option-link').on('click', function(event) {
			event.preventDefault();

			var $formGroup = $(this).closest('.form-group');

			if (!$formGroup.children('.attribute-options-table').length) {
				var tableHtml = $('.js-templates .attribute-options-table').outerHTML();
				$formGroup.append(tableHtml);

				setupAttributeOptionsTableHandlers($formGroup.find('.attribute-options-table'));
			}

			var templateHTML = $('.js-templates .attribute-option-row').outerHTML();

			var optionId = guid();

			templateHTML = templateHTML.replace(/__id__/gi, optionId);

			$formGroup.find('.attribute-options-table').find('tbody').append(templateHTML);
		});
	});
</script>

@endsection