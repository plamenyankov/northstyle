<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

	protected $model = 'Northstyle\Module\Shop\DataObject\Store';

    protected $fillable = ['title'];

	public function scopeUser($query, $userID) {
		$query->where('user_id', '=', $userID);

		return $query;
	}

	public function views() {
		return $this->HasMany('Northstyle\Module\Shop\Model\StoreView');
	}

	public function attributeSets() {
		return $this->HasMany('Northstyle\Module\Shop\Model\AttributeSet');
	}
}
