<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Model\StoreView as Model;

use Northstyle\Module\Core\Model\Language as LanguageModel;

use Northstyle\Module\Shop\Behavior\DataObject\CreateStoreView as CreateBehaviorDO;

class CreateStoreView extends Behavior {

	protected $languageModel = null;

	public function __construct(LanguageModel $languageModel) {
		$this->languageModel = $languageModel;		
	}

	public function loadLanguageEntityByCode($code) {
		$languageEntity = $this->languageModel->code($code)->first();

		return $languageEntity;
	}

	public function handle(CreateBehaviorDO $do) {
		$entity = new Model();

		$entity->language()->associate($this->loadLanguageEntityByCode($do->language_code));
		$entity->store()->associate($do->store_id);
		$entity->label = $do->label;
		$entity->save();
	}
}