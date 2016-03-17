<?php

namespace Northstyle\Module\Core\DataObject\Builder;

use Northstyle\Module\Core\Model\User as UserModel;

use Northstyle\Module\Core\DataObject\User as UserDO;

class User {
	public function build(UserModel $entity = null) {
		$do = new UserDO();

		if ($entity) {
			$do->update($entity->toArray());
		}

		return $do;
	}
}