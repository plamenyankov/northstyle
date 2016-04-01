<div class="object-values label-values">
	<ul class="store-view-list">
		@foreach ($storeViewList as $storeView)
		<?php $pkey = $attribute->name . '.' . $storeView->language->code; ?>
		<?php $fieldValue = ''; ?>
		<?php if (isset($product->values[$pkey])): ?>
		<?php $fieldValue = $product->values[$pkey]->value; ?>
		<?php endif; ?>
		<li class="{{ $storeView->name }}" data-key="{{ $attribute->name }}.{{ $storeView->language->code }}">
			<input type="hidden" name="values[{{ $pkey }}]" value="{{ $fieldValue }}" class="value-field" />
			<span class="title">Изглед "{{ $storeView->label }}"</span>
			<a href="#" class="action view-object-value-link" data-toggle="modal" data-target="#updateObjectValueModal"><i class="glyphicon glyphicon-file"></i></a>
			<a href="#" title="Добави стойност" class="action update-value-link" data-toggle="modal" data-target="#addObjectAttributeModal"><i class="glyphicon glyphicon-plus"></i></a>

			@if (isset($product->values_tree[$attribute->name]['values'][$storeView->language->code]['values']))
				<ul class="attributes-list">
				@foreach ($product->values_tree[$attribute->name]['values'][$storeView->language->code]['values'] as $attr_name => $subvalue)
					<li class="attributes-list-item attribute-{{ $attr_name }}" data-key="{{ $pkey }}.{{ $attr_name }}">
						<input type="hidden" name="values[{{ $pkey }}.{{ $attr_name }}]" value="" class="value-field attribute-value-field attribute-{{ $attr_name }}-value-field" />
						<span class="title">{{ $product->attribute_set->attributes[$attr_name]->label }}</span>
						<a href="#" class="action view-object-value-link" data-toggle="modal" data-target="#updateObjectValueModal"><i class="glyphicon glyphicon-file"></i></a>
						@if (isset($product->attribute_set->attributes[$attr_name]) && count($product->attribute_set->attributes[$attr_name]->options))
						<ul class="attribute-options-list">
							<?php $pkey = $pkey . '.' . $attr_name; ?>
							@foreach ($product->attribute_set->attributes[$attr_name]->options as $option)
							<?php $fieldValue = ''; ?>
							<?php if (isset($subvalue['values'][$option->name])): ?>
							<?php $fieldValue = $subvalue['values'][$option->name]['value']->value; ?>
							<?php endif; ?>
							<li class="attribute-options-list-item attribute-option-__name__" data-key="{{ $pkey }}.{{ $option->name }}">
								<input type="hidden" name="values[{{ $pkey }}.{{ $option->name }}]" value="{{ $fieldValue }}" class="value-field attribute-value-field attribute-option-value-field attribute-option-{{ $option->name }}-value-field" />
								<span class="title attribute-value attribute-color-value">{{ $option->label }}</span>
								<a href="#" class="action view-object-value-link" data-toggle="modal" data-target="#updateObjectValueModal"><i class="glyphicon glyphicon-file"></i></a>
								<a href="#" title="Добави стойност" class="action update-value-link" data-toggle="modal" data-target="#addObjectAttributeModal"><i class="glyphicon glyphicon-plus"></i></a>
							</li>
							@endforeach
						</ul>
						@endif
					</li>
				@endforeach
				</ul>
			@endif
		</li>
		@endforeach
	</ul>
</div>