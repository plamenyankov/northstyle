<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Model\Store as StoreModel;

use Northstyle\Module\Shop\Model\AttributeSet as Model;

use Northstyle\Module\Shop\Behavior\DataObject\CreateAttributeSet as CreateBehaviorDO;

class CreateAttributeSet extends Behavior {

	protected $storeModel = null;

	public function __construct(StoreModel $storeModel) {
		$this->storeModel = $storeModel;
	}

	public function loadStoreById($storeID) {
		$loadedEntity = $this->storeModel->find($storeID)->first();

		return $loadedEntity;
	}

	public function handle(CreateBehaviorDO $do) {
		$entity = new Model();

		$entity->store()->associate($this->loadStoreById($do->store_id));
		$entity->name = $do->name;
		$entity->label = $do->label;
		$entity->save();
	}
}