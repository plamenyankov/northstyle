<?php

namespace Northstyle\Module\Shop\Model;

use Illuminate\Database\Eloquent\Model;

use Northstyle\Module\Core\Model\User as CoreUser;

class User extends CoreUser {

	public function merchant() {
		return $this->HasOne('Northstyle\Module\Shop\Model\MerchantAccount');
	}

	public function stores() {
		return $this->HasMany('Northstyle\Module\Shop\Model\Store');
	}
}
