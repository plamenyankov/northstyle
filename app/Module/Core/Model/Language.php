<?php

namespace Northstyle\Module\Core\Model;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'languages';

	public function scopeCode($query, $code) {
		$query->where('code', '=', $code);

		return $query;
	}
}
