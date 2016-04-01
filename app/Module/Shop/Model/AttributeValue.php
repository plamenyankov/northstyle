<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model {
    protected $table = 'attribute_values';

	public function storeView() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\StoreView');
	}

	public function parentAttribute() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\Attribute');
	}

	public function parentOption() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\AttributeOption');
	}

	public function setValueDataAttribute($value) {
		$this->attributes['value_data'] = json_encode($value);
	}

	public function getValueDataAttribute($value) {
		if ($value) {
			return json_decode($value, true);
		} else {
			return null;
		}
	}
}
