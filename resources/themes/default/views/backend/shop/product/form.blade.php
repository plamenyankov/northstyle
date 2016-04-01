@extends('layouts.backend')

@section('content')

<div class="js-templates hide">
	{!! Form::select('attribute_id', $attributesDropdownOptions, 0, array('class' => 'attribute-id-select')) !!}
	<ul>
		<li class="attributes-list-item attribute-__name__" data-key="__pkey__.__key__">
			<input type="hidden" name="values[__pkey__.__name__]" value="" class="value-field attribute-value-field attribute-__name__-value-field" />
			<span class="title">__label__</span>
			<a href="#" class="action view-object-value-link" data-toggle="modal" data-target="#updateObjectValueModal"><i class="glyphicon glyphicon-file"></i></a>
		</li>

		<li class="attribute-options-list-item attribute-option-__name__" data-key="__pkey__.__key__">
			<input type="hidden" name="values[__pkey__.__name__]" value="" class="value-field attribute-value-field attribute-option-value-field attribute-option-__name__-value-field" />
			<span class="title attribute-value attribute-color-value">__label__</span>
			<a href="#" class="action view-object-value-link" data-toggle="modal" data-target="#updateObjectValueModal"><i class="glyphicon glyphicon-file"></i></a>
			<a href="#" title="Добави стойност" class="action update-value-link" data-toggle="modal" data-target="#addObjectAttributeModal"><i class="glyphicon glyphicon-plus"></i></a>
		</li>

		<li class="attribute-options-all-list-item attribute-option-all" data-key="__pkey__">
			<input type="hidden" name="values[__pkey__]" value="" class="value-field attribute-value-field attribute-option-value-field attribute-option-all-value-field" />
			<span class="title attribute-value attribute-color-value">Всички</span>
			<a href="#" class="action view-object-value-link" data-toggle="modal" data-target="#updateObjectValueModal"><i class="glyphicon glyphicon-file"></i></a>
			<a href="#" title="Добави стойност" class="action update-value-link" data-toggle="modal" data-target="#addObjectAttributeModal"><i class="glyphicon glyphicon-plus"></i></a>
		</li>
	</ul>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">{{ $item->id->value()? 'Редактирай продукт' : 'Създай нов продукт' }}</h3>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				{!! Form::model($item,[
					'method'=> $formMethod,
					'url'=> $formUrl
				]) !!}
				<fieldset class="step1 form-group">
					@foreach ($attributeSet->attributes as $attribute)
					<div class="form-group">
						<label for="label">{{ $attribute->label }}</label>
						@include('partials.attribute-value', array('attribute' => $attribute, 'product' => $item))

						@include('partials.object-values-tree', array('store' => $store, 'attribute' => $attribute, 'product' => $item))
					</div>
					@endforeach
				</fieldset>

				{!! Form::submit($submitLabel, ['class'=>'btn btn-primary']) !!}

				{!! Form::close() !!}
			</div>
		</div>
	</div>
</div>

<script>
	var apiRequests = {
		'baseUrl': '/bg/api/v1',
		'getAttributeById': function(attribute_id) {
			var data = {};

			data.url = this.baseUrl + '/attribute/' + attribute_id + '?client=NorthstyleDashboard';

			return data;
		}
	};

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

	function generateValueKey($sender) {
		var keys = [];

		$sender.parents('.value-field').each(function(index, field) {
			keys.push(field.name);
		});

		return keys.join('.');
	}

	function handleUpdateObjectValueFormSubmit(event) {
		event.preventDefault();

		var $sender = event.data.sender;
		var $popup = event.data.popup;
		var $form = $(this);

		var $valueField = $sender.closest('li').children('.value-field');

		$valueField.val($form.find('.attribute-representation').val());

		$popup.modal('hide');
	};

	function handleAddObjectAttributeFormSubmit(event) {
		event.preventDefault();

		var $sender = event.data.sender;
		var $popup = event.data.popup;
		var $form = $(this);

		var attributeId = $form.find('.attribute-id-select').val();

		$.ajax(apiRequests.getAttributeById(attributeId)).done(function(response) {
			var attribute = response.items[0];

			var attributeListItemHTML = $('.js-templates .attributes-list-item').outerHTML();
			var attributeOptionListItemHTML = $('.js-templates .attribute-options-list-item').outerHTML();
			var attributeOptionAllListItemHTML = $('.js-templates .attribute-options-all-list-item').outerHTML();

			attributeListItemHTML = attributeListItemHTML.replace(/__name__/ig, attribute.name);
			attributeListItemHTML = attributeListItemHTML.replace(/__label__/ig, attribute.label);
			attributeListItemHTML = attributeListItemHTML.replace(/__pkey__/ig, $sender.attr('data-key'));
			attributeListItemHTML = attributeListItemHTML.replace(/__key__/ig, attribute.name);

			if (!$sender.find('.attributes-list').length) {
				$sender.append('<ul class="attributes-list"></ul>');
			}

			var $attributesList = $sender.find('.attributes-list').append(attributeListItemHTML);

			// this would be the newly appended list item
			var $appended = $attributesList.find('li.attribute-' + attribute.name);

			if (attribute.options) {
				if (!$appended.find('.attribute-options-list').length) {
					$appended.append('<ul class="attribute-options-list"></ul>');
				}

				var $attributeOptionsList = $appended.find('.attribute-options-list');
				attributeOptionAllListItemHTML = attributeOptionAllListItemHTML.replace(/__pkey__/ig, $appended.attr('data-key'));

				$attributeOptionsList.append(attributeOptionAllListItemHTML);

				$(attribute.options).each(function(index, option) {
					var html = attributeOptionListItemHTML;

					html = html.replace(/__name__/ig, option.name);
					html = html.replace(/__label__/ig, option.label);
					html = html.replace(/__pkey__/ig, $appended.attr('data-key'));
					html = html.replace(/__key__/ig, option.name);

					$attributeOptionsList.append(html);
				});
			}

			$popup.modal('hide');
		});
	}

	$(function() {
		$("#updateObjectValueModal").on('shown.bs.modal', function(event) {
			var $popup = $(event.currentTarget);
			var $sender = $(event.relatedTarget);

			$form = $popup.find('.update-object-value-form');

			$form.find('.attribute-representation-container').html('');
			$form.find('.attribute-representation-container').append($sender.closest('.form-group').children('.attribute-representation').clone()[0]);

			$form.on('submit', {popup: $popup, sender: $sender}, handleUpdateObjectValueFormSubmit);
		});

		$("#updateObjectValueModal").on('hide.bs.modal', function(event) {
			var $popup = $(event.currentTarget);

			var $form = $popup.find('.update-object-value-form');

			$form.off('submit', handleUpdateObjectValueFormSubmit);
		});

		$("#addObjectAttributeModal").on('shown.bs.modal', function(event) {
			var $popup = $(event.currentTarget);
			var $sender = $(event.relatedTarget).closest('li');

			var $form = $popup.find('.add-object-attribute-form');
			$form.find('.attribute-select').html($('.js-templates .attribute-id-select').outerHTML());

			$form.on('submit', {popup: $popup, sender: $sender}, handleAddObjectAttributeFormSubmit);
		});

		$("#addObjectAttributeModal").on('hide.bs.modal', function(event) {
			var $popup = $(event.currentTarget);

			var $form = $popup.find('.add-object-attribute-form');
			$form.off('submit', handleAddObjectAttributeFormSubmit);
		});
	});
</script>
@endsection