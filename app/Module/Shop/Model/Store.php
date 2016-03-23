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
}
