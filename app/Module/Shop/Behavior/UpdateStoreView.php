<?php

namespace Northstyle\Module\Shop\Behavior;

use Northstyle\Common\Behavior;

use Northstyle\Module\Shop\Behavior\DataObject\UpdateStoreView as UpdateBehaviorDO;

use Northstyle\Module\Shop\Model\StoreView as Model;

use Northstyle\Module\Core\Model\Language as LanguageModel;

class UpdateStoreView extends Behavior {
	protected $model = null;

	protected $languageModel = null;

	public function __construct(Model $model, LanguageModel $languageModel) {
		$this->model = $model;
		$this->languageModel = $languageModel;
	}

	public function handle(UpdateBehaviorDO $do) {
		$entity = $this->model->find($do->id->value());

		if (!$entity) {
			throw new EntityNotFoundException('Entity Not Found');
		}

		$entity->label = $do->label;
		$entity->save();
	}
}