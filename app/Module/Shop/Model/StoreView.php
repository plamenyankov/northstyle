<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

class StoreView extends Model {
    protected $table = 'store_views';

    protected $fillable = ['title'];

	public function scopeStoreID($query, $storeID) {
		$query->where('store_id', '=', $storeID);

		return $query;
	}

	public function store() {
		return $this->BelongsTo('Northstyle\Module\Shop\Model\Store');
	}

	public function language() {
		return $this->BelongsTo('Northstyle\Module\Core\Model\Language');
	}
}
