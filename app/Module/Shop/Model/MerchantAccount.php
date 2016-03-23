<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

class MerchantAccount extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'merchants';

	public function user() {
		return $this->BelongsTo('Northstyle\Module\Core\Model\User');
	}

	public function stores() {
		return $this->HasMany('Northstyle\Module\Shop\Model\Store');
	}
}
