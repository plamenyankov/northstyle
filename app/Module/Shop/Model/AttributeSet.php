<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

class AttributeSet extends Model {
    protected $table = 'attribute_sets';

	public function store() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\Store');
	}

	public function values() {
		return $this->HasMany("Northstyle\Module\Shop\Model\ObjectValue", 'object_id')->where('type', '=', 'attribute_set');
	}

	public function attributes() {
		return $this->HasMany('Northstyle\Module\Shop\Model\Attribute');
	}

	public function scopeStoreID($query, $storeID) {
		$query->where("store_id", "=", $storeID);

		return $query;
	}
}
