<?php $className = 'attribute-representation attribute-' . $attribute->name . '-representation'; ?>
<?php $name = 'values[' . $attribute->name . ']'; ?>

<?php if (isset($product->values[$attribute->name])): ?>
<?php $value = $product->values[$attribute->name]->value; ?>
<?php else: ?>
<?php $value = ''; ?>
<?php endif; ?>

@if ($attribute->representation->name == 'textbox')
{!! Form::text($name, $value, ['class'=> $className]) !!}
@elseif ($attribute->representation->name == 'dropdown')
<?php $dropdownOptions = array(); ?>
<?php foreach ($attribute->options as $option): ?>
<?php $dropdownOptions[$option->name] = $option->label; ?>
<?php endforeach; ?>
{!! Form::select($name, $dropdownOptions, $value, ['class'=>$className]) !!}
@endif